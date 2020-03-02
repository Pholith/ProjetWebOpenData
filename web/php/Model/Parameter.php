<?php
declare(strict_types=1);

class Parameter {

    /** @var String $type Type of the parameter (GET, POST ....) */
    private $type;
    /** @var String $value value of the paramter*/
    private $value;
    /** @var String $name name of the paramter*/
    private $name;

    public function __construct(String $name, String $value, String $type)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
    }

    public function getType() : String {
        return $this->type;
    }    
    public function getValue() : String {
        return $this->value;
    }
    public function getName() : String {
        return $this->name;
    }

    public function generateInsertSQL(String $id) : String
    {
        return "insert into parameter (type, value, name, Request_idRequest) VALUES
        ('".$this->type."',  '".$this->value."',  '".$this->name."', '".$id."');";
    }
}

