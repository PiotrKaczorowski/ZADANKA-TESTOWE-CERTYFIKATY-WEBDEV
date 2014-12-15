<?php
/*
 * 
Question: Salary

Time: 5min Skills: SQL  
Type: PUBLIC
Given the following data definition, select all queries that return the second largest salary. Note that it is possible that some employees have the same salary.

TABLE emp
        id INTEGER PRIMARY KEY
        name VARCHAR2(30) NOT NULL
        salary NUMBER

If we have employees A, B, and C whose salaries are $100, $80, and $100 respectively, note that the second highest salary is $80 although there are two employees with a higher salary.

SELECT DISTINCT salary FROM emp ORDER BY salary DESC OFFSET 1 LIMIT 1;
SELECT MAX(salary) FROM emp WHERE salary < (SELECT MAX(salary) FROM emp);
SELECT salary FROM (SELECT DISTINCT salary FROM emp ORDER BY salary DESC LIMIT 2) AS emp ORDER BY salary LIMIT 1;
SELECT DISTINCT salary FROM (SELECT salary FROM emp ORDER BY salary DESC LIMIT 2) AS emp ORDER BY salary LIMIT 1;
SELECT salary FROM emp ORDER BY salary DESC OFFSET 1 LIMIT 1;

   

 */
class Salary{
    private $dns = "mysql:host=localhost;port=3306;dbname=worker";
    private $username = "worker";
    private $password = "worker";
    private $pdo;
            
    function __construct(){
        try{
            $this->pdo = new PDO($this->dns, $this->username, $this->password);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    function getData(){
        $val =  "SELECT DISTINCT salary FROM emp ORDER BY salary DESC LIMIT 1  OFFSET 1";
        $val2 = "SELECT MAX(salary) as salary FROM emp WHERE salary < (SELECT MAX(salary) FROM emp)";
    
        $query = $this->pdo->query($val);
        var_dump($query);
        foreach ($query as $row):
            echo $row['salary'].'<br />';
        endforeach;
    }
}

$pdo = new Salary();
$pdo->getData();