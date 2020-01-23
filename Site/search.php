<?php
    include("functions.php");

    // Facets voulu
    $facets = ["discipline_lib", "diplome", "sect_disciplinaire_lib", "reg_etab_lib",
    "etablissement_lib", "niveau_lib", "com_ins"];
    sort($facets); // trie les facets par ordre alphabetique
    // Lien de base du site
    $baseLink = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics";
    
    // Construction d'un lien pour les facets
    $link = $baseLink;
    foreach ($facets as $key => $value) {
        $link = addToLink($link, "facet=".$value);
    }
    $link = addToLink($link, "rows=0");

         
    $error = false;
    // Effectue un test sur le lien de l'api
    if (getHttpResponseCode($link) != 200) {
        console_log("erreur du lien ou de l'api !");
        echo "<h1 class=\"error\"> Impossible d'accéder aux api de data.gouv.fr </h1>";
        $error = true;
    }


    if (!$error) {
        // Envoie une requete pour obtenir uniquement les valeurs des facets pour remplir les datalist
        $groups = json_decode(file_get_contents($link))->facet_groups;
        // trie les facets par ordre alphabetique
        usort($groups, function($a,$b) {
            return strcmp($a->name, $b->name);
        });
        // Trie des entrées dans les dataset
        foreach ($groups as $value) {
            usort($value->facets, function($a,$b) {
                return strcmp($a->name, $b->name);
            });
        }

    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title> </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>

</head>

<?php 
    if (!$error) {
        include("body.php");
        include("script.php");        
        include("footer.php");        
    }
?>

</html>