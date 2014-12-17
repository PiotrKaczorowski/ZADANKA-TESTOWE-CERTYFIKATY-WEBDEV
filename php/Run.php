<?php

class Run {

    public static function indexOfLongestRun($str) {
        $aRes = array();
        $string = '';
        
        $aStr = str_split($str);
        foreach ($aStr as $key => $val) {
            if ((count($aStr)>$key+1) && ($aStr[$key+1] === $val)) {
                $string .= $val; 
            } else {
                $string .= $val.'/'; 
            }
        }
        $string = substr($string, 0 , -1);
        $aRes = explode('/' , $string);
        //$aRes2 = array_flip($aRes);
        foreach($aRes as $key => $val){
            $tab[$key] = strlen($val);
        }
        //return $aStr;
        $max = max($tab);
        $ile = count($tab);
        while(--$ile){
            if($tab[$ile] == $max){
                $ok = $ile;
            }
        }
        return strpos($str , $aRes[$ok]);
    }

}

// For testing purposes (do not submit uncommented):

echo Run::indexOfLongestRun('aaaaabbbbbbbbbbbbcccccdaaaaaaaqqqqbbx');
