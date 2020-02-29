<?php
declare(strict_types=1); // Oblige la déclaration strictement typé des champs etc. (Ne marche qu'en php7.4 je crois)


///////// Centralisation des imports
// Utilitaires
include_once "functions.php";
include_once "JSManager.php";

// Objets du modèle de la bdd
include_once "Model/Request.php";
include_once "Model/Parameter.php";


class Application
{

    //////// SINGLETON PATTERN 
    /**
     * @var Application
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     * Constructeur de la classe
     *
     * @param void
     * @return void
     */
    private function __construct()
    {
        $this->init();
    }

    /**
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return Application
     */
    public static function getInstance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new Application();
        }

        return self::$_instance;
    }


    // APPLICATION BODY

    public const BASE_API_LINK = "https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-principaux-diplomes-et-formations-prepares-etablissements-publics&apikey=f379dcd3781832ae80d64c9c6039fbaafbcd44ff46dc2537c6eb2295";

    private $FACETS;
    private $bd;
    //Associe chaque facet à une chaine lisible
    public const FACETS_STRINGS = [
        "discipline_lib" => "Discipline",
        "diplome_lib" => "Diplôme",
        "sect_disciplinaire_lib" => "Secteur disciplinaire",
        "reg_etab_lib" => "Région",
        "etablissement_lib" => "Etablissement",
        "niveau_lib" => "Année d'étude",
        "com_ins" => "",
        "element_wikidata" => "Lien"
    ];

    public function init()
    {
        $this->FACETS = [
            "discipline_lib", "diplome_lib", "sect_disciplinaire_lib", "reg_etab_lib",
            "etablissement_lib", "niveau_lib", "com_ins", "element_wikidata"
        ];
        sort($this->FACETS);

        try {
            // Connection à la bdd 
            include_once "config.php";
            $this->bd = new PDO($host, $user, $pass);
            $this->bd->exec('SET NAMES utf8');
            console_log("Database connection success.");
            
        } catch (Exception $e) {
            console_logOLD($e);
            die("Connection impossible à la base de données.");
        }
    }

    public function getFacets() {
        return $this->FACETS;
    }

    public function createDatalistAPILink(): string
    {
        // Construction d'un lien pour les facets
        $link = Application::BASE_API_LINK;
        foreach ($this->FACETS as $key => $value) {
            $link .= "&facet=" . $value;
        }
        $link .= "&rows=0";
        return $link;
    }

    public function createDataAPILink(): string
    {

        // Construction d'un lien pour les facets
        $link = Application::BASE_API_LINK;
        foreach ($this->FACETS as $key => $value) {
            $link .= "&facet=" . $value;
        }

        // Retire de la demande les colonnes non voulu
        $link .= "&fields=";
        for ($i = 0; $i < count($this->FACETS); $i++) {
            if (count($this->FACETS) - 1 == $i) {
                $link .= $this->FACETS[$i];
            } else {
                $link .= $this->FACETS[$i] . ",";
            }
        }

        // pour éviter d'avoir les mêmes établissements à des années différentes
        $link .= "&refine.rentree_lib=" . "2017-18";
        return $link;
    }


    public function insertRequest($request) {

        if (!$this->bd->query($request->generateInsertSQL())) {
            console_logOLD($request->generateInsertSQL());
            console_logOLD($this->bd->errorInfo());
        }
        if (!$request->hasParameters()) return;
        
        $id = $this->bd->lastInsertId();
        if (!$this->bd->query($request->generateParametersSQL($id))) {
            console_logOLD($request->generateParametersSQL($id));
            console_logOLD($this->bd->errorInfo());
        }
    }

    public function selectGroupedParameters(String $parameterName) {
        $statement = $this->bd->prepare("select value as ?, count(value) as nbr from mydb.parameter where name =? group by value order by nbr desc;");
        $statement->execute(array($parameterName, $parameterName));
        return $statement->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function selectRequestsByDate() {
        $statement = $this->bd->prepare("select time as date, count(time) as units from mydb.request where request.time != 'NULL' group by time order by time desc;");
        $statement->execute([]);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertUniversityClick($link)
    {
        $request = "insert into mydb.clicked_link (date, link) values ('".$this->getFormatedDate() ."','".$link."');";
        if (!$this->bd->query($request)) {
            console_logOLD($request);
            console_logOLD($this->bd->errorInfo());
        }
    }

    public function getFormatedDate() : String
    {
        return Date("Y-m-j");
    }
    
    /*
    utile pour modifier les settings qui bloquent le group by
    set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
    set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';

    */
}
