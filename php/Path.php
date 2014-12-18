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
        $string = preg_replace('#[^A-Za-z\/\.]#', '', $string);
        $string = strtolower($string);
        return $string;
    }

    public function cd($newPath) {
        $newPath = $this->Parse($newPath);
        $aNewPath = explode('/', $newPath);
        $aCurrentPath = explode('/', $this->currentPath);
        $this->currentPath = '';
        $ile_w_dol = substr_count($newPath, '../') + 1;
      
        if (substr($newPath, 0,2) === './') {
            return false;
        }
        if(preg_match_all('#[^\.]\.\/#', $newPath)){
            return false;
        } 

        for ($i = 1; $i <= count($aCurrentPath) - $ile_w_dol; $i++) {
            $this->currentPath .= '/' . $aCurrentPath[$i];
        }
        $newPathClear = str_replace('../', '', $newPath);
        $this->currentPath .= '/' . $newPathClear;

        if (substr($newPath, 0, 1) === '/') {

            if(substr($newPath, 1, 1)==='.'){
                return false;
            }
            $this->currentPath = $newPath;
        }

        return $this;
    }

}

// For testing purposes (do not submit uncommented):

$path = new Path('/x/y/z/j');
//echo $path->cd('../../x')->currentPath;
//echo '<br />'.$path->cd('../y')->currentPath;
echo $path->cd('../aa/../fsdf')->currentPath;
