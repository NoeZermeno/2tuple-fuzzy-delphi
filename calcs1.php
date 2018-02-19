<!DOCTYPE html>
<html lang="en">
<head>
	<?php

	if (!isset($_POST['submit'])) {
		header('Location: index.html');
	}
	$max = 7;
	$total = 0;

	$table = [];

	?>
	<meta charset="UTF-8">
	<title>GRID</title>
	<link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/menu_tools_style.css">

	<link rel="stylesheet" href="CSS/style_trim.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link href="https://file.myfontastic.com/VDXsxxmWcbZZG8xXax2UK4/icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<script type="text/javascript" src="JS/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
        //Filter for the Trim tool: Filters the data table according to the selected color (button).
        function fun(value) {
        	for (var x = 1; x < 7; x++) {
        		if (x < value) {
        			$('#datos td.level' + x).parent('tr').addClass('hidden');
        		}
        		else {
        			$('#datos td.level' + x).parent('tr').removeClass('hidden');
        		}
        	}
        }

        function show_valueS(x) {
        	document.getElementById("CI").innerHTML = x;
        }

        function show_valueE(x) {
        	document.getElementById("EC").innerHTML = x;
        }
        // Filter visualization options: allows filtering according to the selected criteria.
        function hideColumns(sel) {
        	if (sel == 0) {
        		for (var i = 1; i <= 6; i++) {
        			$('.col_' + i).show();
        		}
        	} else {
        		for (var i = 1; i <= 6; i++) {
        			$('.col_' + i).hide();
        		}
        		$('.col_' + sel).show();
        	}
        }
    </script>
    <script type="text/javascript">
    	$(document).ready(function () {
    		var oTablaDatos = $('#datos').DataTable({
    			"scrollResize": true
    			, "scrollY": 250
    			, "scrollCollapse": true
    			, "paging": false
    			, "order": [
    			[0, "asc"]
    			]
    			, "searching": true
    			, "columnDefs": [{
    				"targets": [1]
    				, "visible": true
    			}]
    		});
    	});
    </script>
</head>

<body>
	<?php
/*
	if (!isset($_POST['submit'])) {
		header('Location: index.html');
	}*/

	if (!isset($_POST['submit'])) {
		header('Location: index.html');
	}

	if(isset($_POST['heading1'])){
    		$check1 = $_POST['heading1']; #check if the header was selected, value = 1
		}else{
    		$check1 = 0;#if it was not selected, value = 0
		}

	if(isset($_POST['heading2'])){
    		$check2 = $_POST['heading2']; #check if the header was selected, value = 1
		}else{
    		$check2 = 0;#if it was not selected, value = 0
		}

	if(isset($_POST['heading3'])){
    		$check3 = $_POST['heading3']; #check if the header was selected, value = 1
		}else{
    		$check3 = 0;#if it was not selected, value = 0
		}

	$responses = $_FILES["file1"]["tmp_name"];
	$description = $_FILES["file2"]["tmp_name"];
	$dimensions = $_FILES["file3"]["tmp_name"];
	$output_scale = 7;
	$table_collective = [];
/*$levels = '<table id="levels">';
$levels .= '<tr>';
$count = '';
for ($x = 1; $x <= $max; $x++) {
	$levels .= '<td class="nivel' . $x . '">' . 's<sub>' .$x. '</sub>'.  '</td>';
}
$levels .= '</tr>';
$levels .= '</table>';*/

class Judge
{
	private $items = [];
	private $weight;
	private $scale;

	//propiedades
	public function setweight($weight) { $this->weight = $weight;}
	public function getweight()	{ return $this->weight;	}
	public function setscale($scale) {	$this->scale = $scale; }
	public function getscale() { return $this->scale;}
	public function addItem($item) 	{ $this->items[] = $item;}
	public function Items() { return $this->items; }
	public function Item($index) { return $this->items[$index]; }
	public function ItemsCount() { return count($this->items); }
}

class Item
{
	private $clarity=0;
	private $writing=0;
	private $belonging=0;
	private $scale = 0;
	private $weight = 0;
	private $sScale = 0;

