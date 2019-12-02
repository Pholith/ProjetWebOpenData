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
        <a href="search.php"> <span class="verticalRealAlign"> établissements <br /> par diplôme </span> </a>
        <a> <span class="verticalRealAlign"> universités <br />par localisastion </span> </a>
    </nav>
    <section>
        <div class="bgImage"></div>

        <div class="search">
            <div class="tabLeft">
                <form action="" method="get">
                    <h3> Filtres </h3>
                    <label for="domaine"> Domaine: </label>
                    <input type="text" value="" name="domaine">
                    <br />
                    <label for="diplome"> Diplôme: </label>
                    <input type="text" value="" name="diplome">
                    <br />
                    <label for="localisation"> Localisation: </label>
                    <input type="text" value="" name="localisation">
                    <br />
                    <label for="years"> Années d'étude: </label>
                    <input list="bacs" name="years">
                    <datalist id="bacs">
                        <option value="Bac +1"></option>
                        <option value="Bac +2"></option>
                        <option value="Bac +3"></option>
                        <option value="Bac +4"></option>
                        <option value="Bac +5"></option>
                        <option value="Bac +6"></option>
                        <option value="Bac +7"></option>
                        <option value="Bac +8"></option>
                    </datalist>
                    <br />
                    <input type="submit" value="Chercher" class="submit">
                </form>
            </div>

            <div class="tabRight">
                <div id="mapid"></div>

            </div>
        </div>
    </section>

    <footer>

    </footer>
</body>

<?php
    include("functions.php");

    // API pour récupérer les données
    $json = file_get_contents("https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&facet=rentree_lib&facet=etablissement_type2&facet=etablissement_type_lib&facet=etablissement&facet=etablissement_lib&facet=diplome_rgp&facet=typ_diplome_lib&facet=disciplines_selection&facet=discipline_lib&facet=spec_dut_lib&facet=localisation_ins&facet=com_etab_lib&facet=dep_etab&refine.rentree_lib=2017-18");
    $text = json_decode($json);

    console_log($text->records);

    $jsToWrite = "";
    foreach ($text->records as $key => $value) {

        $id = $value->fields->com_ins;
        if ($id) {
            // API pour récupérer la géolocalisation depuis l'INSEE de la ville
            $geo = json_decode(file_get_contents("https://geo.api.gouv.fr/communes/".$id."?fields=centre&format=json&geometry=centre"));
            $jsToWrite .= "L.marker([".$geo->centre->coordinates[1].", ".$geo->centre->coordinates[0]."])
            .addTo(mymap)
            .bindPopup('". $value->fields->discipline_lib ."')
            .openPopup();";
        }
    }
    echo "";
?>
<script>
    var mymap = L.map('mapid').setView([48.845, 2.3752], 13);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoicGhvbGl0aCIsImEiOiJjazM2MWljNDUxMWtyM2JueXNxOWo1MGF0In0.8eR0bt3PfFACQDq2CELQPA'
    }).addTo(mymap);

    <?php echo $jsToWrite; ?>
</script>
</html>