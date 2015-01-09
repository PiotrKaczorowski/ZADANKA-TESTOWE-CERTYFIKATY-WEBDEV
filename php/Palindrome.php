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
*/
class Palindrome {
 
    private static $aStr = array();
    private static $a = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą','ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
    private static $b = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a','s', 'l', 'z', 'z', 'c', 'n' );
    
    private function Parse($string) {
        $string = str_replace(self::$a, self::$b, $string);
        // If this modifier is set, letters in the pattern match both upper and lower case letters.
        // $string = preg_replace( '#[^a-z0-9]#i', '', $string );
        $string = preg_replace('#[^A-Za-z0-9]#', '', $string);
        // $string = preg_replace('#[\s]#', '' , $string);
        $string = strtolower($string);
        return $string;
    }

    public static function isPalindrome($str) {

        $str = self::Parse($str);
        self::$aStr = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
        
        $aStrCopy = self::$aStr;
        $i=0;
        
        while ($last = array_pop(self::$aStr)) {
            
            try {
                if ($aStrCopy[$i++] !== $last) {
                     throw new Exception('Not implemented');
                } 
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return false;
            }
        }
        return true;
        
    }
}

echo var_dump(Palindrome::isPalindrome('Noel sees Leon.'));   // Example case
echo var_dump(Palindrome::isPalindrome('lal'));               // Simple cases
echo var_dump(Palindrome::isPalindrome('Łał'));               // Edge cases
echo var_dump(Palindrome::isPalindrome('123 Łoł 321 ! .'));       // Complex cases



/*
 *  2 version
 *  100%


 
class Palindrome {
 
    private static $aStr = array();
    private static $a = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą','ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
    private static $b = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a','s', 'l', 'z', 'z', 'c', 'n' );
    
    /**
     * Parse string to English alphabet letters + numbers
     * 
     * @param type $string
     * @return string
     */
 /*
    private function Parse($string) {
        $string = str_replace(self::$a, self::$b, $string);
        // i - If this modifier is set, letters in the pattern match both upper and lower case letters.
        // $string = preg_replace( '#[^a-z0-9]#i', '', $string );
        $string = preg_replace('#[^A-Za-z0-9]#', '', $string);
        // $string = preg_replace('#[\s]#', '' , $string);
        $string = strtolower($string);
        return $string;
    }

    public static function isPalindrome($str) {

        $str = self::Parse($str);
        // pattern, $str , no limit = -1 , PREG_SPLIT_NO_EMPTY - usuwa białe znaki
        self::$aStr = preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);
        
       $aStrCopy = self::$aStr;
       $arStrCopy = array_reverse($aStrCopy);
       $wynik = array_diff_assoc($aStrCopy, $arStrCopy);

       if(!count($wynik)){
           return true;
       }else{
           return false;
       }
       
    }
}

echo var_dump(Palindrome::isPalindrome('ala.'));   // Example case
echo var_dump(Palindrome::isPalindrome('lal'));               // Simple cases
echo var_dump(Palindrome::isPalindrome('Łał'));               // Edge cases
echo var_dump(Palindrome::isPalindrome('123 Łoł 321 ! .'));       // Complex cases
 */