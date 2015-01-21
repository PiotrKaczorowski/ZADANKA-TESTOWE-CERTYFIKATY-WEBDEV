<?php

/*
              sql
            /      \
  postgresql        oracle------
  |               /      |      \
  linux         solaris  linux   windows
                         /    \
                   glibc1   glibc2
 */

class DbConnect {

    private $_dns = 'mysql:host=localhost;dbname=categorytree';
    private $_username = 'categorytree';
    private $_pass = 's5PrXEy3LwVD6MDs';
    protected $_oConn;

    protected function __construct() {
        if (!is_object($this->_oConn)) {
            try {
                $this->_oConn = new PDO($this->_dns, $this->_username, $this->_pass);
                // set pl charset
                $this->_oConn->exec('SET CHARACTER SET utf8');
                // set transactions
                // you must have innodb engine
                $this->_oConn->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
                $this->_oConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {
                echo "Connection problem: " . $ex->getMessage() . '. <br />Line: ' . $ex->getLine();
            }
        } else {
            return $this->_oConn;
        }
    }

}

class DataTree extends DbConnect {

    public function __construct() {
        parent::__construct();
    }

    public function create_exercise1() {
        $sQuery = "create table categories (
                        id mediumint AUTO_INCREMENT,
                        parent_id mediumint,
                        name varchar(100) not null default '',
                        primary key (id)
                    ) ENGINE = InnoDB;
        
        CREATE UNIQUE INDEX ui_categorytable ON categories (parent_id , name);";
        //alter table categories add foreign key (parent_id) references categories (id);";

        try {
            $this->_oConn->exec($sQuery);
            echo "Proces wykonany OK.";
        } catch (PDOException $ex) {
            echo 'Problem w ' . $ex->getTrace()[1]['function'] . ' przy tworzeniu tabel. <br />Message: ' . $ex->getMessage() . "<br /><br />";
        }
    }

    /*
              1sql
            /      \
  2postgresql     3oracle------
  |               /      |      \
  4linux         5solaris  6linux   7windows
                           /    \
                      8glibc1   9glibc2
     * ********************************************************************************** 
     * catagory:                
     * id | parent_id/first_id | name                
     * ---------------------                
     * 1  |     0     | sql                 
     * 2  |     1     | postgresql          
     * 3  |     1     | oracle              
     * 4  |     2     | linux               
     * 5  |     3     | solaris             
     * 6  |     3     | linux               
     * 7  |     3     | windows             
     * 8  |     6     | glibc1              
     * 9  |     6     | glibc2  
     * 
     */

