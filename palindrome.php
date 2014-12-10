<?php
class Palindrome {
 
    private static $aStr = array();
    private static $a = array( 'Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą','ś', 'ł', 'ż', 'ź', 'ć', 'ń' );
    private static $b = array( 'E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a','s', 'l', 'z', 'z', 'c', 'n' );
    
    private function Parse( $string )
	{
		$string = str_replace( self::$a ,  self::$b, $string );
                // If this modifier is set, letters in the pattern match both upper and lower case letters.
                // $string = preg_replace( '#[^a-z0-9]#i', '', $string );
		$string = preg_replace( '#[^A-Za-z0-9]#', '', $string ); 
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
//header('Content-type: text/html; charset=iso-8859-2');
//setlocale(LC_ALL, 'Polish_Poland.28592');
//$zm = 'zŁY';
//$ok = iconv("iso-8859-2", 'utf-8' , $zm);
//$ok = strtolower($zm);

//echo $ok;
echo var_dump(Palindrome::isPalindrome('Noel sees Leon.'));   // Example case
echo var_dump(Palindrome::isPalindrome('lal'));               // Simple cases
echo var_dump(Palindrome::isPalindrome('Łał'));               // Edge cases
echo var_dump(Palindrome::isPalindrome('123 Łoł 321 ! .'));       // Complex cases