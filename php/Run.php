<?php

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
        $aRes = explode('/' , substr($string, 0 , -1));

        foreach($aRes as $key => $val){
            $tab[$key] = strlen($val);
        }
        
//        $max = max($tab);
//        $ile = count($tab);
//        while(--$ile){
//            if($tab[$ile] == $max){
//                $ok = $ile;
//            }
//        }
        $ok = array_keys($tab , max($tab));
        return strpos($str , $aRes[$ok[0]]);
    }

}

echo Run::indexOfLongestRun('aaaaabbbbbbbbbbbbcccccdaaaaaaaqqqqbbxa');
