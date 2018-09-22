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
            $aFirstWord = str_split($a);
            $sSecondWord = $b;

            foreach ($aFirstWord as $val) {
                if (strpos($sSecondWord, $val) === false) return false;
                // delete only one character
                $sSecondWord = preg_replace("/{$val}/", '', $sSecondWord , 1);
            }
            return true;
        } else {
            return false;
        }
    }
}
echo AreAnagrams::areStringsAnagrams('momdad', 'ddmoam') ? 'True' : 'False';
