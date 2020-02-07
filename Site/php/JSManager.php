<?php

/**
 * Petite classe permettant de gérer le code javascript à écrire
 */
class JSManager
{
    static $jsToWrite = "";

    public static function addJs(string $javascriptCode)
    {
        self::$jsToWrite .= $javascriptCode;
    }

    public static function console_log($object)
    {
        self::$jsToWrite .= "console.log(" . json_encode($object) . ");";
    }

    public static function returnAndReset(): string
    {
        $result = self::$jsToWrite;
        self::$jsToWrite = "";
        return $result;
    }
}

// Permet d'avoir la syntaxe console::log
class console
{
    public static function log($object)
    {
        JSManager::console_log($object);
    }
}


// Fonction pour rajouter le javascript plus rapidement
function console_log($object)
{
    JSManager::console_log($object);
}


function console_logOLD($data)
{
    $output = json_encode($data);
    echo "<script>console.log(" . $output . ");</script>";
}
