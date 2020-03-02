<?php
include_once "php/Application.php";

////// TEST L'ACCESSIBILITE DU LIEN

$error = false;
// Effectue un test sur le lien de l'api
if (getHttpResponseCode(Application::BASE_API_LINK) != 200) {
    console_log("erreur du lien ou de l'api !");
    echo "<h1 class=\"error\"> Impossible d'accéder aux APIs de <a href='https://data.enseignementsup-recherche.gouv.fr/explore/dataset/fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics/information/'> data.gouv.fr </a> </h1>";
    $error = true;
}


////// PREPARE LES DATALISTS DES CHAMPS


$datasetLink = Application::getInstance()->createDatalistAPILink();
if (!$error) {
    // Envoie une requete pour obtenir uniquement les valeurs des facets pour remplir les datalist
    $groups = json_decode(file_get_contents($datasetLink))->facet_groups;
    // trie les facets par ordre alphabetique
    usort($groups, function ($a, $b) {
        return strcmp($a->name, $b->name);
    });
    // Trie des entrées dans les dataset
    foreach ($groups as $value) {
        usort($value->facets, function ($a, $b) {
            return strcmp($a->name, $b->name);
        });
    }



    /////// PREPARE LES DONNEES ET LA CARTE
    if (isset($_GET["years"])) { // Ne fait des recherches que si le bouton a été cliqué
        include_once "php/logger.php";

        $dataLink = Application::getInstance()->createDataAPILink();
        // établie une limite de 100 lignes par défaut
        if (isset($_GET["rows"])) {
            $rows = $_GET["rows"];
        } else {
            $rows = 50;
        }
        $dataLink .= "&rows=" . $rows;
        if (isset($_GET["diplome"]) && $_GET["diplome"] != "")  $dataLink .= "&refine.diplome_lib=" .             $_GET["diplome"];
        if (isset($_GET["loc"])     && $_GET["loc"] != "")      $dataLink .= "&refine.reg_etab_lib=" .            $_GET["loc"];
        if (isset($_GET["domaine"]) && $_GET["domaine"] != "")  $dataLink .= "&refine.sect_disciplinaire_lib=" .  $_GET["domaine"];
        if (isset($_GET["years"])   && $_GET["years"] != "")    $dataLink .= "&refine.niveau_lib=" .              $_GET["years"];

        console_log("Fetching datalink...\n" . $dataLink);

        //geofilter.distance=48.5%2C48.5%2C1000  filtre les écoles à 1km
        $text = json_decode(file_get_contents($dataLink));
        //console_log($text->records);

        JSManager::addJs("
        let popup;
        let markerArray = [];
        let marker;");
        foreach ($text->records as $key => $value) {
            $id = $value->fields->com_ins;
            if ($id) {
                // Ecrit à partir des données le code javascript pour utiliser l'API OpenStreetMap
                $coordinates = getCoordonatesFromINSEE($id);
                $url = Application::getInstance()->getEtablismentURL($value->fields->etablissement);
                if ($coordinates[0] != null && $coordinates[1] != null) {
                    JSManager::addJs("
                    popup = L.popup()
                    .setContent(`<p>" . $value->fields->sect_disciplinaire_lib . "</p>");
                    if ($url !=  "") {
                        JSManager::addJs("<a href=\"" . Application::getInstance()->getLoggerLink($url) . "\"> " . $value->fields->etablissement_lib . "</a>");
                    }
                    JSManager::addJs("`);
                    marker = L.marker([" . $coordinates[1] . ", " . $coordinates[0] . "]);
                    marker.bindPopup(popup);
                    markerArray.push(marker);
                    ");
                }
            }
        }
        JSManager::addJs("
        var group = L.featureGroup(markerArray).addTo(mymap);
        mymap.fitBounds(group.getBounds());
        ");


        //////// PREPARE LE TABLEAU 
        $readyToPrintNHits;
        $urlFullRows = $_SERVER["SCRIPT_NAME"];
        foreach ($_GET as $key => $value) {
            if ($key != "rows") $urlFullRows .= (($_SERVER["SCRIPT_NAME"] == $urlFullRows) ? "?" : "&") . $key . "=" . urlencode($value);
        }
        $urlFullRows .= "&rows=200";
        // Simplifie et filtre la colonne inutile à l'utilisateur de com_ins
        //$urlFullRows = (strpos($_SERVER['HTTP_REFERER'], "&rows=") != -1) ? $_SERVER['HTTP_REFERER'] : $_SERVER['HTTP_REFERER'] . "&rows=-1" ;
        if (!isset($_GET["rows"])) {
            $nbrOfResults = 50;
        } else {
            $nbrOfResults = $_GET["rows"];
        }


        if ($nbrOfResults == 200 ) {
            $readyToPrintNHits = "<h3> " . $nbrOfResults . "/". $text->nhits." résultats. <span class=\"red\"> Faites une recherche plus précise! </span> </h3> ";
        } else if ($text->nhits < $nbrOfResults) $readyToPrintNHits = "<h3> " . $text->nhits . " résultats </h3>";
        else $readyToPrintNHits = "<h3> " . $nbrOfResults . "/" . $text->nhits . " résultats <a href='" . $urlFullRows . "'> Voir plus de résultats </a> </h3>";




        $readyToPrintTable = [];
        foreach ($text->records as $key1 => $value) {
            $newSubArray = [];

            $newSubArray["Site Officiel"] = Application::getInstance()->getEtablismentURL($value->fields->etablissement);
            foreach ($value->fields as $key2 => $value) {
                if (!array_search($key2, Application::NOT_PRINTED_FACETS)) { // retire les colonnes inutiles
                    $newSubArray[$key2] = $value;
                }
            }
            $readyToPrintTable[$key1] = $newSubArray;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<?php
if (!$error) {
    include("webComponents/head.php");
    include("webComponents/body.php");
}
?>
</html>