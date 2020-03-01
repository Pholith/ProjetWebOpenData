<?php
include_once "php/Application.php";
if (isset($_GET["url"]) && $_GET["url"] != "") {
    Application::getInstance()->insertUniversityClick($_GET["url"]); // enregistre le click dans la bdd
    header("Location: " . $_GET["url"]); // redirection
} else
    header("Location: index.php");