	public function setClarity($value) { $this->clarity = $value; }
	public function getClarity() { return $this->clarity; }
	public function setWriting($value) { $this->writing = $value; }
	public function getWriting() { return $this->writing; }
	public function setBelonging($value) { $this->belonging = $value; }
	public function getBelonging() { return $this->belonging; }
	public function setScale($value) { $this->scale = $value; }
	public function getScale() { return $this->scale; }
	public function setWeight($value) { $this->weight = $value; }
	public function getWeight() { return $this->weight; }
	public function setSelectionScale($value) { $this->sScale = $value;	}
	public function getSelectionScale() { return $this->sScale;	}
}

class Dimention {
	public $questions  = [];
	public $judgeValue = [];
	public $begin;
	public $end;

	public function setBegin($value) { $this->begin = $value; }
	public function getBegin() { return $this->begin }

	public function setBegin($value) { $this->end = $value; }
	public function getBegin() { return $this->end }

	public function getJudgeValues() { return $this->judgeValue; }
	public function getJudgeValue($index) { return $this->judgeValue[$index];}
}

function mid_point($str){
	$c = explode(',',max_min($str));
	return round(($c[0] + $c[1])/2);
}

function max_min($str){
	$array = explode (',', $str);
	$c = [];
	$c[] = min($array);
	$c[] = max($array);
	return implode(',', $c);
}

function v_scale($judges)
{
	$vector = [];
	foreach($judges as $judge){
		$vector[] = $judge->getscale();
	}

	$vector2 = [];
	asort($vector);
	$vector = array_unique($vector);

	foreach ($vector as $num) {
		$vector2[] = $num;
	}

	return array_unique($vector2);
}

function getHigherSelectionScale($judges)
{
	$higher = 0;
	foreach($judges as $judge){
		$scale = $judge->getscale();
		if($scale > $higher){
			$higher = $scale;
		}
	}
	return $higher;
}

function getSelectionScale($item)
{
	return $judge->getScale();
}

function Normalize($values, $CurrentSelectionScale, $MaxSelectionScale)
{
	$result = 0;
	$result = $values * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1);
	return $result;
}

function ArrayToString($value)
{
	if(is_array($value[0])){
		return implode(',', $value[0]);
	}
	else
	{
		return implode(',', $value);
	}
}

function completeTuple($value,$sel)
{
	$a = explode(',',$value);
	$c = [];
	for($i = 0;$i < count($a); $i++ ){
		$c[] = '(' . elementOfSet($a[$i], $sel) . ')';
	}
	return implode(',', $c);
}

function Tuple($value)
{
	if(is_array($value[0])){
		return implode(',', $value[0]);
	}
	else
	{
		$value = implode('', $value);
		return "$value";
	}
}

function elementOfSet($value, $sel)
{
	$a = explode(',',$value);
	$c = [];
	for($i = 0;$i < count($a); $i++ ){
		if(strpos($a[$i],'.')){
			$c[] = 's<sub>' . round($a[$i]) . '</sub><sup>' . $sel . '</sup>, ' . round(($a[$i] - round($a[$i])),2);
		}else {
			$c[] = 's<sub>' . $a[$i] . '</sub><sup>' . $sel . '</sup> ' . ',0';
		}
	}
	return implode(',', $c);
}


function TupleAdd($value1, $value2)
{
	$c = 0;
	$c = $value1 + $value2;
	return $c;
}

function TupleDiv($value, $div)
{
	$c= 0;
	$c = $value / $div ;
	return  $c;
}

function TupleLinguisticDiv($value)
{
	$values = explode(',', $value);
	$items  = [];
	foreach($values as $item){
		$i = (int)$item;
		$d = fmod($item, 1) * 100;
		if($d > 40){
			$i += 1;
			$d = 100 - $d;
			$items[] = "($i,-.$d)";
		}
		else
		{
			$items[] = "($i,.$d)";
		}
	}
	return implode(',', $items);
}


$judges            = [];
$normalized_judges = [];
$dimentions        = [];

