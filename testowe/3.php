<?php
class Palindrome
{	
    public static function convertString($str) {
       $str = preg_replace('#[^A-Za-z0-9]#' , '' , trim(strtolower($str)));
       return $str; 
    }
    public static function isPalindrome($str) {
         $str = self::convertString($str);
         return($str === strrev($str)) ? true : false;
        
    }
}
// For testing purposes (do not submit uncommented):
var_dump(Palindrome::isPalindrome('Noel sees L?eon.'));


