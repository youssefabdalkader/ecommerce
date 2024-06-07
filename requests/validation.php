<?php 
include_once __DIR__ ."/../dir.php" ;
include_once $dir. "/app/database/config.php";

class Validation{
    
    private $name ; 
    private $value ; 


    public function __construct($name , $value)
    {
        $this->name = $name ;
        $this->value = $value ;
    }

    public function require(){
        return (empty($this-> value)) ? "$this->name is required" : "" ;
    }
    public function string(){
        return (is_string($this-> value)) ?  "" : "$this->name must be string"  ;
    }
    public function gender(){
        return ($this->value == 'm' or $this->value == 'f' ) ?  "" : "$this->name must be male or female"  ;
    }
    public function unique($table){

        $query = "SELECT * FROM `$table` WHERE $this->name = '$this->value'" ;
        $config= new Config;
        $result = $config->runDQL($query) ;
        return (empty($result)) ?  "" : "$this->name already exist"  ;
    }
    public function regex($pattern){
        return (preg_match($pattern , $this->value)) ? "" : "$this->name invalid" ;
    }

    public function confirm($confirm_password){
        return ($confirm_password == $this->value) ? "" : "$this->name no correct" ;
    }
}