    public function insertExercise1() {

        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 1 , 0 , 'sql')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 2 , 1 , 'postgresql')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 3 , 1 , 'oracle')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 4 , 2 , 'linux')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 5 , 3 , 'solaris')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 6 , 3 , 'linux')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 7 , 3 , 'windows')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 8 , 6 , 'glibc1')";
        $aQuery[] = "INSERT INTO categories (id , parent_id , name) VALUES ( 9 , 6 , 'glibc2')";

        $this->_oConn->beginTransaction();
        try {
            foreach ($aQuery as $statement) {
                $this->_oConn->exec($statement);
            }
            $this->_oConn->commit();
            echo "Proces insertowania wykonany OK. <br />";
        } catch (PDOException $ex) {
            $this->_oConn->rollBack();
            echo 'Problem w ' . $ex->getTrace()[1]['function'] . ' przy insertowaniu do tabel. <br />Message: ' . $ex->getMessage() . "<br /><br />";
        }
    }

    public function create_exercise2() {
        $aQuery[] = "create table categories2 (
                    id BIGINT not null AUTO_INCREMENT, 
                    name text not null default '',
                    primary key (id)
                   ) ENGINE = InnoDB";

        $aQuery[] = "create table relationship (
                    first_id BIGINT,
                    second_id BIGINT,
                    depth TINYINT,
                    primary key (first_id , second_id)
                   ) ENGINE = InnoDB";

        $aQuery[] = "alter table relationship add foreign key (first_id)  references categories2 (id)";
        $aQuery[] = "alter table relationship add foreign key (second_id) references categories2 (id)";

        try {
            //$sVarName =  'sQuery' . $i;
            foreach ($aQuery as $statement) {
                //$query = $this->_oConn->prepare($$sVarName)->execute();
                $query = $this->_oConn->prepare($statement)->execute();
//                if($query){
//                    echo "The tables have been created<br />";
//                }else{
//                    echo "Something wrong with creating tables<br />";
//                }    
            }
            echo "Proces wykonany OK";
        } catch (PDOException $ex) {
            echo 'Problem w ' . $ex->getTrace()[1]['function'] . ' przy tworzeniu tabel. <br />Message: ' . $ex->getMessage() . "<br /><br />";
        }
    }

    /*
              sql
            /      \
  postgresql        oracle------
  |               /      |      \
  linux         solaris  linux   windows
                         /    \
                   glibc1   glibc2

     * ********************************************************************************** 
     * catagory:                relationship:
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

    public function insertExercise2() {

        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('sql')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('postgresql')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('oracle')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('linux')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('solaris')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('linux')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('windows')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('glibc1')";
        $aQuery[] = "INSERT INTO categories2 (name) VALUES ('glibc2')";

        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,1,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (2,2,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (3,3,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (4,4,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (5,5,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (6,6,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (7,7,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (8,8,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (9,9,0)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,2,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,3,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,4,2)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,5,2)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,6,2)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,7,2)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,8,3)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (1,9,3)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (2,4,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (3,5,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (3,6,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (3,7,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (3,8,2)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (3,9,2)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (6,8,1)";
        $aQuery[] = "INSERT INTO relationship (first_id , second_id , depth) VALUES (6,9,1)";


        $this->_oConn->beginTransaction();
        try {
            foreach ($aQuery as $statement) {
                $this->_oConn->exec($statement);
            }
            $this->_oConn->commit();
            echo "Proces insertowania wykonany OK. <br />";
        } catch (PDOException $ex) {
            $this->_oConn->rollBack();
            echo 'Problem w ' . $ex->getTrace()[1]['function'] . ' przy insertowaniu do tabel. <br />Message: ' . $ex->getMessage() . "<br /><br />";
        }
    }

}

class Category extends dbconnect {
    
    private $_tree = '';
    private $_treeTable = '';
    private $_aTree2 = '';
    private $_aTree3 = '';
    private $_aParseResult = array();
    
    public function __construct() {
        parent::__construct();
    }
    public function fillTableExercise2() {
        $query = $this->_oConn->prepare("SELECT first_id, second_id , cat.name as name , depth "
                . "FROM categories2 as cat INNER JOIN relationship as rs ON (cat.id = rs.second_id)"
                . "WHERE depth < 2" 
                . " ORDER BY second_id ASC");
//        $query = $this->_oConn->prepare("SELECT first_id, second_id , cat.name as name , cat.name as name , depth FROM relationship rs , categories2 cat "
//                . "WHERE cat.id = rs.second_id AND rs.depth = 1  ORDER BY second_id ASC");
        $query->execute();
        $aResult = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($aResult as $k => $v) {
                $this->_aParseResult[$v['first_id']][$v['second_id']] = $v;        
        }
         
        return $this->_aParseResult;
    }
    public function showTreeFromTabExercise2($first_id , $aResults) {
        if(count($aResults) && isset($aResults[$first_id])){
            $this->_aTree3 .= '<ul>';    
                foreach($aResults[$first_id] as $val) {
                     if($val['first_id']!=$val['second_id']){
                         $this->showTreeFromTabExercise2($val['second_id'] , $aResults);
                     }else{
                          $this->_aTree3 .= "<li><a href='{$_SERVER['PHP_SELF']}?firstId={$val['second_id']}' > {$val['name']} </a>";                     
                     }
                }
            $this->_aTree3 .= '</li></ul>';         
        }
        return $this->_aTree3;
    }
    public function fillTableExercise1() {
        $query = $this->_oConn->prepare("SELECT id, parent_id, name FROM categories ORDER BY id DESC");
        $query->execute();
        $aResult = $query->fetchAll(PDO::FETCH_ASSOC);
        $i = count($aResult);
        while($i--) {
            $aParseResult[$aResult[$i]['parent_id']][$aResult[$i]['id']] = $aResult[$i]['name'];          
        }    
      
        return $aParseResult;
    }
    public function showTreeFromTabExercise1($idParent,$aResults) {       
       
        $this->_treeTable .= '<ul>';    
            if(isset($aResults[$idParent])){
                foreach($aResults[$idParent] as $id => $name) {
                        $this->_treeTable .= "<li><a href='{$_SERVER['PHP_SELF']}?idParent={$id}' >  $name </a></li>";                     
                        $this->showTreeFromTabExercise1($id, $this->fillTableExercise1());
                }
            }
        $this->_treeTable .= '</ul>';         
        return $this->_treeTable;
    }
    public function showTreeExercise1($idParent) {    
        $query = $this->_oConn->prepare("SELECT name , id FROM categories WHERE parent_id = :parent_id ORDER BY id ASC");
        $query->bindValue(':parent_id', $idParent, PDO::PARAM_INT);
        if ($query->execute() && count($q = $query->fetchAll())) {           
            $this->_tree .= '<ul>';        
                foreach ($q as $key => $val) {
                    $this->_tree .= "<li><a href='{$_SERVER['PHP_SELF']}?idParent={$val['id']}' > {$val['name']} </a></li>";
                    if($val['id']!=$idParent){
                        $this->showTreeExercise1($val['id']);
                    }
                }
            $this->_tree .= '</ul>'; 
        } 
        return $this->_tree;
    }
}

$oData = new DataTree();
$oData->create_exercise1();
$oData->insertExercise1();
$oData->create_exercise2();
$oData->insertExercise2();

$oShow = new Category();

//if (isset($_GET['idParent'])) {
//    echo $oShow->showTreeExercise1($_GET['idParent']);
//    echo $oShow->showTreeFromTabExercise1($_GET['idParent'] ,$oShow->fillTableExercise1());   
//} else {
//    echo $oShow->showTreeExercise1(0);
//    echo $oShow->showTreeFromTabExercise1(0 , $oShow->fillTableExercise1());
//}

//if(isset($_GET['firstId'])) {
//     echo $oShow->showTreeFromTabExercise2($_GET['firstId'],$oShow->fillTableExercise2());
//}else{
//     echo $oShow->showTreeFromTabExercise2(1,$oShow->fillTableExercise2());
//}

