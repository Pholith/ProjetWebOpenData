<?php

/**
 * Permet d'afficher des variables php dans la console javascript intégré
 */
function console_log($data) {
    $output = json_encode($data);
    echo "<script>console.log(" . $output . ");</script>";
}

function addToLink(string $url, string $toadd)
{
    return $url .= "&" .$toadd;
}
/**
 * Ecrit des scripts js
 */
function jsWrite($str) {
    echo "<script> " . $str . "</script>";
}

/**
 * Récupère les coordonnées de façon lazy
 */
function getCoordonatesFromINSEE(string $insee)
{

    global $arrayINSEE; // Stock les valeurs déjà lues pour ne pas refaire des requetes (il y a une limite de requête par seconde)
    if ($arrayINSEE == null) $arrayINSEE = [];

    $array = [];
    //console_log(sizeof($arrayINSEE));
    if (!isset($arrayINSEE[$insee])) {
        // API pour récupérer la géolocalisation depuis l'INSEE de la ville
        $geo = json_decode(file_get_contents("https://geo.api.gouv.fr/communes/".$insee."?fields=centre&format=json&geometry=centre"));
        if (!isset($geo->centre)) return null;
        $array[0] = $geo->centre->coordinates[0];
        $array[1] = $geo->centre->coordinates[1];
        $arrayINSEE[$insee] = $array;
    } else {
        $array = $arrayINSEE[$insee];
    }
    return $array;
}

function build_table($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        // ->fields ici pour accéder à tous les champs de l'objet js
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }
    // finish table and return it
    $html .= '</table>';
    return $html;
}

function build_tableOLD($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    foreach($array as $key=>$value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }
    // finish table and return it
    $html .= '</table>';
    return $html;
}

?>