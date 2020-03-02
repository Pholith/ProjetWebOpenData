<?php
include("php/Application.php");

$diplomeMap = Application::getInstance()->selectGroupedParameters("diplome");

$domaineMap = Application::getInstance()->selectGroupedParameters("domaine");

$locMap = Application::getInstance()->selectGroupedParameters("loc");

$yearsMap = Application::getInstance()->selectGroupedParameters("years");

$clickedMap = Application::getInstance()->mostClickedURLs();

?>
<!DOCTYPE html>
<html lang="FR">
<?php include("webComponents/head.php"); ?>
<body>
    <nav>
        <a class="active" href="index.php"> <span class="verticalRealAlign"> accueil </span></a>
        <a href="search.php"> <span class="verticalRealAlign"> Recherche </span> </a>
    </nav>

    <section class="admin">
        <div>

            <?php
            echo build_chart1($diplomeMap, "Diplome", "Nombre de recherches effectués");
            echo build_chart1($domaineMap, "Domaine", "Nombre de recherches effectués");
            echo build_chart1($clickedMap, "URL", "Etablissement les plus visités");
            ?>

        </div>
        <div>
            <?php
            echo build_chart1($locMap, "Localisation", "Nombre de recherches effectués");
            echo build_chart1($yearsMap, "Année d'étude", "Nombre de recherches effectués");
            ?>


            <!--https://canvasjs.com/jquery-charts/json-data-api-ajax-chart/-->
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script>
                window.onload = function() {
                    var dataPoints = [];
                    var options = {
                        animationEnabled: true,
                        theme: "light2",
                        title: {
                            text: "Requêtes"
                        },
                        axisX: {
                            valueFormatString: "DD MMM YYYY",
                        },
                        axisY: {
                            title: "Nombre de requêtes",
                            titleFontSize: 24,
                            includeZero: false
                        },
                        data: [{
                            type: "spline",
                            yValueFormatString: "Y-m-d",
                            dataPoints: dataPoints
                        }]
                    };

                    function addData(data) {
                        for (var i = 0; i < data.length; i++) {
                            dataPoints.push({
                                x: new Date(data[i].date),
                                y: data[i].units
                            });
                        }
                        $("#chartContainer").CanvasJSChart(options);

                    }
                    $.getJSON("http://<?php echo $_SERVER["HTTP_HOST"];?>/API/getRequestsByDate.php", addData);

                }
            </script>

        </div>

    </section>

    <?php include("webComponents/footer.php"); ?>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

</body>
</html>