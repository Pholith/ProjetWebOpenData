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
    <section>
        <div class="textDiv">
            <p> Je cherche une formation ... </p>
        </div>
        <div class="bgImage"> </div>

        <div class="buttons">
            <button> <a href="search.php?years=1ère+année"> Après le bac </a> </button>
            <button> <a href="search.php?years=4ème+année"> Après un diplôme <br /> bac+3 </a> </button>
            <button> <a href="search.php?years=6ème+année"> Après un diplôme <br /> bac+5 </a> </button>
        </div>
    </section>
    <?php include("webComponents/footer.php"); ?>

</body>

</html>