<?php
include_once "php/logger.php";
?>

<!DOCTYPE html>
<html lang="FR">

<?php
include("webComponents/head.php");
?>

<body>

    <nav>
        <a class="active" href="index.php"> <span class="verticalRealAlign"> accueil </span></a>
        <a href="search.php"> <span class="verticalRealAlign"> Recherche </span> </a>
    </nav>
    <div class="bgImage"> </div>
    <section>
        <div class="textDiv">
            <p> Je cherche une formation ... </p>
        </div>

        <div class="buttons">
            <a href="search.php?years=1ère+année"> Après le bac </a>
            <a href="search.php?years=4ème+année"> Après un diplôme <br /> bac+3 </a>
            <a href="search.php?years=6ème+année"> Après un diplôme <br /> bac+5 </a>
        </div>
    </section>
    <?php include("webComponents/footer.php"); ?>

</body>

</html>