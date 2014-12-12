<?php

class AreAnagrams {

    public static function areStringsAnagrams($a, $b) {

        if (strlen($a) == strlen($b)) {
            $array = str_split($a);
            $string = $b;

            foreach ($array as $val) {
                if (strpos($string, $val) === false) {
                    return false;
                }
            }
        } else {
            return false;
        }

        return true;

        //throw new Exception('Waiting to be implemented.');
    }

}

// For testing purposes (do not submit uncommented):

echo AreAnagrams::areStringsAnagrams('momdad', 'dadmom') ? 'True' : 'False';
