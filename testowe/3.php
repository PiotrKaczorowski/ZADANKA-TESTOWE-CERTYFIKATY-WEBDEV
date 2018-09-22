<?php
class Palindrome
{	
    public static function convertString($str) {
       $str = preg_replace('#[^A-Za-z0-9]#' , '' , trim(strtolower($str)));
       return $str; 
    }

    public static function isPalindrome2018($str) {
         $str = self::convertString($str);
         return($str === strrev($str)) ? true : false;
        
    }
}

var_dump(Palindrome::isPalindrome2018('Noel sees L?eon.'));


