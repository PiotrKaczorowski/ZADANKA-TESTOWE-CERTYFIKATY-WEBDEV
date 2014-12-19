<?php
/*
 *
Write a function that finds the zero-based index of the longest run in a string. A run is a consecutive sequence of the same character. If there is more than one run with the same length, return the index of the first one.
For example, Run::indexOfLongestRun(‘abbcccddddcccbba’) should return 6 as the longest run is dddd and it first appears on index 6.
 * 
 */
class Run {

    public static function indexOfLongestRun($str) {
        $string = '';      
        $aStr = str_split($str);
    
        foreach ($aStr as $key => $val) {
            if ((count($aStr)>$key+1) && ($aStr[$key+1] === $val)) {
                $string .= $val; 
            } else {
                $string .= $val.'/'; 
            }
        }
        unset($aStr);
        $aRes = explode('/' , substr($string, 0 , -1));
        unset($string);
//        foreach($aRes as $key => $val){
//            $tab[$key] = strlen($val);
//        }
        for($i=0;$i<count($aRes);$i++) {
            $tab[$i] = strlen($aRes[$i]);
        }
//        $max = max($tab);
//        $ile = count($tab);
//        while(--$ile){
//            if($tab[$ile] == $max){
//                $ok = $ile;
//            }
//        }
        $ok = array_keys($tab , max($tab));
        unset($tab);
        return strpos($str , $aRes[$ok[0]]);
    }

}

echo Run::indexOfLongestRun('aaaaabbbbbbbbbbbbcccccdaaaaaaaqqqqbbxa');
