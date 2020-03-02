<?php
include_once "Application.php";


$request;
$parameters = array();
// ajout des paramètres 
foreach ($_GET as $key => $value) {
    if ($value == "") continue;
    array_push($parameters, new Parameter($key, $value, "GET"));
}
foreach ($_POST as $key => $value) {
    if ($value == "") continue;
    array_push($parameter, new Parameter($key, $value, "POST"));
}

// création d'un objet représentant la requête
$navigator = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
$fromURL = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";

$request = new Request($navigator, $fromURL, $parameters);

// enregistrement dans la bdd
Application::getInstance()->insertRequest($request);