error_reporting(0);
$hEvaluation       = fopen($responses ,'r');  //Open responses file
$hDimentions       = fopen($dimensions, 'r');	//Open dimension file
$hQuestionnaire    = fopen($description, 'r');  //Open description file

error_reporting(1);

$columnCount= 0;
$j = 0;
if ($check1 == 1) {
	while(!feof($hEvaluation))
	{	$row = fgets($hEvaluation);
		$cols= explode(';', $row);

		if(strpos($row, 'criteria') !== false){
			$columnCount = count($cols);
			continue;
		}

		if(count($cols) != $columnCount){
			header("Location: errors.php?error_mensaje=0");
			exit();
			//continue;
		}

		$judge = new Judge();
		$judge->setscale($cols[1]);

		for($i = 2 ; $i < count($cols); $i += 5){
			$item = new Item();
			$item->setClarity(mid_point(max_min($cols[$i])));
			$item->setWriting(mid_point(max_min($cols[$i + 1])));
			$item->setBelonging(mid_point(max_min($cols[$i + 2])));
			$item->setScale(mid_point(max_min($cols[$i + 3])));
			$item->setWeight($cols[$i + 4]);
			$judge->addItem($item);
		}
		$judges[] = $judge;
	}
} elseif($check1 == 0){
	while(!feof($hEvaluation))
	{	$row = fgets($hEvaluation);
		$cols= explode(';', $row);

		$judge = new Judge();
		$judge->setscale($cols[1]);
		if(strpos($row, 's' ) !== false){
					$columnCount = count($cols);
					header("Location: errors.php?error_mensaje=3");
					exit();
				}

		for($i = 2 ; $i < count($cols); $i += 5){
			$item = new Item();
			$item->setClarity(mid_point(max_min($cols[$i])));
			$item->setWriting(mid_point(max_min($cols[$i + 1])));
			$item->setBelonging(mid_point(max_min($cols[$i + 2])));
			$item->setScale(mid_point(max_min($cols[$i + 3])));
			$item->setWeight($cols[$i + 4]);
			$judge->addItem($item);
		}
		$judges[] = $judge;
	}
}

$dimentions = [];
if($hDimentions !== false){
	$columnCount = 0;
	$begin = [];
	$end = [];
	while(!feof($hDimentions)){

		$acum = 0;
		$weightJ = [];
		$row = fgets($hDimentions);
		$cols= explode(';', $row);

		//We determine by means of the number of columns in the first row whether the number of judges matches the number of previously processed judges.
		if((count($cols) - 3) !== count($judges) ){
			//we remove 3 columns from the calculation because they have dimensional data
			header("Location: errors.php?error_mensaje=1");
			exit();
		}

		if(strpos($row, 'dimension') !== false){
			$columnCount = count($cols);
			continue;
		}

		if(count($cols) != $columnCount){
			continue;
		}

		$begin = $cols[1];
		$end = $cols[2];
		$dimention = new Dimention();
		//$dimention->questions = &question;//where the questionnaire will be saved remains to be determined

		for ($i = 3; $i < $columnCount; $i++) {
			$value = $cols[$i];
			$weightJ[] = $value;
			$acum += $value;
		}

		for ($i = 0 ; $i <count($weightJ); $i++){
			$dimention->judgeValue[] = ($weightJ[$i]/$acum);
		}
		$dimentions[] = $dimention;
		e
	}
}
else{
	$dimention = new Dimention();
	$dimention->begin = 1;
	$dimension->end = $judges->ItemsCount();
	for ($i = 0 ; $i < count($judges); $i++){
		$dimention->judgeValue[] = 1/count($judges);
	}
	$dimentions[] = $dimention;
	echo "Inicio: " . $dimention->begin . "<br>";
	echo "End: " . $dimention->end . "<br>";
}

