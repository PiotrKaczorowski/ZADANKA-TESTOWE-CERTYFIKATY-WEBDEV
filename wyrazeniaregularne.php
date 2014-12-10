<html><body>
<?php
/*
preg_grep
preg_last_error
preg_match_all
preg_match
preg_quote
preg_replace_callback
preg_replace
preg_split
 */

function pr($a, $b, $c){
    return preg_replace($a, $b, $c);
}

for($i=0;$i<8;$i++){
    echo '<br />' .preg_replace('#http:\/\/(.*?)\.(.*?)\.(.*?)\/(.*?)\/(.*?)\/([0-9]?)#', '$'.$i, 'http://example.net.com/controller/action/3');
}

$string = '<a href="http://example.com/page/subpage/title" onclick="open(\'http://www.scratch24.com\'); return false;"> link do gier</a>';

//echo '<br />' .preg_replace('#http:\/\/(.*)\/page\/(.*)#', 'String 1: $1 and String $2', htmlspecialchars($string)); 
//echo '<br />' .preg_replace();    
    
    
$toPregReplace = array(
'http://example.com' =>     array('/http:\/\/(.*?)\.(.*)/', '$1'),
'http://example.net.com' => array('/http:\/\/(.*?)\.(.*)/', '$1'),
'http://example.com/page/subpage/title' => array('/(.*)\/(.*?)/', '$2'),
'<a href="blablabal" onclick="OPEN(\'http://example.com\');return false">ascasc</a>' => array('/<a(.*)?onclick="(.*?)"(.*)/', '$2'),
'<a href="blablabal" onclick="OPEN(\'http://example.com\');return false">ascasc2</a>' => array('/<a(.*)?onclick="OPEN\((.*?)\)(.*?)"(.*)/', '$2'),
'<a href="blablabal" onclick="OPEN(\'http://example.com\');return false">ascasc3</a>' => array('/(.*)?onclick="(.*?)\'(http:\/\/.*?)\'(.*)"(.*)/', '$3'),
'text{link{alert}}text' => array('/(.*)?{(.*?){(.*)}}(.*)?/', 'onclick="alert($3);">$2'),
'01-blablabal-05_45_12.mp3' => array('/([0-9]*)(.*?)([0-9_]*)\.(.*)/', '$1_$3'),
'01_blablabal_05_45_12.mp3' => array('/([0-9]*)(.*?)(_*)?([0-9_]*)\.(.*)/', '$1_$4'),
'34573645/blablabal____05_45_12.mp3' => array('/([0-9]*)(.*?)(_*)?([0-9_]*)\.(.*)/', '$1_$4'),
'34573645/blablabal__|__05_45_12.mp3' => array('/([0-9]*)(.*?)(_*)?([0-9_]*)\.(.*)/', '$1_$4'),

);

echo '<table border="1">';
$i=0;
foreach($toPregReplace as $k => $v){
    echo '<tr>';
    echo '<td>'.++$i.'</td>';
    echo '<td>'.htmlspecialchars($k).'</td>';
    echo '<td>'.htmlspecialchars($v[0])."</td>";
    echo '<td>'.htmlspecialchars($v[1])."</td>";
    echo '<td>'.pr($v[0], $v[1], $k).'</td>';
    echo '<td><pre>';
   
//    preg_match($v[0], $k, $matches);
//    foreach($matches as $k2=>$v2){
//        echo htmlspecialchars($k2)." => ".htmlspecialchars($v2)."<br>";
//    }
//   
   
    echo '</pre></td>';
    echo '</tr>';
}

echo '</table>';

echo '</body></html>';
