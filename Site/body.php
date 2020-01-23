<body>
    <nav>
    <a class="active" href="index.php"> <span class="verticalRealAlign"> accueil </span></a>
        <a href="search.php"> <span class="verticalRealAlign"> Recherche </span> </a>
    </nav>
    <section>
        <div class="bgImage"></div>

        <div class="search">
            <div class="tabLeft">

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
        
        // établie une limite de 100 lignes par défaut
        if (isset($_GET["rows"])) {
            $rows = $_GET["rows"];
        } else {
            $rows = 100;
        }

        // Ajouts des filtres et paramètres
        //$link = addToLink($link, "rows=".$rows);
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
            //$urlFullRows = (strpos($_SERVER['HTTP_REFERER'], "&rows=") != -1) ? $_SERVER['HTTP_REFERER'] : $_SERVER['HTTP_REFERER'] . "&rows=-1" ;

            echo "<h3> ".$text->nhits." résultats </h3>";
            //<a href=\"".$urlFullRows."\"> Afficher tous les résultats </a>

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