$total =  $judges[0]->ItemsCount();
//echo "hQuestionnaire : " . $hQuestionnaire . "<br>";
//$table = [];
if($hQuestionnaire !== false){
	$rowsCount = 0;
	$items = [];
	global $table;

	while(!feof($hQuestionnaire)){
		$rows++;
		$items[] = utf8_encode(fgets($hQuestionnaire));
	}

	if($judges[0]->ItemsCount() == $rows){
		$table['item'] = array_merge($table,$items);
	}else{
		header("Location: errors.php?error_mensaje=2");
		exit();
	}
}else{
	$items = [];
	global $total;
	$total = $judges[0]->ItemsCount();
	for($i = 1; $i <= $judges[0]->ItemsCount();$i++){
		$items[] = 'I<sub>' . $i . '</sub>';
	}
	$table['item'] = array_merge($table,$items);
}


function mcd($a,$b) {

	while (($a % $b) != 0) {
		$c = $b;
		$b = $a % $b;
		$a = $c;
	}
	return $b;
}

function mcm($a,$b) {
	return ($a * $b) / mcd($a,$b);
}

$HSS = getHigherSelectionScale($judges);

function mcm_judges($judges){
	$lcm = 0;
	$vector = v_scale($judges);
	if(count($vector)>2){
		$fst =  mcm(($vector[0]-1),($vector[1]-1));
		return  mcm($fst,($vector[2]-1));
	}else{
		return  mcm(($vector[0]-1),($vector[1]-1));
	}
}

function weight_criteria($value, $value2){
	$c   = [];
	if(strpos($value1,',')){
		$a   = explode(',', $value);
		$c[] = $a[0] * $value2 ;
		$c[] = $a[1] * $value2 ;
		return implode(',',$c);
	}
	$c = $value * $value2 ;
	return $c;
}

function score($value){
	$a   = explode(',', $value);
	$b   = explode(',', $value2);
	$c   = [];
	$c[] = ($a[0] )/2;
	$c[] = ($a[1] + $b[0])/2;
	return implode(',', $c);
}

function level($str){
	$rounded  = round($str);
	switch($rounded){
		case 0:
		{	echo "1";
			//return "(Pésimo, " . round(($str - $rounded),2) . ")";
		}
		break;
		case 1: {echo "2";
			//return "(Muy incorrecto, ". round(( $str - $rounded),2) . ")";
		}
		break;
		case 2: {echo "3";
			//return "(Incorrecto, ". round(( $str - $rounded),2) . ")";
		}
		break;
		case 3: {echo "4";
			//return "(Moderado, ". round(( $str - $rounded),2) . ")";
		}
		break;
		case 4: {echo "5";
			//return "(Correcto, ". round(( $str - $rounded ),2) . ")";
		}
		break;
		case 5: {echo "6";
			//return "(Muy Correcto, ". round(($str - $rounded  ),2) . ")";
		}

		break;
		case 6: {echo "7";
			//return "(Excelente, ". round(( $str - $rounded),2) . ")";
		}
		break;
	}
}

function lLabel($str){
	$rounded  = round($str);

	switch($rounded){
		case 0:
		{	//echo "1";
			return "(Dreadful, " . round(($str - $rounded),2) . ")";
		}
		break;
		case 1: {//echo "2";
			echo "(Very Incorrect, ". round(( $str - $rounded),2) . ")";
		}
		break;
		case 2: { //echo "3";
			echo "(Incorrect, ". round(( $str - $rounded),2) . ")";
		}
		break;
		case 3: { //echo "4";
			echo "(Moderate, ". round(( $str - $rounded),2) . ")";
		}
		break;
		case 4: { //echo "5";
			echo "(Correct, ". round(( $str - $rounded ),2) . ")";
		}
		break;
		case 5: {//echo "6";
			echo "(Very Correct, ". round(($str - $rounded  ),2) . ")";
		}

		break;
		case 6: {
			echo "(Excelent, ". round(( $str - $rounded),2) . ")";
		}
		break;
	}
}

$mcm = mcm_judges($judges)+1;
if($mcm < 12) { $mcm = 13;}

