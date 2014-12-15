<?php
/*
 * 
Given the following data definition, select all queries that return a list of employees who are not managers.


TABLE emp
        id INTEGER PRIMARY KEY
        mgrId INTEGER REFERENCES emp (id)
        name VARCHAR2(30) NOT NULL

SELECT e.name FROM emp e
WHERE e.id NOT IN (
        SELECT DISTINCT m.mgrId FROM emp m
)

SELECT e.name FROM emp e
WHERE e.id NOT IN (
        SELECT DISTINCT m.mgrId FROM emp m WHERE m.mgrId IS NOT NULL
)

SELECT e.name FROM emp e
WHERE e.id NOT IN (
        SELECT m.mgrId FROM emp m
)

SELECT e.name FROM emp e
WHERE e.id NOT IN (
        SELECT m.mgrId FROM emp m WHERE m.mgrId IS NOT NULL
)
   

 */
class connect{
    private $dns = "mysql:host=localhost;port=3306;dbname=worker";
    private $username = "root";
    private $password = "";
    private $pdo;
            
    function __construct(){
        try{
            $this->pdo = new PDO($this->dns, $this->username, $this->password);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    function getData(){
        $val = "SELECT e.name FROM emp e
                    WHERE e.id NOT IN (
                        SELECT DISTINCT m.mgrId FROM emp m WHERE m.mgrId IS NOT NULL)";
        $val2 = "SELECT e.name FROM emp e
                    WHERE e.id NOT IN (
                        SELECT m.mgrId FROM emp m WHERE m.mgrId IS NOT NULL)";
    
        $query = $this->pdo->query($val);
        foreach ($query as $row):
            echo $row['name'].'<br />';
        endforeach;
    }
}

$pdo = new connect();
$pdo->getData();