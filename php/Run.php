<?php

/*
 * ver 1 - 100%
 *
 * Write a function that finds the zero-based index of the longest run in a string. A run is a consecutive sequence of the same character. If there is more than one run with the same length, return the index of the first one.
 * For example, Run::indexOfLongestRun(‘abbcccddddcccbba’) should return 6 as the longest run is dddd and it first appears on index 6.
 * 

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

 */


/*
 * ver 2 - 100%
 * 
 */

class Run {

    /**
     * Create new string and push it to array
     * 
     * @param type string
     * @return array
     */
    private function strToArray($str) {
        $string = '';
        $aStr = str_split($str);

        foreach ($aStr as $key => $val) {
            // Protection before going out of the array index 
            // &&
            //end of repeated chars  - I can see by comparing the elements of n and n + 1
            if ((count($aStr) > $key + 1) && ($aStr[$key + 1] === $val)) {
                $string .= $val;
            } else {
                $string .= $val . '/';
            }
        }
        unset($aStr);
        return explode('/', substr($string, 0, -1));
    }

    /**
     * Counter of chars
     * 
     * @return array
     */
    private function changeLetterToNumber($aRes) {
        for ($i = 0; $i < count($aRes); $i++) {
            $tab[$i] = strlen($aRes[$i]);
        }
        return $tab;
    }

    public static function indexOfLongestRun($str) {
        $aRes = self::strToArray($str);
        $aValues = self::changeLetterToNumber($aRes);
        // give max key from table
        $maxKeys = array_keys($aValues, max($aValues));
        // find index 
        return strpos($str, $aRes[$maxKeys[0]]);
    }

}

echo Run::indexOfLongestRun('aaaaabbbbbbbbbbbbcccccdaaaaaaaqqqqbbxa');
