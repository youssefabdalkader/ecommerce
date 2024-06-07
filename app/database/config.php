<?php 


class Config {
    private $hostname = "localhost" ;
    private $username = "root" ;
    private $password = "" ;
    private $databasename = "ecommerce" ;

    private $con ;

    public function __construct(){

        $this->con  = new mysqli($this->hostname , $this->username , $this->password , $this->databasename) ;
       
    }


// update , insert , delete 
    public function runDML($query) : bool{
        $result = $this->con->query($query) ;
        if($result){
            return true ;
        }return false ;

    }
    public function runDQL(string $query) 
    {
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            return $result;
        }
        return [];
    }
}




?>