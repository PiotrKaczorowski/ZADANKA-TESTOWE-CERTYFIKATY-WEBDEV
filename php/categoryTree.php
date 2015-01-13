<?php

/*
 * 
  sql
  /   \
  postgresql    oracle-----__
  |        /    |        \
  linux   solaris  linux   windows
  /     \
  glibc1   glibc2
 * 
 * 1)
 * create table categories (
 *  id serial, //autoincrementing int
 *  parent_id int8,
 *  name text not null default '',
 *  primary key (id)
 * );
 * 
 * create unique index ui_categorytable (parent_id , name);
 * alter table category add foreign key (parent_id) references categories (id);
 * 
 * 2)
 * create table categories2 (
 *  id BIGINT, 
 *  name text not null default '',
 *  primary key (id)
 * );
 * 
 * create table relationship (
 *  first_id BIGINT,
 *  second_id BIGINT,
 *  depth TINYINT,
 *  primary key (first_id , second_id)
 * );
 * 
 * alter table relationship add foreign key (first_id)  references categories2 (id);
 * alter table relationship add foreign key (second_id) references categories2 (id);
 * 
  sql
  /   \
  postgresql    oracle-----__
  |        /    |        \
  linux   solaris  linux   windows
  /     \
  glibc1   glibc2
 * catagory:
 * id | name                first_id|second_id|depth        first_id|second_id|depth  
 * ---------                ------------------------        ------------------------
 * 1  | sql                     1   |   2     |  1              1   |   1     |  0
 * 2  | postgresql              1   |   3     |  1              2   |   2     |  0
 * 3  | oracle                  1   |   4     |  2              3   |   3     |  0
 * 4  | linux                   1   |   5     |  2              4   |   4     |  0   
 * 5  | solaris                 1   |   6     |  2              5   |   5     |  0 
 * 6  | linux                   1   |   7     |  2              6   |   6     |  0
 * 7  | windows                 1   |   8     |  3              7   |   7     |  0
 * 8  | glibc1                  1   |   9     |  3              8   |   8     |  0
 * 9  | glibc2                  2   |   4     |  1              9   |   9     |  0
 *                              3   |   5     |  1
 *                              3   |   6     |  1
 *                              3   |   7     |  1
 *                              3   |   8     |  2
 *                              3   |   9     |  2  
 *                              6   |   8     |  1
 *                              6   |   9     |  1
 * 
 * Pole depth oznacza, o ile poziomów "głębiej" jest kategoria second od first.
 */

class DbConnect {

    private $_dns = 'mysql:host=localhost;dbname=categorytree';
    private $_username = 'root';
    private $_pass = '';
    protected $_oConn;

    protected function __construct() {
        if (!is_object($this->_oConn)) {
            try {
                $this->_oConn = new PDO($this->_dns, $this->_username, $this->_pass);
                // set transactions
                // you must have innodb engine
                $this->_oConn->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
                $this->_oConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
            } catch (PDOException $ex) {
                echo "Problem z połączeniem: " . $ex->getMessage() . 'linijka ' . $ex->getLine();
            }
        } else {
            return $this->_oConn;
        }
    }

}

class InsertData extends DbConnect {

    public function __construct() {
        parent::__construct();
    }

    public function create_exercise1() {
        $sQuery = "create table categories (
                        id mediumint NOT NULL AUTO_INCREMENT,
                        parent_id mediumint,
                        name varchar(100) not null default '',
                        primary key (id)
                    ) ENGINE = InnoDB;
        
        CREATE UNIQUE INDEX ui_categorytable ON categories (parent_id , name);
        alter table categories add foreign key (parent_id) references categories (id);";

        try {
            $this->_oConn->beginTransaction();
               $this->_oConn->exec($sQuery);
            $this->_oConn->commit();  
            echo "Proces wykonany pomyślnie";
        } catch (PDOException $ex) {
            $this->_oConn->rollBack();
            echo "Transakcje z funkcji create_exercise1 w pliku ". $ex->getFile() . " nie zostały zakończone pomyślnie: <br />" . $ex->getMessage();
        }
    }

    public function create_exercise2() {
        $sQuery1 = "create table categories3sddd (
                    id BIGINT, 
                    name text not null default '',
                    primary key (id)
                   ) ENGINE = InnoDB";

        $sQuery2 = "create tabaale relationship (
                    first_id BIGINT,
                    second_id BIGINT,
                    depth TINYINT,
                    primary key (first_id , second_id)
                   ) ENGINE = InnoDB";

        $sQuery3 = "alter table relationship add foreign key (first_id)  references categories2 (id)";
        $sQuery4 = "alter table relationship add foreign key (second_id) references categories2 (id)";
 
        //$this->_oConn->beginTransaction();
        $this->_oConn->query('BEGIN TRANSACTION');
        try {          
            for($i=1;$i<=4;$i++){
                $sVarName =  'sQuery' . $i;
                $query = $this->_oConn->prepare($$sVarName)->execute();
                if($query){
                    echo $query . "jest ok.<br />";
                }else{
                    echo $query . "have error.<br />";
                }                 
            } 
            echo "Proces wykonany pomyślnie";
        } catch (PDOException $ex) {
            //$this->_oConn->rollBack();
            $this->_oConn->query('ROOL BACK');
            echo "Transakcje z funkcji create_exercise2 w pliku ". $ex->getFile() . " nie zostały zakończone pomyślnie: <br />" . $ex->getMessage();
        }
        $this->_oConn->query('COMMIT');
        //$this->_oConn->commit();  
    }
}

class category extends dbconnect {

    public function __construct() {
        parent::__construct();
    }

    public function showTree() {
        
    }

}

$oData = new InsertData();
$oData->create_exercise2();
