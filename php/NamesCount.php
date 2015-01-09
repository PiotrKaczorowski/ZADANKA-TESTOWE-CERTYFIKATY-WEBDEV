<?php
/*
 *  100% 
 *  Fix the bugs.
  
 
class NamesCount
{
    private $count;
    private $counts = array();

    public function addName($name)
    {
        if (array_key_exists($name, $this->counts)) {
            $nameCount = $this->counts[$name];
        } else {
            $nameCount = 0;
            $this->counts[$name] = $nameCount;
        }

        $nameCount++;
        $this->count++;
    }
	
    public function nameProportion($name)
    {
        return $this->counts[$name] / $this->count;
    }
}
*/
class NamesCount {

            private $count;
            private $counts = array();

//            public function __construct() {    
//                if(array_key_exists('klucz' , array('klucz' => 'wartość'))){
//                 echo 'OK<br /><br />';
//                }
//            }
            public function addName($name) {
                if (array_key_exists($name, $this->counts)) {
                    $nameCount = $this->counts[$name];
                    $nameCount++;
                } else {
                    $nameCount = 1;
                }
                $this->counts[$name] = $nameCount;
                
                $this->count++;
            }

            public function nameProportion($name) {
                return $this->counts[$name] / $this->count;
            }
            

        }

// For testing purposes (do not submit uncommented):

$namesCount = new NamesCount;
$namesCount->addName('James');
$namesCount->addName('John');
$namesCount->addName('Mary');
$namesCount->addName('Mary');


echo $namesCount->nameProportion('John');
echo '<br />'.$namesCount->nameProportion('Mary');
?>

