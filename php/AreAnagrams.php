<?php
/*
 * 100%
 * 
 * An anagram is a word formed from another by rearranging its letters, using all the original letters exactly once; 
 * for example, orchestra
 * can be rearranged into carthorse. Write a function that checks if two words are each other's anagrams.
 * For example, AreAnagrams::areStringsAnagrams('momdad', 'dadmom') should return true as arguments are anagrams.
 * 
 */
class AreAnagrams {

    public static function areStringsAnagrams($a, $b) {

        if (strlen($a) == strlen($b)) {
            $array = str_split($a);
            $string = $b;

            foreach ($array as $val) {
                if (strpos($string, $val) === false) return false;
                $string = preg_replace("/{$val}/", '', $string , 1);
                //$string = str_replace($val, "", $string);
                echo $string . '<br>';
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
