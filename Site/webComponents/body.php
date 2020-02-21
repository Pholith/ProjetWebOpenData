<body>
    <nav>
        <a class="active" href="index.php"> <span class="verticalRealAlign"> accueil </span></a>
        <a href="search.php"> <span class="verticalRealAlign"> Recherche </span> </a>
    </nav>
    <section>
        <div class="bgImage"></div>

        <div class="search">
            <div class="tabLeft">

                <form method="get">
                    <h3> Filtres </h3>
                    <label> Domaine: </label>
                    <input list="domaine" name="domaine" value="<?php if (isset($_GET["domaine"])) echo $_GET["domaine"] ?>">
                    <datalist id="domaine">
                        <?php
                        $key = array_search("sect_disciplinaire_lib", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"" . $value->name . "\"></option>";
                        }
                        ?>
                    </datalist>
                    <br />
                    <label> Diplôme: </label>
                    <input list="diplome" name="diplome" value="<?php if (isset($_GET["diplome"])) echo $_GET["diplome"] ?>">
                    <datalist id="diplome">
                        <?php

                        $key = array_search("diplome", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"" . $value->name . "\"></option>";
                        }
                        ?>
                    </datalist>
                    <br />
                    <label> Région: </label>
                    <input list="loc" name="loc" value="<?php if (isset($_GET["loc"])) echo $_GET["loc"] ?>">
                    <datalist id="loc">
                        <?php
                        $key = array_search("reg_etab_lib", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"" . $value->name . "\"></option>";
                        }
                        ?>
                    </datalist>

                    <br />
                    <label> Années d'étude: </label>
                    <input list="years" name="years" value="<?php if (isset($_GET["years"])) echo $_GET["years"] ?>">
                    <datalist id="years">
                        <?php
                        $key = array_search("niveau_lib", $facets);
                        foreach ($groups[$key]->facets as $key => $value) {
                            echo "<option value=\"" . $value->name . "\"></option>";
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

        
        <div class="divTable">
            <?php
            echo $readyToPrintNHits;
            echo build_table($readyToPrintTable);
            ?>
        </div>
    </section>

    <?php include("footer.php"); ?>

</body>