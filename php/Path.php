<?php
/*
 *  100%
 * 
 * Write a function that provides change directory (cd) function for an abstract file system.
 * Notes:
 * - Root path is '/'.
 * - Path separator is '/'.
 * - Parent directory is addressable as '..'.
 * - Directory names consist only of English alphabet letters (A-Z and a-z).
 * 

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
        $string = preg_replace('#[^A-Za-z\/\.\\\]#', '', $string);
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
        
        if (substr($this->currentPath, 0, 1) !== '/') {
            $this->currentPath = '/' . $this->currentPath ;
        }
        return $this;
    }

}
$path = new Path('/a');
echo '<br />' . $path->cd('../../../../b')->currentPath;
