<?php
declare(strict_types=1);

include_once "Parameter.php";

class Request {

    private $parameters;
    private $navigator;
    private $fromURL;

    public function __construct(String $navigator, String $fromURL, array $parameters)
    {
        $this->navigator = $navigator;
        $this->fromURL = $fromURL;
        $this->parameters = $parameters;
    }

    public function getParameters() : array {
        return $this->parameters;
    }    
    public function getFromURL() : String {
        return $this->fromURL;  
    }
    public function getNavigator() : String {
        return $this->navigator;
    }

    public function hasParameters() : bool
    {
        return sizeof($this->parameters) > 0;
    }

    public function generateInsertSQL() : String {
        return "insert into request (`navigator`,`fromUrl`) VALUES ('',".$this->fromURL.");";
    }
    public function generateParametersSQL(String $id) : String {
        $req = "";
        foreach ($this->parameters as $param) {
            $req .= $param->generateInsertSQL($id);
        }
        return $req;
    }
}