foreach($judges as $judge){
	$normalized_judge = new Judge();
	$CSS              = $judge->getscale();
	foreach($judge->Items() as $item){
		//echo "mcm: " . $mcm . "<br>";

		$normalized_item = new Item();							//$mcm
		$newValue        = Normalize($item->getClarity(), $CSS, $mcm);
		$normalized_item->setClarity( $newValue );				//$mcm
		$newValue        = Normalize($item->getWriting(), $CSS, $mcm);
		$normalized_item->setWriting( $newValue );				//$mcm
		$newValue        = Normalize($item->getBelonging(), $CSS, $mcm);
		$normalized_item->setBelonging( $newValue );			//$mcm
		$newValue        = Normalize($item->getScale(), $CSS, $mcm);
		$normalized_item->setScale( $newValue );
		$normalized_item->setWeight($item->getWeight());
		$normalized_item->setSelectionScale($item->getSelectionScale());
		$normalized_judge->addItem($normalized_item);
	}
	$normalized_judges[] = $normalized_judge;
}

$aJudge    = $normalized_judges[0];
$itemCount = $aJudge->ItemsCount();
$rowCount  = count($judges);


//echo '<div id="etapa1">';
for($j = 0; $j < $itemCount; $j++){
//	echo '<table border=1 class="tabla .modo1">';
//	echo '<tr><th class="th_question" colspan="6">' . ($j + 1) . ": " . $table['item'][$j] .  '</th></tr>';
//	echo '<tr class="alt tr_criteria"><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th><th>Relevance</th></tr>';
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);

		$clarity   = $item->getClarity();
		$writing   = $item->getWriting();
		$belonging = $item->getBelonging();
		$scale     = $item->getScale();
		$relevance = $item->getWeight();

//		echo "<tr><td>J" . ($i + 1) . "</td><td>" . round($clarity,2)  . "</td><td>" . round($writing,2) ."</td><td>" . round($belonging,2)  . "</td><td>" . round($scale,2) . "</td></tr>";
	//	echo "<tr><td>J" . ($i + 1) . "</td><td>" . completeTuple($clarity, 7)  . "</td><td>" . completeTuple($writing, 7)   ."</td><td>" . completeTuple($belonging, 7)   . "</td><td>" . completeTuple($scale, 7)  . "</td><td>" . $relevance  . "</td></tr>";
		//echo "<tr><td>J" . ($i + 1) . "</td><td>" . completeTuple($clarity, $mcm)  . "</td><td>" . completeTuple($writing, $mcm)   ."</td><td>" . completeTuple($belonging, $mcm)   . "</td><td>" . completeTuple($scale, $mcm)  . "</td><td>" . $relevance  . "</td></tr>";
	}


//	echo '</table>';
}
//echo '</div>';


for($j = 0; $j < $itemCount; $j++){
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);
		$clarity   = Tuple($item->getClarity());
		$writing   = Tuple($item->getWriting());
		$belonging = Tuple($item->getBelonging());
		$scale     = Tuple($item->getScale());
		$relevance     = $item->getWeight();
	}
}


$clarities 	= [];
$writings  	= [];
$belongings	= [];
$scales    	= [];
$relevance  = [];

for($j = 0; $j < $itemCount; $j++){

	$sClarity     = '0';
	$sWriting     = '0';
	$sBelonging   = '0';
	$sScale       = '0';
	$sRelevance   = '0';
	$judge_weight = [];

	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);
		$clarity   = weight_criteria($item->getClarity(),$dimentions[0]->judgeValue[$i]);
		$sClarity  = TupleAdd($sClarity, $clarity);
		$writing   = weight_criteria($item->getWriting(),$dimentions[0]->judgeValue[$i]);
		$sWriting  = TupleAdd($writing, $sWriting);
		$belonging   = weight_criteria($item->getBelonging(),$dimentions[0]->judgeValue[$i]);
		$sBelonging= TupleAdd($belonging, $sBelonging);
		$scale   = weight_criteria($item->getScale(),$dimentions[0]->judgeValue[$i]);
		$sScale    = TupleAdd($scale, $sScale);
		$relevance   = round($item->getWeight()*$dimentions[0]->judgeValue[$i],3);
		$sRelevance  = TupleAdd($relevance, $sRelevance);
	}

	$clarities[] = $sClarity;
	$writings[] = $sWriting;
	$belongings[] = $sBelonging;
	$scales[] = $sScale;
	$relevances[] = $sRelevance;
}

