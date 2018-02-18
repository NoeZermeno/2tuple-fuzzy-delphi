<?php

error_reporting(0);
$test = fopen('test.csv' ,'r');

$columnCount = 0;
$j = 0;
$array = [];

while(!feof($test)){

	$row = fgets($test);
	$cols= explode(';', $row);
	$array[] = $cols;

	if(strpos($row, 'criteria') !== false){
		$columnCount = count($cols);
		continue;
	}

	if(count($cols) != $columnCount){
		header("Location: errors.php?error_mensaje=0");
		exit();
		//continue;
	}

	echo "<br>";
	for($i = 2; $i <count($cols); $i++){
		if($cols[1] <= $cols[$i]) {
		 header("Location: import.html");
		 exit();
		}else echo " ss: " . $cols[1];
	}

} 
?>