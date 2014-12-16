<?php
class Run
{

    public static function indexOfLongestRun($str)
    {  
        $aRes = array();
        $aStr = str_split($str);
        $i=1;
        foreach ($aStr as $key => $val) {
            
            if(($key!=0) && $aStr[$key-1] == $val) {
                    $aRes[$val] = ++$i;
            }else{
                $i = 1;
                $aRes[$val] = $i;
            }
        }
        $aRes2 = array_flip($aRes);
        
        return strpos( $str , $aRes2[max($aRes)]);
    }
 
}

// For testing purposes (do not submit uncommented):

echo Run::indexOfLongestRun('aaaaabccccccccd');