//echo '<table id="final" border=1 class="tabla">';
//echo '<tr class="alt"><th colspan="7">Agregation</th></tr>';
//echo '<tr ><th>Item</th><th>Clarity</th><th>Writing</th><th>   Presence   </th><th>   Scale   </th><th>   Score   </th><th>   Relevance  </th></tr>';
$sScore = [];
$question = [];
$claritiesHSS = [];
$CR = [];
for($j = 0; $j < $itemCount; $j++){
	$score = "0";
	//$CC  = Normalize($clarities[$j],$mcm,7);
	$CC  = $clarities[$j];
	$CW  = $writings[$j];
	$CP  = $belongings[$j];
	$CAS = $scales[$j];
	$CR  = $relevances[$j];
	//echo  "-->: " . $CR . "<br>";

	$score = TupleAdd($CC, $score);
	$score = TupleAdd($CW, $score);
	$score = TupleAdd($CP, $score);
	$score = TupleAdd($CAS, $score);
	$score = TupleDiv($score,4)*$relevances[$j];
	$sScore[] = $score;
	//echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . $CC . '</td><td>' . $CW . '</td><td>' . $CP . '</td><td>' . $CAS . '</td><td>' .$score. '</td></tr>';
	//echo '<tr><td>I<sub>' . ($j + 1) . '<sub></td><td>' . completeTuple($CC, 7) . '</td><td>' . completeTuple($CW, 7) . '</td><td>' . completeTuple($CP, 7) . '</td><td>' . completeTuple($CAS, 7) . '</td><td>' .completeTuple($score, 7). '</td><td>' . $CR . '</td></tr>';
}
//echo '</table>';

//echo "<br>";
$table['CC'] = array_merge($table,$clarities);
$table['CW'] = array_merge($table,$writings);
$table['CP'] = array_merge($table,$belongings);
$table['CAS'] = array_merge($table,$scales);
$table['CR'] = array_merge($table,$relevances);
$table['SCORE'] = array_merge($table,$sScore);
$table['Wr'] = array_merge($table,$relevances);


function collective_criteria($criteria){

	global $total;
	global $table;
	global $table_collective;
	$sum_criteria = 0 ;

	for ($i = 0 ; $i <$total ;  $i++){
		$sum_criteria += $table[$criteria][$i] * $table['CR'][$i] ;
	}

	 $table_collective[$criteria]  = $sum_criteria/$total;
	 return $sum_criteria/$total;
}

function item_score(){
	global $table_collective;
	$item_score = 0 ;

	foreach ($table_collective as $value){
		$item_score += $value;
	}

	printf ("%.2f", $item_score/4);
	//echo $item_score/4;
}


function linguisticLabel($criteria, $index){

	global $table;

	if($criteria != 'Total' && $criteria != 'level' &&  $criteria != 'item'  && $criteria != 'SCORE' ){
		return $table[$criteria][$index];
	}

	if ($criteria == 'SCORE'){
		return $table['SCORE'][$index];
	}

	if ($criteria == 'level'){

		return round($table['SCORE'][$index]+1);
	}

	if ($criteria == 'item'){
		return $table['item'][$index];
	}
}

function consensus($index){
	global $itemCount;
	global $normalized_judges;
	global $table;
	global $dimentions;
	global $mcm;
	$sum = 0;
	$tableS  = [];

	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($index);
		$clarity   = $item->getClarity();
		$writing   = $item->getWriting();
		$presence  = $item->getBelonging();
		$scale     = $item->getScale();
		$tableS['CC'][$i]   =  pow($table['CC'][$index] - $clarity,2);
		$tableS['CW'][$i]   =  pow($table['CW'][$index] - $writing,2);
		$tableS['CP'][$i]   =  pow($table['CP'][$index] - $presence,2);
		$tableS['CAS'][$i]  =  pow($table['CAS'][$index] - $scale,2);
	}

		// get rho and average
	for($i = 0; $i < count($normalized_judges); $i++){
		$sum  += sqrt($tableS['CC'][$i] + $tableS['CW'][$i] +  $tableS['CP'][$i] + $tableS['CAS'][$i]) * $dimentions[0]->judgeValue[$i] ;
	}
		//get consensus index
	$consensus = 1-$sum/$mcm;
	printf("%.2f", $consensus);
	//echo ($consensus);

	if($consensus < .5) return true;
	else return false;
}
?>

