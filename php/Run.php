<?php
class Run
{

    public static function indexOfLongestRun($str)
    {  

        $aStr = str_split($str);
        $i=1;
        foreach ($aStr as $key => $val) {
            
            if($key!=0 && ($aStr[$key-1] == $val)) {
                
//                if(count($aResult[$val])){
//                    $aResult2[$val] = ++$i;
//                    if(count($aResult2[$val])>count($aResult2[$val])){
//                        $aResult = $aResult2;
//                    }
               // }else{
                $all = array( 
                    $key => array($aResult[$val] => ++$i)
                );
               //    }
                
            }else{
                $i = 1;
            }
           
            
        }
        return $all;
        //throw new Exception('Not implemented');
    }
}

// For testing purposes (do not submit uncommented):

print_r(Run::indexOfLongestRun('aaaaaaccccccccaabbccccddddccccccbbaaa'));
