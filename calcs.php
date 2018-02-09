<!DOCTYPE html> 
<html> 
<head> 
	<meta charset='utf-8'/> 
	<title>Tables</title> 
	<link rel="stylesheet" href="CSS/calcs.css">

</head> 
<body>



<?php

if (!isset($_POST['submit'])) {
	header('Location: index.html');
}
    $responses = $_FILES["file1"]["tmp_name"];
    $dimensions = $_FILES["file2"]["tmp_name"];
    $description = $_FILES["file3"]["tmp_name"];

class Judge
{
	private $items = [];
	private $weight;
	private $scale;

	//propiedades

	public function setweight($weight)
	{
		$this->weight = $weight;
	}

	public function getweight()
	{
		return $this->weight;
	}

	public function setscale($scale)
	{
		$this->scale = $scale;
	}

	public function getscale()
	{
		return $this->scale;
	}

	public function addItem($item)
	{
		$this->items[] = $item;
	}

	public function Items()
	{
		return $this->items;
	}

	public function Item($index)
	{
		return $this->items[$index];
	}

	public function ItemsCount()
	{
		return count($this->items);
	}

}

class Item
{
	private $clarity=0;
	private $writing=0;
	private $belonging=0;
	private $scale = 0;
	private $weight = 0;
	private $sScale = 0;

	public function setClarity($value)
	{
		$this->clarity = $value;
	}

	public function getClarity()
	{
		return $this->clarity;
	}

	public function setWriting($value)
	{

		$this->writing = $value;
	}

	public function getWriting()
	{
		return $this->writing;
	}

	public function setBelonging($value)
	{
		$this->belonging = $value;
	}

	public function getBelonging()
	{
		return $this->belonging;
	}

	public function setScale($value)
	{

		$this->scale = $value;
	}

	public function getScale()
	{
		return $this->scale;
	}

	public function setWeight($value)
	{
		$this->weight = $value;
	}

	public function getWeight()
	{
		return $this->weight;
	}

	public function setSelectionScale($value)
	{
		$this->sScale = $value;
	}

	public function getSelectionScale()
	{
		return $this->sScale;
	}

}

class Dimention {
	public $questions  = [];
	public $judgeValue = [];

	public function getJudgeValues()
	{
		return $this->judgeValue;
	}

