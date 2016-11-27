<?php
/*
preg_grep
preg_last_error
preg_match_all
preg_match
preg_quote
preg_replace_callback
preg_split
 */

class PregReplace{
    
    private $aReg = array();

    /**
     * 
     * @return array result
     */
    private function prepareResult() {
        foreach($this->aReg as $string => $val){
            $aOut[] = preg_replace($val[0] , $val[1] , $string);
        }
        return $aOut;
        
    }
    /**
     * Add pattern to array
     * 
     * @param type $pattern
     * @param type $replacement
     * @param type $string
     * @return boolean
     */
    public function addArrayExpress($pattern , $replacement , $string) {
        $pattern = htmlspecialchars($pattern);
        $string  = htmlspecialchars($string);
        $this->aReg += array(
            $string => array($pattern , $replacement)
        );
        if(count($this->aReg)>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 
     * @return boolean
     */
    public function showResutls() {
        $results = $this->prepareResult();
        if(count($results)>0){
            echo '<table><tr><td style="border:1px black solid">Example 1</td><td style="border:1px black solid">Example 2</td><tr>';
            foreach($results as $val):
                echo '<td style="border:1px black solid">';
                    echo $val;
                echo '</td>';
            endforeach;    
            echo '</tr></table>';
        }else{
            return false;
        }
        return true;
    }
    
}

$myPregReplace = new PregReplace();
$myPregReplace->addArrayExpress('#http:\/\/(.*?)\.(.*?)\.(.*?)\/(.*?)\/(.*?)\/([0-9]?)#', '<br /><br />$0 <br /><br />$1 <br />$2 <br />$3 <br />$4 <br />$5 <br />$6 <br />$7', 'http://example.net.com/controller/action/3');
$myPregReplace->addArrayExpress('#<a href="(.*)" onclick="(.*)"> link (.*) ([0-9]+) ([0-9]*) ([a-z]ie.{1,2}) (.*)-([a-z]{3})</a>#', '<br /><br />$0 <br /><br />$1 <br />$2 <br />$3 <br />$4 <br />$5 <br />$6 <br />$7 <br />$8', '<a href="http://example.com/page/subpage/title" onclick="open(\'http://www.scratch24.com\'); return false;"> link do 434434 833 gierr gier-rrr</a>');
$myPregReplace->showResutls();


class PregMatch {
    
    function my_pregmatch($str) {
        $matches = array();
        if(preg_match('/([0-9])+/', $str, $matches )){
            return $matches;
        }else{
            return 'Nie pasuje do wzorca';
        }
    }
}

$pregmatch = new PregMatch;
//print_r($pregmatch->my_pregmatch('Janusz wisi Andrzejowi 125zł i powiedział, że odda za 2 lata.'));
preg_match('/(\d+)(\D+)(\d+)/', 'Janusz wisi Andrzejowi 125zł i powiedział, że odda za 2 lata.', $matches );
print_r($matches);