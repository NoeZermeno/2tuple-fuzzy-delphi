<style type="text/css">
	.hide
	{
		display: none;
	}
	input[type=button]
	{
		margin-top: 25px;
	}
</style>
<script type="text/javascript" src="jquery-1.12.4.js">
</script>
<script type="text/style" src="estilos.css">
</script>
<script type="text/javascript">
	$(document).ready(function()
		{
			$('#boton1').on('click', function()
				{
					$('div#etapa1').removeClass('oculto');
					$(this).addClass('oculto');
					$('input#boton2').removeClass('oculto');;
				});
		});
</script>


<?php

echo "<!DOCTYPE html> <html> <head> <title>Tables</title> </head> <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> <body>";

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

	private $clarity = [];
	private $writing = [];
	private $belonging = [];
	private $scale = [];
	private $weight = 0;
	private $sScale = 0;

	public function setClarity($value)
	{
		if( is_array($value) ){
			$this->clarity = $value;
			return;
		}
		else
		if(strpos($value, ',') !== false){
			$value = str_replace('"', '', $value);
			$value = explode(',', $value);
		}
		$this->clarity[] = $value;
	}

	public function getClarity()
	{
		return $this->clarity;
	}

	public function setWriting($value)
	{
		if( is_array($value) ){
			$this->writing = $value;
			return;
		}
		else
		if(strpos($value, ',') !== false){
			$value = str_replace('"', '', $value);
			$value = explode(',', $value);
		}
		$this->writing[] = $value;
	}

	public function getWriting()
	{
		return $this->writing;
	}

	public function setBelonging($value)
	{
		if( is_array($value) ){
			$this->belonging = $value;
			return;
		}
		else
		if(strpos($value, ',') !== false){
			$value = str_replace('"', '', $value);
			$value = explode(',', $value);
		}
		$this->belonging[] = $value;
	}

	public function getBelonging()
	{
		return $this->belonging;
	}

	public function setScale($value)
	{
		if( is_array($value) ){
			$this->scale = $value;
			return;
		}
		else
		if(strpos($value, ',') !== false){
			$value = str_replace('"', '', $value);
			$value = explode(',', $value);
		}
		$this->scale[] = $value;
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
	return array_unique($vector);
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
	
	$result = [];
	foreach($values as $value){
		$sub = [];
		if(is_array($value)){
			foreach($value as $subValue){
				$sub[] = round($subValue * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1),2);
			}
			$result[] = $sub;
		}
		else
		{
			$result[] = round($value * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1),2);
		}
	}
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
		return "$value,$value";
	}
}

function elementOfSet($value, $sel)
{
	$a = explode(',',$value);
	$c = [];
	for($i = 0;$i < count($a); $i++ ){
		if(strpos($a[$i],'.')){
			$c[] = 's<sub>' . round($a[$i]) . '</sub><sup>' . $sel . '</sup>, ' . ($a[$i] - round($a[$i]));
		}else {
			$c[] = 's<sub>' . $a[$i] . '</sub><sup>' . $sel . '</sup> ' . ',0';
		}

		
	}
	return implode(',', $c);
}


function TupleAdd($value1, $value2)
{
	$a = explode(',', $value1);
	$b = explode(',', $value2);
	$c = [];
	$c[] = $a[0] + $b[0] ;
	$c[] = $a[1] + $b[1] ;

	return implode(',', $c);
}

function TupleDiv($value, $div)
{
	$a   = explode(',', $value);
	$c   = [];
	$c[] = round($a[0] / $div , 2) ;
	$c[] = round($a[1] / $div , 2);
	return implode(',', $c);
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
$hEvaluation       = fopen('evaluation.csv', 'r');
$hDimentions       = fopen('dimensiones.csv', 'r');
$hQuestionnaire    = fopen('items.csv', 'r');
error_reporting(1);

$columnCount       = 0;
while(!feof($hEvaluation)){
	$row = fgets($hEvaluation);
	$cols= explode(';', $row);

	if(strpos($row, 'criteria') !== false){
		$columnCount = count($cols);
		continue;
	}

	if(count($cols) != $columnCount){
		continue;
	}

	$judge = new Judge();
	$judge->setscale($cols[1]);

	for($i = 2; $i < count($cols); $i += 5){
		$item = new Item();
		$item->setClarity(max_min($cols[$i]));
		$item->setWriting(max_min($cols[$i + 1]));
		$item->setBelonging(max_min($cols[$i + 2]));
		$item->setScale(max_min($cols[$i + 3]));
		$item->setWeight(max_min($cols[$i + 4]));
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
			break;
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
			$dimention->judgeValue[] = round(($weightJ[$i]/$acum),2);
		}
		$dimentions[] = $dimention;
	}
}

