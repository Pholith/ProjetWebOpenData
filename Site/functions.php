<?php
// Method: POST, PUT, GET etc

function console_log($data) {
    $output = json_encode($data);
    echo "<script>console.log(" . $output . ");</script>";
}
function jsWrite($str) {
    echo "<script> " . $str . "</script>";
}

function build_table($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    console_log($array);
    foreach($array[0]->fields as $key=>$value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    $html .= '</tr>';

    // data rows
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        // ->fields ici pour accéder à tous les champs de l'objet js
        foreach($value->fields as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}

function build_table2($array){
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