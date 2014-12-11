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

class regularexpress{
    
    private $aReg = array();

    /**
     * My preg replace function
     * 
     * @param type $pattern
     * @param type $replacement
     * @param type $string
     */
    private function prepareResult() {
        foreach($this->aReg as $string => $val){
            $aOut[] = preg_replace($val[0] , $val[1] , $string);
        }
        return $aOut;
        
    }
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
    public function showResutls() {
        $results = $this->prepareResult();
        if(count($results)>0){
            echo '<table><tr><td>Example 1</td><td>Example 2</td><tr>';
            foreach($results as $val):
                echo '<td>';
                    print_r($val);
                echo '</td>';
            endforeach;    
            echo '</tr></table>';
        }else{
            return false;
        }
        
    }
    
}

$myregexpr = new regularexpress();
$myregexpr->addArrayExpress('#http:\/\/(.*?)\.(.*?)\.(.*?)\/(.*?)\/(.*?)\/([0-9]?)#', '<br /><br />$0 <br /><br />$1 <br />$2 <br />$3 <br />$4 <br />$5 <br />$6 <br />$7', 'http://example.net.com/controller/action/3');
$myregexpr->addArrayExpress('#<a href="(.*)" onclick="(.*)"> link(.*)([0-9]*) ([0-9]*) ([a-z].e.*)</a>#', '<br /><br />$0 <br /><br />$1 <br />$2 <br />$3 <br />$4 <br />$5 <br />$6 <br />$7', '<a href="http://example.com/page/subpage/title" onclick="open(\'http://www.scratch24.com\'); return false;"> link do 434 833 gierr gierr</a>');
$myregexpr->showResutls();



//$string = '';
//$pattern = '';
//for($i=0;$i<8;$i++){
//    echo '<br /><br />' .preg_replace(htmlspecialchars($pattern), '$'.$i, htmlspecialchars($string)); 
//}
//    



//$toPregReplace = array(
//'http://example.com' =>     array('/http:\/\/(.*?)\.(.*)/', '$1'),
//'http://example.net.com' => array('/http:\/\/(.*?)\.(.*)/', '$1'),
//'http://example.com/page/subpage/title' => array('/(.*)\/(.*?)/', '$2'),
//'<a href="blablabal" onclick="OPEN(\'http://example.com\');return false">ascasc</a>' => array('/<a(.*)?onclick="(.*?)"(.*)/', '$2'),
//'<a href="blablabal" onclick="OPEN(\'http://example.com\');return false">ascasc2</a>' => array('/<a(.*)?onclick="OPEN\((.*?)\)(.*?)"(.*)/', '$2'),
//'<a href="blablabal" onclick="OPEN(\'http://example.com\');return false">ascasc3</a>' => array('/(.*)?onclick="(.*?)\'(http:\/\/.*?)\'(.*)"(.*)/', '$3'),
//'text{link{alert}}text' => array('/(.*)?{(.*?){(.*)}}(.*)?/', 'onclick="alert($3);">$2'),
//'01-blablabal-05_45_12.mp3' => array('/([0-9]*)(.*?)([0-9_]*)\.(.*)/', '$1_$3'),
//'01_blablabal_05_45_12.mp3' => array('/([0-9]*)(.*?)(_*)?([0-9_]*)\.(.*)/', '$1_$4'),
//'34573645/blablabal____05_45_12.mp3' => array('/([0-9]*)(.*?)(_*)?([0-9_]*)\.(.*)/', '$1_$4'),
//'34573645/blablabal__|__05_45_12.mp3' => array('/([0-9]*)(.*?)(_*)?([0-9_]*)\.(.*)/', '$1_$4'),
//
//);
//
//echo '<table border="1">';
//$i=0;
//foreach($toPregReplace as $k => $v){
//    echo '<tr>';
//    echo '<td>'.++$i.'</td>';
//    echo '<td>'.htmlspecialchars($k).'</td>';
//    echo '<td>'.htmlspecialchars($v[0])."</td>";
//    echo '<td>'.htmlspecialchars($v[1])."</td>";
//    echo '<td>'.pr($v[0], $v[1], $k).'</td>';
//    echo '<td><pre>';
//   
//    preg_match($v[0], $k, $matches);
//    foreach($matches as $k2=>$v2){
//        echo htmlspecialchars($k2)." => ".htmlspecialchars($v2)."<br>";
//    }
   
   
//    echo '</pre></td>';
//    echo '</tr>';
//}
//
//echo '</table>';
//
//