$table = [];

if($hQuestionnaire !== false){
	$rowsCount = 0;
	$items = [];

	while(!feof($hQuestionnaire)){
		$rows++;
		$items[] = fgets($hQuestionnaire);
	}

	if($judges[0]->ItemsCount() == $rows){
		global $table;
		$table['item'] = array_merge($table,$items);
	}else{
		echo "does not match the number of items";
		break;
	}
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

	$a   = explode(',', $value);
	$c   = [];
	$c[] = $a[0] * $value2 ;
	$c[] = $a[1] * $value2 ;
	return implode(',', $c);

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



echo '<div id="etapa1" class="oculto">';
for($j = 0; $j < $itemCount; $j++){
	echo '<table border=1>';
	echo '<tr><th colspan="5">Q' . ($j + 1) . ": " . $table['item'][$j] .  '</th></tr>';
	echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th></tr>';
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);

		$clarity   = ArrayToString($item->getClarity());
		$writing   = ArrayToString($item->getWriting());
		$belonging = ArrayToString($item->getBelonging());
		$scale     = ArrayToString($item->getScale());

		//echo "<tr><td>J" . ($i + 1) . "</td><td>" . $clarity  . "</td><td>" . $writing  ."</td><td>" . $belonging  . "</td><td>" . $scale . "</td></tr>";
		echo "<tr><td>J" . ($i + 1) . "</td><td>" . completeTuple($clarity, $mcm)  . "</td><td>" . completeTuple($writing, $mcm)   ."</td><td>" . completeTuple($belonging, $mcm)   . "</td><td>" . completeTuple($scale, $mcm)  . "</td></tr>";
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
	}
}


$clarities = [];
$writings  = [];
$belongings= [];
$scales    = [];

for($j = 0; $j < $itemCount; $j++){



	$sClarity   = '0,0';
	$sWriting   = '0,0';
	$sBelonging = '0,0';
	$sScale     = '0,0';
	$judge_weight = [];

	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);
		$clarity   = Tuple($item->getClarity());
		$clarity   = weight_criteria($clarity,$dimentions[0]->judgeValue[$i]);
		$sClarity  = TupleAdd($sClarity, $clarity);
		$writing   = Tuple($item->getWriting());
		$writing   = weight_criteria($writing,$dimentions[0]->judgeValue[$i]);
		$sWriting  = TupleAdd($writing, $sWriting);
		$belonging = Tuple($item->getBelonging());
		$belonging   = weight_criteria($belonging,$dimentions[0]->judgeValue[$i]);
		$sBelonging= TupleAdd($belonging, $sBelonging);
		$scale     = Tuple($item->getScale());
		$scale   = weight_criteria($scale,$dimentions[0]->judgeValue[$i]);
		$sScale    = TupleAdd($scale, $sScale);
	}
	$clarities[] = $sClarity;
	$writings[] = $sWriting;
	$belongings[] = $sBelonging;
	$scales[] = $sScale;

}

echo '<table id="final" border=1 class="oculto">';
echo '<tr><th colspan="6">Agregation</th></tr>';
echo '<tr><th>Item</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th><th>Score</th></tr>';
$sScore = [];
$question = [];
$claritiesHSS = [];
for($j = 0; $j < $itemCount; $j++){
	$score = "0,0";
	$CC  = implode(',', Normalize(explode(',',$clarities[$j]),$mcm,$HSS));
	$CW  = implode(',', Normalize(explode(',',$writings[$j]),$mcm,$HSS));
	$CP  = implode(',', Normalize(explode(',',$belongings[$j]),$mcm,$HSS));
	$CAS = implode(',', Normalize(explode(',',$scales[$j]),$mcm,$HSS));

	$score = TupleAdd($CC, $score);
	$score = TupleAdd($CW, $score);
	$score = TupleAdd($CP, $score);
	$score = TupleAdd($CAS, $score);
	$score = TupleDiv($score,4);
	$sScore[] = $score; 
	//echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . $CC . '</td><td>' . $CW . '</td><td>' . $CP . '</td><td>' . $CAS . '</td><td>' .$score. '</td></tr>';
	echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . completeTuple($CC, $HSS) . '</td><td>' . completeTuple($CW, $HSS) . '</td><td>' . completeTuple($CP, $HSS) . '</td><td>' . completeTuple($CAS, $HSS) . '</td><td>' .completeTuple($score, $HSS). '</td></tr>';
}
echo '</table>';

$table['CC'] = array_merge($table,$clarities);
$table['CW'] = array_merge($table,$writings);
$table['CP'] = array_merge($table,$belongings);
$table['CAS'] = array_merge($table,$scales);
$table['SCORE'] = array_merge($table,$sScore);


print_r($table['items']);
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


