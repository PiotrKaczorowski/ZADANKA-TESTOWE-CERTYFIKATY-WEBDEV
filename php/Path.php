<?php

/* ver 1
 * 
 * <?php

  class Path {

  public $currentPath;
  private static $a = array('Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń');
  private static $b = array('E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n');

  function __construct($path) {
  $this->currentPath = $this->Parse($path);

  }

  private function Parse($string) {
  $string = str_replace(self::$a, self::$b, $string);
  $string = preg_replace('#[^A-Za-z\/\.]#', '', $string);
  $string = strtolower($string);
  return $string;
  }

  public function cd($newPath) {
  $newPath = $this->Parse($newPath);

  if(substr($newPath, 0,1) ==='/'){
  $this->currentPath = '/';
  }else{
  //if (strpos($newPath, '.') !== false) {
  $aNewPath = explode('/', $newPath);
  $valNewPath = count($aNewPath);
  $replace = $aNewPath[$valNewPath - 1];

  $aCurrentPath = explode('/', $this->currentPath);
  $valCurrentPath = count($aCurrentPath);
  $loops = $valCurrentPath - $valNewPath;

  $this->currentPath = '';
  for ($i = 1; $i <= $loops; $i++) {
  $this->currentPath .= '/' . $aCurrentPath[$i];
  }
  $this->currentPath .= '/' . $aNewPath[$valNewPath - 1];
  //}
  }
  return $this;

  }

  }

  // For testing purposes (do not submit uncommented):

  $path = new Path('/a/b/c/d');
  //echo $path->cd('../../x')->currentPath;
  //echo '<br />'.$path->cd('../y')->currentPath;
  var_dump($path->cd('../x')->currentPath);


 */

class Path {

    public $currentPath;
    private static $a = array('Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń');
    private static $b = array('E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n');

    function __construct($path) {
        $this->currentPath = $this->Parse($path);
    }

    private function Parse($string) {
        $string = str_replace(self::$a, self::$b, $string);
        $string = preg_replace('#[^A-Za-z\/\.\\\]#', '', $string);
        $string = strtolower($string);
        $wyn = preg_match('#(\/.[^.])?#', $string , $matches);
//        echo '<br /><br>';
//        echo $string;
//        print_r($matches);
//          echo '<br /><br>';
        return $string;
    }

    public function cd($newPath = '') {
        
        $newPath = $this->Parse($newPath);
        
        $aCdPath = explode('/', $newPath);
        $aCurrentPath = explode('/', $this->currentPath);
        
        foreach ($aCdPath as $key => $val) {
            if ($val === '..') {
                array_pop($aCurrentPath); // zdejmuje ostati
            } else {
                array_push($aCurrentPath, $val);
            }
        }
        
        $this->currentPath = implode('/', $aCurrentPath);
        
        if (substr($newPath, 0, 1) === '/' || substr($newPath, 0, 1) === '\\') {
            $this->currentPath = $newPath;
        }
        
       
        if ($newPath[0] === '.' && !isset($newPath[1])) {
            $this->currentPath = substr($this->currentPath , 0 , -1 );
        }
//        
//        if ($newPath[0] === '\\') {
//            $this->currentPath = false;
//        }
//        
        if (substr($newPath, 0, 2) === './') {
            $this->currentPath = substr($this->currentPath , 0 , -2 );
        }

        return $this;
    }

}

// For testing purposes (do not submit uncommented):

$path0 = new Path('/x/y/z/j');
echo '<br />' . $path0->cd('/.x.')->currentPath;

$path1 = new Path('/x/y/z/j');
echo '<br />' . $path1->cd('../../x')->currentPath;

$path2 = new Path('/x/y/z/j');
echo '<br />' . $path2->cd('../y')->currentPath;

$path3 = new Path('/x/y/z/j');
echo '<br />' . $path3->cd('./')->currentPath;

$path4 = new Path('/x/y/z/j');
echo '<br />' . $path4->cd('\\')->currentPath;