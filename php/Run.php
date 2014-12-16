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
     //           if(!isset($aRes[$val])){
                    $aRes[$val] = ++$i;
      //          }
            }else{
                $i = 1;
                $aRes[$val] = $i;
            }
           
            
        }
        return $aRes;
        //throw new Exception('Not implemented');
    }
}

// For testing purposes (do not submit uncommented):

print_r(Run::indexOfLongestRun('aaaaabcccccd'));
