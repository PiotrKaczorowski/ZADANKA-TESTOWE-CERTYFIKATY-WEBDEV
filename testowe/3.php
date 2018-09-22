<?php
class Palindrome
{	
    public static function convertString($str) {
       $str = preg_replace('#[^A-Za-z0-9]#' , '' , trim(strtolower($str)));
       return $str; 
    }
//  public static function isPalindrome($str)
//  {
//        $str = self::convertString($str);
//        $aStr = str_split($str);
//        $aRevStr = array_reverse($aStr);
//        $aDiffs = array_diff_assoc($aStr, $aRevStr); 
//
//        if(!count($aDiffs)){
//            return false;
//        }
//        
//        return true;
//  }
    public static function isPalindrome2018($str) {
         $str = self::convertString($str);
         return($str === strrev($str)) ? true : false;
        
    }
}
var_dump(Palindrome::isPalindrome2018('Noel sees L?eon.'));


