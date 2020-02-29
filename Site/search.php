<?php
include_once "php/Application.php";
include_once "php/logger.php";

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


    $dataLink = Application::getInstance()->createDataAPILink();
    // établie une limite de 100 lignes par défaut
    if (isset($_GET["rows"])) {
        $rows = $_GET["rows"];
    } else {
        $rows = 100;
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
    foreach ($text->records as $key => $value) {
        $id = $value->fields->com_ins;
        if ($id) {
            // Ecrit à partir des données le code javascript pour utiliser l'API OpenStreetMap
            $coordinates = getCoordonatesFromINSEE($id);
            if ($coordinates[0] != null && $coordinates[1] != null)
                JSManager::addJs("L.marker([" . $coordinates[1] . ", " . $coordinates[0] . "]).addTo(mymap).bindPopup(\"" . $value->fields->sect_disciplinaire_lib . "\").openPopup();");
        }
    }


    //////// PREPARE LE TABLEAU 

    // Simplifie et filtre la colonne inutile à l'utilisateur de com_ins
    //$urlFullRows = (strpos($_SERVER['HTTP_REFERER'], "&rows=") != -1) ? $_SERVER['HTTP_REFERER'] : $_SERVER['HTTP_REFERER'] . "&rows=-1" ;
    $readyToPrintNHits = "<h3> " . $text->nhits . " résultats </h3>";

    $readyToPrintTable = [];
    foreach ($text->records as $key1 => $value) {
        $newSubArray = [];
        foreach ($value->fields as $key2 => $value) {
            if ($key2 != "com_ins") { // retire cette colonne inutile
                $newSubArray[$key2] = $value;
            }
        }
        $readyToPrintTable[$key1] = $newSubArray;
    }

}
?>

<!DOCTYPE html>
<html lang="fr">

<?php
if (!$error) {
    include("webComponents/head.php");
    include("webComponents/body.php");
    include("webComponents/script.php");
}
?>

</html>