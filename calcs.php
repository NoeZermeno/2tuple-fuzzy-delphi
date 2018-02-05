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
				$sub[] = $subValue * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1);
			}
			$result[] = $sub;
		}
		else
		{
			$result[] = $value * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1);
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
		$c[] = '(' . elementOfSet($a[$i], $sel) . ' , 0)';
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
		$c[] = 's<sub>' . $a[$i] . '</sub><sup>' . $sel . '</sup> ';
	}
	return implode(',', $c);
	return 's<sub>' . $value . '</sub><sup>' . $sel . '</sup>' ;
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
	$mod = [];
	$inf = [];
	$sup = [];
	$c[] = $a[0] / $div ;
	$c[] = $a[1] / $div ;

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
$hQuestionnaire    = fopen('cuestionario.csv', 'r');
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
		$item->setClarity($cols[$i]);
		$item->setWriting($cols[$i + 1]);
		$item->setBelonging($cols[$i + 2]);
		$item->setScale($cols[$i + 3]);
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


//var_dump($dimentions);

//a new array of judges with standardized values is created
$HSS = getHigherSelectionScale($judges);

foreach($judges as $judge){
	$normalized_judge = new Judge();
	$CSS              = $judge->getscale();
	foreach($judge->Items() as $item){

		$normalized_item = new Item();
		$newValue        = Normalize($item->getClarity(), $CSS, $HSS);
		$normalized_item->setClarity( $newValue );
		$newValue        = Normalize($item->getWriting(), $CSS, $HSS);
		$normalized_item->setWriting( $newValue );
		$newValue        = Normalize($item->getBelonging(), $CSS, $HSS);
		$normalized_item->setBelonging( $newValue );
		$newValue        = Normalize($item->getScale(), $CSS, $HSS);
		$normalized_item->setScale( $newValue );
		$normalized_item->setWeight($item->getWeight());

		$normalized_item->setSelectionScale($item->getSelectionScale());
		//var_dump($normalized_item);
		$normalized_judge->addItem($normalized_item);
	}
	$normalized_judges[] = $normalized_judge;
}


$aJudge    = $normalized_judges[0];
$itemCount = $aJudge->ItemsCount();
$rowCount  = count($judges);

/*
echo '<div id="etapa1" class="oculto">';
for($j = 0; $j < $itemCount; $j++){
	echo '<table border=1>';
	echo '<tr><th colspan="5">Item ' . ($j + 1) . '</th></tr>';
	echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th></tr>';
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);

		$clarity   = ArrayToString($item->getClarity());
		$writing   = ArrayToString($item->getWriting());
		$belonging = ArrayToString($item->getBelonging());
		$scale     = ArrayToString($item->getScale());

		echo "<tr><td>J" . ($i + 1) . "</td><td>" . $clarity  . "</td><td>" . $writing  ."</td><td>" . $belonging  . "</td><td>" . $scale . "</td></tr>";
	}


	echo '</table>';
}
echo '</div>';

echo '<div id="etapa2" class="oculto">';
for($j = 0; $j < $itemCount; $j++){
	echo '<table border=1>';
	echo '<tr><th colspan="5">Item ' . ($j + 1) . '</th></tr>';
	echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th></tr>';
	for($i = 0; $i < count($normalized_judges); $i++){
		$judge     = $normalized_judges[$i];
		$item      = $judge->Item($j);

		$clarity   = Tuple($item->getClarity());
		$writing   = Tuple($item->getWriting());
		$belonging = Tuple($item->getBelonging());
		$scale     = Tuple($item->getScale());

		echo "<tr><td>J<sub>" . ($i + 1) . "</sub></td><td>" . $clarity. "</td><td>" . $writing."</td><td>" . $belonging . "</td><td>" .$scale . "</td></tr>";
	}
	echo '</table>';
}*/
echo '</div>';

$clarities = [];
$writings  = [];
$belongings= [];
$scales    = [];


function weight_criteria($value, $value2){

	$a   = explode(',', $value);
	$c   = [];
	$c[] = $a[0] * $value2 ;
	$c[] = $a[1] * $value2 ;
	return implode(',', $c);

}

echo '<div id="etapa3" class="oculto">';
for($j = 0; $j < $itemCount; $j++){
	echo '<table border=1>';
	echo '<tr><th colspan="5">Etapa 3 Item' . ($j + 1) . '</th></tr>';
	echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th></tr>';

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

		echo "<tr><td>J<sub>" . ($i + 1) . "</sub></td><td>" . $clarity . "</td><td>" . $writing ."</td><td>" . $belonging . "</td><td>" . $scale . "</td></tr>";
	}
	$clarities[] = $sClarity;
	$writings[] = $sWriting;
	$belongings[] = $sBelonging;
	$scales[] = $sScale;
	echo "-->: " . $sScale;

	echo "<tr><td></td><td>" .$sClarity. "</td><td>" . $sWriting."</td><td>". $sBelonging."</td><td>" . $sScale ."</td></tr>";
	echo '</table>';
}
echo '</div>';


echo '<table id="final" border=1 class="oculto">';
echo '<tr><th colspan="5">Agregation</th></tr>';
echo '<tr><th>Item</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th></tr>';
echo "aqui!: " . $itemCount . "<br>";
for($j = 0; $j < $itemCount; $j++){
	echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . $clarities[$j] . '</td><td>' . $writings[$j] . '</td><td>' . $belongings[$j] . '</td><td>' . $scales[$j] . '</td></tr>';
}
echo '</table>';
?>

<input type="button" id="boton1" value="Etapa 1" class="">
<input type="button" id="boton2" value="Etapa 2" class="oculto">
<input type="button" id="boton3" value="Etapa 3" class="oculto">
<input type="button" id="boton4" value="Etapa 4" class="oculto">