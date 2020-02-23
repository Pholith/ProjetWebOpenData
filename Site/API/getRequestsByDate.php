<?php
include "../php/Application.php";
header("Content-Type:application/json");

$response = Application::getInstance()->selectRequestsByDate();

// converti les datetime en timestamp
for ($i=0; $i < sizeof($response); $i++) {
    $response[$i]->units = intval($response[$i]->units);
}

echo json_encode($response);