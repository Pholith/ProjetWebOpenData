<?php
    include("functions.php");

    // Facets voulu
    $facets = ["discipline_lib", "sect_disciplinaire_lib",
    "diplome", "reg_etab_lib",
    "etablissement_lib", "niveau_lib", "com_ins"];
    // Lien de base du site
    $baseLink = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics";
    
    // Construction d'un lien pour les facets
    $link = $baseLink;
    foreach ($facets as $key => $value) {
        $link = addToLink($link, "facet=".$value);
    }
    $link = addToLink($link, "rows=0");
    
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

<body>
    <nav>
    <a class="active" href="index.php"> <span class="verticalRealAlign"> accueil </span></a>
        <a href="search.php"> <span class="verticalRealAlign"> Recherche </span> </a>
    </nav>
    <section>
        <div class="bgImage"></div>

        <div class="search">
            <div class="tabLeft">
                <?php 
                
                // Envoie une requete pour obtenir uniquement les valeurs des facets pour remplir les datalist
                $groups = json_decode(file_get_contents($link))->facet_groups;
                
                ?>
                <form action="" method="get">
                    <h3> Filtres </h3>
                    <label for="domaine"> Domaine: </label>
                    <input list="domaine" name="domaine" value="<?php if (isset($_GET["domaine"])) echo $_GET["domaine"]?>">
                    <datalist id="domaine">
                    <?php 
                        $key = array_search("sect_disciplinaire_lib", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"".$value->name."\"></option>";
                        }
                    ?>
                    </datalist>
                    <br/>
                    <label for="diplome"> Diplôme: </label>
                    <input list="diplome" name="diplome" value="<?php if (isset($_GET["diplome"])) echo $_GET["diplome"]?>">
                    <datalist id="diplome">
                    <?php 
                        $key = array_search("diplome", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"".$value->name."\"></option>";
                        }
                    ?>
                    </datalist>
                    <br/>
                    <label for="loc"> Région: </label>
                    <input list="loc" name="loc" value="<?php if (isset($_GET["loc"])) echo $_GET["loc"]?>">
                    <datalist id="loc">
                    <?php 
                        $key = array_search("reg_etab_lib", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"".$value->name."\"></option>";
                        }
                    ?>
                    </datalist>
                    
                    <br/>
                    <label for="years"> Années d'étude: </label>
                    <input list="years" name="years" value="<?php if (isset($_GET["years"])) echo $_GET["years"]?>">
                    <datalist id="years">
                    <?php 
                        $key = array_search("niveau_lib", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"".$value->name."\"></option>";
                        }
                    ?>
                    </datalist>

                    <br />
                    <input type="submit" value="Chercher" class="submit">
                </form>
            </div>

            <div class="tabRight">
                <div id="mapid"></div>

            </div>
        </div>
                
        <?php

        // Construction d'un lien pour les facets
        $link = $baseLink;
        foreach ($facets as $key => $value) {
            $link = addToLink($link, "facet=".$value);
        }

        // Retire de la demande les colonnes non voulu
        $link = addToLink($link, "fields=");
        for ($i=0; $i < count($facets); $i++) {
            if (count($facets) - 1 == $i ) {
                $link .= $facets[$i];
            } else {
                $link .= $facets[$i] . ",";
            }
        }
        
        //&fields=etablissement_lib
        // Ajouts des filtres et paramètres
        $link = addToLink($link, "rows=100");
        //$link = addToLink($link, "sort="."-rentree_lib");
        $link = addToLink($link, "refine.rentree_lib=" . "2017-18"); // pour éviter d'avoir les mêmes établissements à des années différentes
        if (isset($_GET["diplome"]) && $_GET["diplome"] != "")  $link = addToLink($link, "refine.diplome=".                 $_GET["diplome"]);
        if (isset($_GET["loc"])     && $_GET["loc"] != "")      $link = addToLink($link, "refine.reg_etab_lib=".            $_GET["loc"]);
        if (isset($_GET["domaine"]) && $_GET["domaine"] != "")  $link = addToLink($link, "refine.sect_disciplinaire_lib=".  $_GET["domaine"]);
        if (isset($_GET["years"])   && $_GET["years"] != "")    $link = addToLink($link, "refine.niveau_lib=".              $_GET["years"]);

        console_log("Fetching link...\n".$link);

        //geofilter.distance=48.5%2C48.5%2C1000  filtre les écoles à 1km
        $text = json_decode(file_get_contents($link));
        //console_log($text->records);

        $jsToWrite = "";
        foreach ($text->records as $key => $value) {
            $id = $value->fields->com_ins;
            if ($id) {
                // Ecrit à partir des données le code javascript pour utiliser l'API OpenStreetMap
                $coordinates = getCoordonatesFromINSEE($id);
                if ($coordinates[0] != null && $coordinates[1] != null)
                    $jsToWrite .= "L.marker([".$coordinates[1].", ".$coordinates[0]."]).addTo(mymap).bindPopup(\"". $value->fields->sect_disciplinaire_lib ."\").openPopup();";
            }
        }
        ?>

        <div class="divTable"> 
            <?php 
            // Simplifie et filtre la colonne inutile à l'utilisateur de com_ins
            $newArray = [];
            foreach ($text->records as $key1 => $value) {
                $newSubArray = [];
                foreach ($value->fields as $key2 => $value) {
                    if ($key2 != "com_ins") {
                        $newSubArray[$key2] = $value;
                    }
                }
                $newArray[$key1] = $newSubArray;
            }

            echo build_table($newArray);
            ?>
        </div>
    </section>

    <footer>

    </footer>
</body>


<script>
    // CODE JAVASCRIPT DE LA PAGE
    var mymap = L.map('mapid').setView([48.845, 2.3752], 13);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 15,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGhvbGl0aCIsImEiOiJjazM2MWljNDUxMWtyM2JueXNxOWo1MGF0In0.8eR0bt3PfFACQDq2CELQPA'
    }).addTo(mymap);

    <?php echo $jsToWrite; ?>
</script>


</html>