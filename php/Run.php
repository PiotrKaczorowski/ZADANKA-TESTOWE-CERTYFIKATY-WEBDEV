<?php

class Run {

    public static function indexOfLongestRun($str) {
        $aRes = array();
        $aStr = str_split($str);
        foreach ($aStr as $key => $val) {
            if ($aStr[$key + 1] == $val) {
                $string .= $val; 
            } else {
                $string .= $val.'/'; 
            }
        }
        $string = substr($string, 0 , -1);
        $aRes = explode('/' , $string);
        //$aRes2 = array_flip($aRes);
        print_r($aRes);
        //return strpos($str, $aRes2[max($aRes)]);
    }

}

// For testing purposes (do not submit uncommented):

echo Run::indexOfLongestRun('aaaaabccccccdaaqqqqbbx');
