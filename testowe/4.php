<?php
class AreAnagrams
{
    public static function areStringsAnagrams($a, $b)
    {
        $aA = str_split($a);
        $aB = str_split($b);
        if(strlen($a) == strlen($b)){
//        foreach($aA as $k => $val) {
            while($lastValue = array_pop($aA)){
                    if(!(($pos = strpos($b , $lastValue))!==false)) {
                    return false;
                    
                }
            }
        } else{ 
            return false;
            
        } 
        return true;
//        }
    }
}

// For testing purposes (do not submit uncommented):

echo AreAnagrams::areStringsAnagrams('momdad', 'dadmom') ? 'True' : 'False';
