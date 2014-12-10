<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //http://www.testdome.com/Questions/PHP/NamesCount/762?testId=30&testDifficulty=Easy
        class NamesCount {

            private $count;
            private $counts = array();

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
echo $namesCount->nameProportion('Mary');

?>
    </body>
</html>
