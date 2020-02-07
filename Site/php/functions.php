<?php

// code from https://stackoverflow.com/questions/2280394/how-can-i-check-if-a-url-exists-via-php
function getHttpResponseCode($url, $followredirects = true)
{
    if(! $url || ! is_string($url)){
        return false;
    }
    $headers = @get_headers($url);
    if($headers && is_array($headers)){
        if($followredirects){
            $headers = array_reverse($headers);
        }
        foreach($headers as $hline){
            if(preg_match('/^HTTP\/\S+\s+([1-9][0-9][0-9])\s+.*/', $hline, $matches) ){// "HTTP/*** ### ***"
                $code = $matches[1];
                return $code;
            }
        }
        // no HTTP/xxx found in headers:
        return false;
    }
    // no headers :
    return false;
}


/**
 * Récupère les coordonnées de façon lazy
 * https://api.gouv.fr/api/api-geo 
 */
function getCoordonatesFromINSEE(string $insee)
{
    // Stock les valeurs déjà lues pour ne pas refaire des requetes (il y a une limite de requête par seconde)
    global $arrayINSEE; 
    if ($arrayINSEE == null) $arrayINSEE = [];

    $array = [];
    //console_log(sizeof($arrayINSEE));
    if (!isset($arrayINSEE[$insee])) {
        // API pour récupérer la géolocalisation depuis l'INSEE de la ville
        usleep(100); // permet de réduire le nombre de requêtes par sec
        $content = file_get_contents("https://geo.api.gouv.fr/communes/" .$insee."?fields=centre&format=json&geometry=centre");
        if (!$content) {
            return false;
        }
        $geo = json_decode($content);
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