<main>
	<nav class="menu" id="nav_bar">
		<div class='cssmenu' id="tools_menu">
			<ul>
				<li class="li_menu" ><a>Visualizations Options</a>
					<ul class="ul_menu">
						<li class="visualization" value="0" onclick="hideColumns(this.value)">All Information</li>
						<li class="visualization" value="1" onclick="hideColumns(this.value)">Collective Clarity</li>
						<li class="visualization" value="2" onclick="hideColumns(this.value)">Collective Writting</li>
						<li class="visualization" value="3" onclick="hideColumns(this.value)">Collective Presence</li>
						<li class="visualization" value="4" onclick="hideColumns(this.value)">Collective Answering Scale</li>
						<li class="visualization" value="5" onclick="hideColumns(this.value)">Average Revelance</li>
						<li class="visualization" value="6" onclick="hideColumns(this.value)">Consensus</li>
					</ul>
				</li>
				<li class="li_menu"><a > Trim Tool</a>
					<ul>
						<li class=li_li_menu>
							<div class="options_bar" id="Consistency">
								<p> Trim Tool: visualizes crop items below the following label</p>
								<div class='btns'>
									<label>
									<input checked='' name='button-group' type='radio' value=1 class="bc" onclick="fun(this.value)"> <span class='btn first'>S<sub>0</sub></span> </label>
									<label>
									<input name='button-group' type='radio' value=2 class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>1</sub></span> </label>
									<label>
									<input name='button-group' type='radio' value=3 class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>2</sub></span> </label>
									<label>
									<input name='button-group' type='radio' value='4' class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>3</sub></span> </label>
									<label>
									<input name='button-group' type='radio' value='5' class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>4</sub></span> </label>
									<label>
									<input name='button-group' type='radio' value='6' class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>5</sub></span> </label>
									<label>
									<input name='button-group' type='radio' value='7' class="bc" onclick="fun(this.value)"> <span class='btn last'>S<sub>6</sub></span> </label>
								</div>
							</div>
						</li>
					</ul>
				</li>
				<li class="li_menu"> <a>Satisfiable Consistency</a>
					<ul>
						<li class=li_li_menu>
							<div class="options_bar" id="Consistency_Index">
								<p>Satisfiable Consensus Level: </p>
								<input type="range" min="0" max="1" step=".1" value="0" class="slider" id="Consistency_Index" onchange="show_valueS(this.value);">
								<br>
								<label name="CI" id="CI">0</label>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>

		<div class="cssmenu" id="page_menu">
			<ul>
				<li class="li_menu"><a href="index.html" title="">HOME</a></li>
				<li class="li_menu"><a href="import.html" title="">IMPORT</a></li>
				<li class="li_menu"><a href="" title="">ANNEX</a></li>
				<li class="li_menu"><a href="" title="https://github.com/NoeZermeno/2tuple-fuzzy-delphi">SOURCE cODE</a></li>
			</ul>
		</nav>
		<header>
			<!--<img src="images/header_logo.png" alt="logo" id="logo">-->
			<img src="images/DaSCI_logo_green.png" alt="logo_DaSCI" height="70px" id="logo_DaSCI">
				<h1 id="title">2-tuple Fuzzy Delphi Tool System</h1>
				<img src="images/UGR_logo_white_small.png" alt="logo_UGR" height="70px" id="logo_UGR">
		</header>
		<section id="main_content">
			<div id="table_content">
				<table id="datos" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Num</th>
							<th>Item</th>
							<th class="col_1">Collective Clarity</th>
							<th class="col_2">Collective Writing</th>
							<th class="col_3">Collective Presence</th>
							<th class="col_4">Collective Scale</th>
							<th class="col_5">Collective Relevance</th>
							<th>Score</th>
							<th class="col_6">Consensus</th>
							<th>Final Results</th>
						</tr>
					</thead>
					<tbody id=tableDatosBody>
						<?php
						$label_output="";   //Variable temporal mientras se obtienen los resultados finales

						/*--Row creation--*/
						for ($y = 1; $y <= $total; $y++) {
							?>
							<tr>
								<td>
									<?php  if( $y < 10 ) echo "I<sub>0" . $y . "<sub>"; else echo "I<sub>" . $y . "<sub>";
									?>
								</td>
								<td id="questions">
									<?php echo linguisticLabel('item',$y-1); ?>
								</td>
								<td class="col_1" id="cClarity">
									<?php //echo completeTuple(Normalize(linguisticLabel('CC',$y-1),13,7),7);?>
									<?php printf("%.2f", Normalize(linguisticLabel('CC',$y-1),$mcm,$output_scale));?>
								</td>
								<td class="col_2" id="cWriting">
									<?php printf("%.2f", Normalize(linguisticLabel('CW',$y-1),$mcm,$output_scale)); ?>
									<?php //echo linguisticLabel('CW',$y-1) ?>
								</td>
								<td class="col_3" id="cPresence">
									<?php printf("%.2f", Normalize(linguisticLabel('CP',$y-1),$mcm,$output_scale));?>
									<?php //echo linguisticLabel('CP',$y-1);?>
								</td>
								<td class="col_4" id="cScale">
									<?php printf("%.2f", Normalize(linguisticLabel('CAS',$y-1),$mcm,$output_scale)); ?>
									<?php //echo linguisticLabel('CAS',$y-1); ?>
								</td>
								<td class="col_5" id="cRelevance">
									<?php printf("%.2f", linguisticLabel('CR',$y-1)); ?>
								</td>
								<td id="score">
									<?php printf("%.2f", Normalize(linguisticLabel('SCORE',$y-1),$mcm,$output_scale));?>
									<?php //echo linguisticLabel('SCORE',$y-1);?>
								</td>
								<td class="col_6">
									<?php consensus($y-1);/*if(consensus($y-1)){
									echo  "<img src='images/check.png' width=25px>";
									}else{
									echo  "<img src='images/no_check.png' width=25px>";
									}*/
									?>
								</td>
								<td class=" level<?php echo level(Normalize(linguisticLabel('SCORE',$y-1),$mcm,$output_scale)); ?>">
									<?php lLabel(Normalize(linguisticLabel('SCORE',$y-1),$mcm,$output_scale)); ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th align="right">items</th>
							<th align="right">Results</th>
							<th class="col_1"><?php printf("%.2f", collective_criteria('CC')); ?></th>
							<th class="col_2"><?php printf("%.2f", collective_criteria('CW')); ?></th>
							<th class="col_3"><?php printf("%.2f", collective_criteria('CP')); ?></th>
							<th class="col_4"><?php printf("%.2f", collective_criteria('CAS')); ?></th>
							<th class="col_5"></th>
							<th class="col_6"></th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</section>
		<footer>
			<div class="footer_text"><p>License CC-By-NC-SA University of Granada Contact: <br> rosana@ugr.es, jeovani@correo.ugr.es, nzermeno@correo.ugr.es, jeronimoduran@correo.ugr.es, herrera@decsai.ugr.es</p> </div>
			<div class="icons">
				<a href="https://github.com/NoeZermeno/2tuple-fuzzy-delphi" class="icon-github"></a>
				<a href="https://twitter.com/DaSCI_es" title="twitter_DaSCI" class="icon-twitter"></a>
			</div>
		</footer>
		<div id="show_result">
			<h2 class ="subtitle"> QUESTIONNAIRE TOTAL SCORE = <?php echo item_score(); ?>
			</h2>
		</div>
	</main>
</body>

</html>
