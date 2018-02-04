<?php
$table = [];
$table[0]['num'] = 1;
$table[0]['item'] = 'item 1';
$table[0]['CC'] = 4.3;
$table[0]['CW'] = 4.2;
$table[0]['CP'] = 4.1;
$table[0]['CAS'] = 4.0;
$table[0]['score'] = 'score';
$table[0]['Total'] = 'Total';
$table[1]['num'] = 2;
$table[1]['item'] = 'item 2';
$table[1]['CC'] = 3.3;
$table[1]['CW'] = 3.2;
$table[1]['CP'] = 3.1;
$table[1]['CAS'] = 3.0;
$table[1]['score'] = 'score 2';
$table[1]['Total'] = 'Total 2';

print_r($table);
echo "<table border = 1>";
for($i = 0 ; $i<count($table); $i++){
	echo "<tr><td>" .$table[$i]['num']. "</td>" ;
	echo "<td>" .$table[$i]['item']. "</td>" ;
	echo "<td>" .$table[$i]['CC']. "</td>" ;
	echo "<td>" .$table[$i]['CW']. "</td>" ;
	echo "<td>" .$table[$i]['CP']. "</td>" ;
	echo "<td>" .$table[$i]['CAS']. "</td>" ;
	echo "<td>" .$table[$i]['score']. "</td>" ;
	echo "<td>" .$table[$i]['Total']. "</td></tr>" ;
}
echo "</table>";
?>