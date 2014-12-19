<?php
/*
 * 
Write a function that provides change directory (cd) function for an abstract file system.

Notes:
- Root path is '/'.
- Path separator is '/'.
- Parent directory is addressable as '..'.
- Directory names consist only of English alphabet letters (A-Z and a-z).

For example:
$path = new Path('/a/b/c/d');
echo $path->cd('../x')->currentPath;
should display '/a/b/c/x'.

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
        $string = preg_replace('#[^A-Za-z\\.\\/]#', '', $string);
        $string = strtolower($string);
        $string = str_replace('\\', '/' , $string);
        return $string;
    }

    public function cd($newPath = '') {
        
        $newPath = $this->Parse($newPath);
        
        $aNewPath = explode('/', $newPath);
        $aCurrentPath = explode('/', $this->currentPath);
        
        foreach ($aNewPath as $key => $val) {
            if ($val === '..') {
                array_pop($aCurrentPath); 
            } else {
                array_push($aCurrentPath, $val);
            }
        }
        
        $this->currentPath = implode('/', $aCurrentPath);
        
        if (substr($newPath, 0, 1) === '/') {
            $this->currentPath = $newPath;
        }
        
//       
     //   if ($newPath[0] === '.' && !isset($newPath[1])) {
     //       $this->currentPath = substr($this->currentPath , 0 , -1 );
     //   }

        if (substr($newPath, 0, 2) === './') {
            $this->currentPath = substr($this->currentPath , 0 , -2 );
        }

        return $this;
    }

}

//// For testing purposes (do not submit uncommented):
//
$path0 = new Path('/x/y/z/j/');
echo '<br />' . $path0->cd('/.x.')->currentPath;
//
$path1 = new Path('/x/y/z/j/');
echo '<br />' . $path1->cd('../../x')->currentPath;
//
$path2 = new Path('/x/y/z/j/');
echo '<br />' . $path2->cd('../y/./g')->currentPath;
//
$path3 = new Path('/x/y/z/j');
echo '<br />' . $path3->cd('./')->currentPath;
//
$path4 = new Path('/x/y/z/j');
echo '<br />' . $path4->cd('\\')->currentPath;
//echo $string = preg_replace('#[0-9]([A-Z]{0,2})#' , '$' , '9AB');