	public function getJudgeValue($index)
	{
		return $this->judgeValue[$index];
	}
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
$hEvaluation       = fopen($responses ,'r');
$hDimentions       = fopen($dimensions, 'r');
$hQuestionnaire    = fopen($description, 'r');

error_reporting(1);

$columnCount       = 0;
$j = 0;
while(!feof($hEvaluation)){
	$row = fgets($hEvaluation);
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

	for($i = 2; $i < count($cols); $i += 5){
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

$dimentions = [];
if($hDimentions !== false){
	$columnCount = 0;
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
		
		$dimention = new Dimention();	
		//$dimention->questions = &question;//where the questionnaire will be saved remains to be determined
		for ($i = 3; $i < $columnCount; $i++) {
			$value = $cols[$i];
			$weightJ[] = $value;
			$acum += $value;
		}

		for ($i = 0 ; $i <count($weightJ); $i++){
			$dimention->judgeValue[] = round(($weightJ[$i]/$acum),3);
		}
		$dimentions[] = $dimention;
	}
}
else{
	$dimention = new Dimention();
	
	for ($i = 0 ; $i < count($judges); $i++){
				$dimention->judgeValue[] = 1/count($judges);
		}
		$dimentions[] = $dimention;
}

$table = [];

if($hQuestionnaire !== false){
	$rowsCount = 0;
	$items = [];

	while(!feof($hQuestionnaire)){
		$rows++;
		$items[] = utf8_encode(fgets($hQuestionnaire));
	}

	if($judges[0]->ItemsCount() == $rows){
		global $table;
		$table['item'] = array_merge($table,$items);
	}else{
		header("Location: errors.php?error_mensaje=2");
		exit();
	}
}else{
	$items = [];
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

$mcm = mcm_judges($judges)+1;

foreach($judges as $judge){
	$normalized_judge = new Judge();
	$CSS              = $judge->getscale();
	foreach($judge->Items() as $item){

		$normalized_item = new Item();
		$newValue        = Normalize($item->getClarity(), $CSS, $mcm );
		$normalized_item->setClarity( $newValue );
		$newValue        = Normalize($item->getWriting(), $CSS, $mcm );
		$normalized_item->setWriting( $newValue );
		$newValue        = Normalize($item->getBelonging(), $CSS, $mcm );
		$normalized_item->setBelonging( $newValue );
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


echo '<div id="etapa1">';
for($j = 0; $j < $itemCount; $j++){
	echo '<table border=1 class="tabla .modo1">';
	echo '<tr><th class="th_question" colspan="6">' . ($j + 1) . ": " . $table['item'][$j] .  '</th></tr>';
	echo '<tr class="alt tr_criteria"><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th><th>Relevance</th></tr>';
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);

		$clarity   = $item->getClarity();
		$writing   = $item->getWriting();
		$belonging = $item->getBelonging();
		$scale     = $item->getScale();
		$relevance     = $item->getWeight();

		//echo "<tr><td>J" . ($i + 1) . "</td><td>" . round($clarity,2)  . "</td><td>" . round($writing,2) ."</td><td>" . round($belonging,2)  . "</td><td>" . round($scale,2) . "</td></tr>";
		echo "<tr><td>J" . ($i + 1) . "</td><td>" . completeTuple($clarity, $mcm)  . "</td><td>" . completeTuple($writing, $mcm)   ."</td><td>" . completeTuple($belonging, $mcm)   . "</td><td>" . completeTuple($scale, $mcm)  . "</td><td>" . $relevance  . "</td></tr>";
	}


	echo '</table>';
}
echo '</div>';


for($j = 0; $j < $itemCount; $j++){
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);
		$clarity   = Tuple($item->getClarity());
		$writing   = Tuple($item->getWriting());
		$belonging = Tuple($item->getBelonging());
		$scale     = Tuple($item->getScale());
		$relevance     = Tuple($item->getWeight());
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

echo "<br>";
echo '<table id="final" border=1 class="tabla">';
echo '<tr class="alt"><th colspan="7">Agregation</th></tr>';
echo '<tr ><th>Item</th><th>Clarity</th><th>Writing</th><th>   Presence   </th><th>   Scale   </th><th>   Score   </th><th>   Relevance  </th></tr>';
$sScore = [];
$question = [];
$claritiesHSS = [];
for($j = 0; $j < $itemCount; $j++){
	$score = "0";
	$CC  = Normalize($clarities[$j],$mcm,7);
	$CW  = Normalize($writings[$j],$mcm,7);
	$CP  = Normalize($belongings[$j],$mcm,7);
	$CAS = Normalize($scales[$j],$mcm,7);
	$CR  = $relevances[$j];

	$score = TupleAdd($CC, $score);
	$score = TupleAdd($CW, $score);
	$score = TupleAdd($CP, $score);
	$score = TupleAdd($CAS, $score);
	$score = TupleDiv($score,4);
	$sScore[] = $score; 
	//echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . $CC . '</td><td>' . $CW . '</td><td>' . $CP . '</td><td>' . $CAS . '</td><td>' .$score. '</td></tr>';
	echo '<tr><td>I<sub>' . ($j + 1) . '<sub></td><td>' . completeTuple($CC, 7) . '</td><td>' . completeTuple($CW, 7) . '</td><td>' . completeTuple($CP, 7) . '</td><td>' . completeTuple($CAS, 7) . '</td><td>' .completeTuple($score, 7). '</td><td>' . $CR . '</td></tr>';
}
echo '</table>';

$table['CC'] = array_merge($table,$clarities);
$table['CW'] = array_merge($table,$writings);
$table['CP'] = array_merge($table,$belongings);
$table['CAS'] = array_merge($table,$scales);
$table['SCORE'] = array_merge($table,$sScore);
$table['Wr'] = array_merge($table,$relevances);

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
echo "</body></html>";
?>

