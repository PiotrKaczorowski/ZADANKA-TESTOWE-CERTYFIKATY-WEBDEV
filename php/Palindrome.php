<?php
/*
 * 100%
 * 
 * Write a function that checks if a given sentence is a palindrome. A palindrome is a word, phrase, verse, 
 * or sentence that reads the same backward or forward. Only the order of English alphabet letters (A-Z and a-z) should be 
 * considered, other characters should be ignored. For example, Palindrome::isPalindrome(‘Noel sees Leon.’) should return 
 * true as spaces, period, and case should be ignored resulting with 'noelseesleon' which is a palindrome since
 * it reads same backward and forward.
* 

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
 