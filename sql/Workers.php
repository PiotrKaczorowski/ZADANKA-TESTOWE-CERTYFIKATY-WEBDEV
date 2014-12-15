<?php
var_dump(PDO::getAvailableDrivers());
class connect{
    private $dns = "mysql:host=locahost;port=3306;dbname=workers";
    private $username = "worker";
    private $password = "worker";
    
    function __construct(){
        try{
            $pdo = new PDO($dsn, $username, $passwd);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
