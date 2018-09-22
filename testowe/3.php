<?php
class Palindrome
{	
    public static function convertString($str) {
       $str = preg_replace('#[^A-Za-z0-9]#' , '' , trim(strtolower($str)));
       return $str; 
    }

    public static function isPalindrome2018($str) {
         $str = self::convertString($str);
         return($str === strrev($str)) ? "true" : "false";
        
    }
}

echo Palindrome::isPalindrome2018('Noel sees L?eon.');
echo Palindrome::isPalindrome2018('ala.');   // Example case
echo Palindrome::isPalindrome2018('lalaa');               // Simple cases
echo Palindrome::isPalindrome2018('Łał');               // Edge cases
echo Palindrome::isPalindrome2018('123 Łoł 321 ! .');       // Complex cases


