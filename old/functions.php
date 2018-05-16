<?php
header("Content-Type: text/html;charset=utf-8");
	// if (!isset($_POST['submit'])) {
	// 	header('Location: index.html');
	// }	
$max = 7;
$total = 0;
$table = [];


	// if (!isset($_POST['submit'])) {
	// 	header('Location: index.html');
	// }

if (!isset($_POST['submit'])) {
	header('Location: index.html');
	
}

if (isset($_POST['heading1'])) {
	$check1 = $_POST['heading1']; #check if the header was selected, value = 1
} else {
	$check1 = 0;#if it was not selected, value = 0
}

if (isset($_POST['heading2'])) {
	$check2 = $_POST['heading2']; #check if the header was selected, value = 1
} else {
	$check2 = 0;#if it was not selected, value = 0
}

if (isset($_POST['heading3'])) {
	$check3 = $_POST['heading3']; #check if the header was selected, value = 1
} else {
	$check3 = 0;#if it was not selected, value = 0
}

$responses = $_FILES["file1"]["tmp_name"];
$description = $_FILES["file2"]["tmp_name"];
$dimensions_file = $_FILES["file3"]["tmp_name"];
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
	private $clarity = 0;
	private $writing = 0;
	private $belonging = 0;
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

class Dimension
{
	public $questions = [];
	public $judgeValue = [];
	public $begin;
	public $end;
	public $end2;

	public function setBegin($value)
	{
		$this->begin = $value;
	}
	public function getBegin()
	{
		return $this->begin;
	}

	public function setEnd($value)
	{
		echo "valor: " . $value . "<br>";
		$this->end = $value;
	}
	public function getEnd()
	{
		return $this->end;
	}

	public function getJudgeValues()
	{
		return $this->judgeValue;
	}
	public function getJudgeValue($index)
	{
		return $this->judgeValue[$index];
	}
}

function mid_point($str)
{
	$c = explode(',', max_min($str));
	return round(($c[0] + $c[1]) / 2);
}

function max_min($str)
{
	$array = explode(',', $str);
	$c = [];
	$c[] = min($array);
	$c[] = max($array);
	return implode(',', $c);
}

//Create a vector with the scale used by each judge and order it
function v_scale($judges)
{
	$vector = [];
	foreach ($judges as $judge) {
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

//Get the largest scale used in the item
function getHigherSelectionScale($judges)
{
	$higher = 0;
	foreach ($judges as $judge) {
		$scale = $judge->getscale();
		if ($scale > $higher) {
			$higher = $scale;
		}
	}
	return $higher;
}

//Get the scale on which the selected judge rated the items
function getSelectionScale($item)
{
	return $judge->getScale();
}

//Unify the values to the maximum scale REVISAR******************************************
function Normalize($values, $CurrentSelectionScale, $MaxSelectionScale)
{
	$result = 0;
	$result = $values * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1);
	return $result;
}

function ArrayToString($value)
{
	if (is_array($value[0])) {
		return implode(',', $value[0]);
	} else {
		return implode(',', $value);
	}
}

function completeTuple($value, $sel)
{
	$c = '(' . elementOfSet($value, $sel) . ')';
	echo $c;
}
 //REVISAR NO SE QUE HACE**************
function Tuple($value)
{
	if (is_array($value[0])) {

		return implode(',', $value[0]);
	} else {
		$value = implode('', $value);
		return "$value";
	}
}

function elementOfSet($value, $sel)
{

	if (strpos($value, '.')) {
		$c = 's<sub>' . round($value) . '</sub><sup>' . $sel . '</sup>, ' . round(($value - round($value)), 2);
	} else {
		$c = 's<sub>' . $value . '</sub><sup>' . $sel . '</sup> ' . ',0';
	}

	return $c;
}


function TupleAdd($value1, $value2)
{
	$c = 0;
	$c = $value1 + $value2;
	return $c;
}

function TupleDiv($value, $div)
{
	$c = 0;
	$c = $value / $div;
	return $c;
}

function TupleLinguisticDiv($value)
{
	$values = explode(',', $value);
	$items = [];
	foreach ($values as $item) {
		$i = (int)$item;
		$d = fmod($item, 1) * 100;
		if ($d > 40) {
			$i += 1;
			$d = 100 - $d;
			$items[] = "($i,-.$d)";
		} else {
			$items[] = "($i,.$d)";
		}
	}
	return implode(',', $items);
}


$judges = [];
$normalized_judges = [];
$dimensions = [];

error_reporting(0);
$hEvaluation = fopen($responses, 'r');  //Open responses file
$hDimensions = fopen($dimensions_file, 'r');	//Open dimension file
$hQuestionnaire = fopen($description, 'r');  //Open description file

error_reporting(1);

$columnCount = 0;
$j = 0;

while (!feof($hEvaluation)) {
	$row = fgets($hEvaluation);
	$cols = explode(';', $row);

	if (strpos($row, 'criteria') !== false) {
		$columnCount = count($cols);
		continue;
	}

	if (is_numeric($cols[1])) {
		$columnCount = count($cols);
	}

	if (count($cols) != $columnCount) {
		header("Location: errors.php?error_mensaje=0");
		exit();
	}
		
		//The scale used by the judge is saved
	$judge = new Judge();
	$judge->setscale($cols[1]);

		//Save the value of each criterion/weight in each item for each judge
	for ($i = 2; $i < count($cols); $i += 5) {
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


$total = $judges[0]->ItemsCount();

$dimensions = [];

//Check if the dimension file is loaded
if ($hDimensions != false) {

	$columnCount = 0;
	$begin = [];
	$end = [];
	$num_dimension = 0;
	$first = true;

	//Cycle to obtain, standardize and save the weights of each judge by dimension
	while (!feof($hDimensions)) {

		$acum = 0;
		$weightJ = [];
		$row = fgets($hDimensions);
		//echo "fila: "  .$row . "<br>";
		$cols = explode(';', $row);
		

		//We determine by means of the number of columns in the first row whether the number 
		//of judges matches the number of previously processed judges.
		if ((count($cols) - 3) !== count($judges)) {
			//we remove 3 columns from the calculation because they have dimensional data
			echo "cols:  " . count($cols) . "<br>";
			//header("Location: errors.php?error_mensaje=1");
			exit();
		}


		if (strpos($row, 'dimension_file') !== false) {
			$columnCount = count($cols);
			continue;
		}

		if (is_numeric($cols[1])) {
			$columnCount = count($cols);
		}

		if (count($cols) != $columnCount) {
			continue;
		}

		//Dimension start and end items are saved
		$dimension = new Dimension();
		$dimension->begin = $cols[1];
		$dimension->end = $cols[2];

		/******Validations for the dimension file******/
		//It is checked that the beginning of the 1st dimension starts in 1
		if (($num_dimension + 1) == 1 && $dimension->begin != 1 && $first == true) {
			echo "error from begin of questionnaire<br>";
		}
		
		//It is checked that the beginning of the dimension is not greater than its end.
		if ($dimensions->begin > $dimension->end) {
			echo "error from begin and end";
		}
		//It is checked that the beginning of the following dimension is consecutive at the end of the previous one
		if ((($dimension->begin) != $dimensions[$num_dimension - 1]->end + 1) && $first == false) {
			echo "error of consecutive items dimensions <br>";
		}
		//It is checked that the end of the dimension is not equal to the total number of items.
		if ($dimension->end > $total) {
			echo "The number of items in dimensions file exceed in responses file<br>";
		}
		//print_r($dimensions);

		//The weight of each judge is saved per dimension
		for ($i = 3; $i < $columnCount; $i++) {
			$value = $cols[$i];
			$weightJ[] = $value;
			$acum += $value;
		}
		
		//Normalization of the judges' weight.
		for ($i = 0; $i < count($weightJ); $i++) {
			$dimension->judgeValue[] = ($weightJ[$i] / $acum);
		}
		
		//The values of the dimension instance are saved.
		$dimensions[] = $dimension;
		$num_dimension++;
		$first = false;
	}
} //If the dimension file is not loaded all items are taken as a single dimension and the weight of the judges is equal for each one.
else {
	global $total;
	$dimension = new Dimension();
	$dimension->begin = 1;
	$dimension->end = $total;

	for ($i = 0; $i < count($judges); $i++) {
		$dimension->judgeValue[] = 1 / count($judges);
	}
	$dimensions[] = $dimension;
}

//Check that the number of items is the same in the dimension file and in the responses file.
if ($dimensions[count($dimensions) - 1]->end <> $total) {
	echo "The number of items doesn's match with responses file<br>";
}


//echo "hQuestionnaire : " . $hQuestionnaire . "<br>";
//$table = [];

//Check if the description file is loaded
if ($hQuestionnaire !== false) {
	$rowsCount = 0;
	$items = [];
	global $table;
	
	//The description of each item is saved
	while (!feof($hQuestionnaire)) {
		$rows++;
		$items[] = utf8_encode(fgets($hQuestionnaire));
	}
	//Check that the number of items in the description file is equal to the responses file
	if ($judges[0]->ItemsCount() == $rows) {
		$table['item'] = array_merge($table, $items);
	} else {
		header("Location: errors.php?error_mensaje=2");
		exit();
	}
}//If the description file is not loaded, each item is assigned a consecutive number.
else {
	$items = [];
	global $total;
	$total = $judges[0]->ItemsCount();
	for ($i = 1; $i <= $judges[0]->ItemsCount(); $i++) {
		$items[] = 'I<sub>' . $i . '</sub>';
	}
	$table['item'] = array_merge($table, $items);
}

// Highest common factor function
function hcf($a, $b)
{

	while (($a % $b) != 0) {
		$c = $b;
		$b = $a % $b;
		$a = $c;
	}
	return $b;
}
// Lowest common multiple function
function lcm($a, $b)
{
	return ($a * $b) / hcf($a, $b);
}

//The highest scale of all judges is obtained
$HSS = getHigherSelectionScale($judges);

//The minimum common multiple is the scale at which each judge's assessment must be unified.
function lcm_judges($judges)
{
	$lcm2 = 0;						//cambie este valor REVISAR ESTABA EN lcm pero no se utilza***********
	$vector = v_scale($judges);
	if (count($vector) > 2) {
		$fst = lcm(($vector[0] - 1), ($vector[1] - 1));
		return lcm($fst, ($vector[2] - 1));
	} else {
		return lcm(($vector[0] - 1), ($vector[1] - 1));
	}
}

//Obtains the value corresponding to the weight of the dimension  REVISAR SI ES POR CRITERIO O DIMENSION************+
function weight_criteria($value, $value2)
{
	$c = [];
	if (strpos($value1, ',')) {
		$a = explode(',', $value);
		$c[] = $a[0] * $value2;
		$c[] = $a[1] * $value2;
		return implode(',', $c);
	}
	$c = $value * $value2;
	return $c;
}

function score($value)
{
	$a = explode(',', $value);
	$b = explode(',', $value2);
	$c = [];
	$c[] = ($a[0]) / 2;
	$c[] = ($a[1] + $b[0]) / 2;
	return implode(',', $c);
}

function level($str)
{
	$rounded = round($str);
	switch ($rounded) {
		case 0:
			{
				echo "1";
			//return "(Pésimo, " . round(($str - $rounded),2) . ")";
			}
			break;
		case 1:
			{
				echo "2";
			//return "(Muy incorrecto, ". round(( $str - $rounded),2) . ")";
			}
			break;
		case 2:
			{
				echo "3";
			//return "(Incorrecto, ". round(( $str - $rounded),2) . ")";
			}
			break;
		case 3:
			{
				echo "4";
			//return "(Moderado, ". round(( $str - $rounded),2) . ")";
			}
			break;
		case 4:
			{
				echo "5";
			//return "(Correcto, ". round(( $str - $rounded ),2) . ")";
			}
			break;
		case 5:
			{
				echo "6";
			//return "(Muy Correcto, ". round(($str - $rounded  ),2) . ")";
			}

			break;
		case 6:
			{
				echo "7";
			//return "(Excelente, ". round(( $str - $rounded),2) . ")";
			}
			break;
	}
}

function lLabel($str)
{
	$rounded = round($str);

	switch ($rounded) {
		case 0:
			{	//echo "1";
				return "(Dreadful, " . round(($str - $rounded), 2) . ")";
			}
			break;
		case 1:
			{//echo "2";
				echo "(Very Incorrect, " . round(($str - $rounded), 2) . ")";
			}
			break;
		case 2:
			{ //echo "3";
				echo "(Incorrect, " . round(($str - $rounded), 2) . ")";
			}
			break;
		case 3:
			{ //echo "4";
				echo "(Moderate, " . round(($str - $rounded), 2) . ")";
			}
			break;
		case 4:
			{ //echo "5";
				echo "(Correct, " . round(($str - $rounded), 2) . ")";
			}
			break;
		case 5:
			{//echo "6";
				echo "(Very Correct, " . round(($str - $rounded), 2) . ")";
			}

			break;
		case 6:
			{
				echo "(Excelent, " . round(($str - $rounded), 2) . ")";
			}
			break;
	}
}

function ConsistencyIndex($CC, $CW, $CB, $CS, $CIU)
{
	$CI = 0;

	$CI += ($CC < $CIU) ? 0 : .25;
	$CI += ($CW < $CIU) ? 0 : .25;
	$CI += ($CB < $CIU) ? 0 : .25;
	$CI += ($CS < $CIU) ? 0 : .25;
	return $CI;
}

//Scale to be unified   REVISAR*****************************
$lcm = lcm_judges($judges) + 1;
if ($lcm < 12) {
	$lcm = 13;
}
$CIU = 12 * .75;   //Aqui se debe poner el valor que selecciona el usuario.

//The values of each item are normalized 
//CSS = Current Selection Scale
foreach ($judges as $judge) {
	$normalized_judge = new Judge();
	$CSS = $judge->getscale();
	foreach ($judge->Items() as $item) {
		//echo "lcm: " . $lcm . "<br>";

		$normalized_item = new Item();							//$lcm
		$newValue = Normalize($item->getClarity(), $CSS, $lcm);
		$normalized_item->setClarity($newValue);				//$lcm
		$newValue = Normalize($item->getWriting(), $CSS, $lcm);
		$normalized_item->setWriting($newValue);				//$lcm
		$newValue = Normalize($item->getBelonging(), $CSS, $lcm);
		$normalized_item->setBelonging($newValue);			//$lcm
		$newValue = Normalize($item->getScale(), $CSS, $lcm);
		$normalized_item->setScale($newValue);
		$normalized_item->setWeight($item->getWeight());
		$normalized_item->setSelectionScale($item->getSelectionScale());
		$normalized_judge->addItem($normalized_item);
	}
	$normalized_judges[] = $normalized_judge;
}

$aJudge = $normalized_judges[0];   //REVISAR por que 0 ************************
//Number of items
$itemCount = $aJudge->ItemsCount();
//Number of judges
$rowCount = count($judges);


//echo '<div id="etapa1">';

////***** REVISAR PARA QUE SIRVE ESTE CICLO	SI LO QUITAS NO PASA NADA CREO*/
for ($j = 0; $j < $itemCount; $j++) {
//	echo '<table border=1 class="tabla .modo1">';
//	echo '<tr><th class="th_question" colspan="6">' . ($j + 1) . ": " . $table['item'][$j] .  '</th></tr>';
//	echo '<tr class="alt tr_criteria"><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th><th>Relevance</th></tr>';
	for ($i = 0; $i < count($normalized_judges); $i++) {
		$judge = $normalized_judges[$i];
		$item = $judge->Item($j);

		$clarity = $item->getClarity();
		$writing = $item->getWriting();
		$belonging = $item->getBelonging();
		$scale = $item->getScale();
		$relevance = $item->getWeight();

//		echo "<tr><td>J" . ($i + 1) . "</td><td>" . round($clarity,2)  . "</td><td>" . round($writing,2) ."</td><td>" . round($belonging,2)  . "</td><td>" . round($scale,2) . "</td></tr>";
	//	echo "<tr><td>J" . ($i + 1) . "</td><td>" . completeTuple($clarity, 7)  . "</td><td>" . completeTuple($writing, 7)   ."</td><td>" . completeTuple($belonging, 7)   . "</td><td>" . completeTuple($scale, 7)  . "</td><td>" . $relevance  . "</td></tr>";
		//echo "<tr><td>J" . ($i + 1) . "</td><td>" . completeTuple($clarity, $lcm)  . "</td><td>" . completeTuple($writing, $lcm)   ."</td><td>" . completeTuple($belonging, $lcm)   . "</td><td>" . completeTuple($scale, $lcm)  . "</td><td>" . $relevance  . "</td></tr>";
	}
//	echo '</table>';
}
//echo '</div>';

// REVISAR NO SE QUE HACE *********************
for ($j = 0; $j < $itemCount; $j++) {

	for ($i = 0; $i < count($normalized_judges); $i++) {
		$judge = $normalized_judges[$i];
		$item = $judge->Item($j);
		$clarity = Tuple($item->getClarity());
		$writing = Tuple($item->getWriting());
		$belonging = Tuple($item->getBelonging());
		$scale = Tuple($item->getScale());
		$relevance = $item->getWeight();
	}

}


$clarities = [];
$writings = [];
$belongings = [];
$scales = [];
$relevance = [];

/********************

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
		$clarity   = weight_criteria($item->getClarity(),$dimensions[0]->judgeValue[$i]);
		$sClarity  = TupleAdd($sClarity, $clarity);
		$writing   = weight_criteria($item->getWriting(),$dimensions[0]->judgeValue[$i]);
		$sWriting  = TupleAdd($writing, $sWriting);
		$belonging   = weight_criteria($item->getBelonging(),$dimensions[0]->judgeValue[$i]);
		$sBelonging= TupleAdd($belonging, $sBelonging);
		$scale   = weight_criteria($item->getScale(),$dimensions[0]->judgeValue[$i]);
		$sScale    = TupleAdd($scale, $sScale);
		$relevance   = round($item->getWeight()*$dimensions[0]->judgeValue[$i],3);
		$sRelevance  = TupleAdd($relevance, $sRelevance);
	}

	$clarities[] = $sClarity;
	$writings[] = $sWriting;
	$belongings[] = $sBelonging;
	$scales[] = $sScale;
	$relevances[] = $sRelevance;
}



 ********************/
$dim = 0;  //REVISAR SI ESTA ASIGNACION ES NECESARIA

//Calculates the value of each judge by their weight for each criterion in each dimension. 
//This cycle runs through every dimension
for ($dim = 0; $dim < count($dimensions); $dim++) {
	
	//Scroll through each item of the current dimension.
	//It finally calculates the summation for each criterion.
	for ($j = $dimensions[$dim]->begin; $j <= $dimensions[$dim]->end; $j++) {

		$sClarity = '0';
		$sWriting = '0';
		$sBelonging = '0';
		$sScale = '0';
		$sRelevance = '0';
		$judge_weight = [];

		//Assessment of each judge for their weight in the current dimension.. 
		for ($i = 0; $i < count($normalized_judges); $i++) {

			$judge = $normalized_judges[$i];
			$item = $judge->Item($j - 1);
			$clarity = weight_criteria($item->getClarity(), $dimensions[$dim]->judgeValue[$i]);
			$sClarity = TupleAdd($clarity, $sClarity);
			$writing = weight_criteria($item->getWriting(), $dimensions[$dim]->judgeValue[$i]);
			$sWriting = TupleAdd($writing, $sWriting);
			$belonging = weight_criteria($item->getBelonging(), $dimensions[$dim]->judgeValue[$i]);
			$sBelonging = TupleAdd($belonging, $sBelonging);
			$scale = weight_criteria($item->getScale(), $dimensions[$dim]->judgeValue[$i]);
			$sScale = TupleAdd($scale, $sScale);
			$relevance = round($item->getWeight() * $dimensions[$dim]->judgeValue[$i], 3);
			$sRelevance = TupleAdd($relevance, $sRelevance);  //REVISAR por que relevancia va a 2 tuplas
			/*echo "<br>Claridad: ";
			print_r ($sClarity);
			echo "<br>Writing: ";
			print_r ($sWriting);
			echo "<br>Belonging: ";
			print_r ($sBelonging);
			echo "<br>Scale: ";
			print_r ($sScale);
			echo "<br>Relevance: ";
			print_r ($sRelevance);*/
		}
		
		//Save the sum for each criterion
		$clarities[] = $sClarity;
		$writings[] = $sWriting;
		$belongings[] = $sBelonging;
		$scales[] = $sScale;
		$relevances[] = $sRelevance;

	}
}

//echo '<table id="final" border=1 class="tabla">';
//echo '<tr class="alt"><th colspan="7">Agregation</th></tr>';
//echo '<tr ><th>Item</th><th>Clarity</th><th>Writing</th><th>   Presence   </th><th>   Scale   </th><th>   Score   </th><th>   Relevance  </th></tr>';
$sScore = [];
$question = [];
$claritiesHSS = [];
$CR = [];
$consistency = "";


for ($j = 0; $j < $itemCount; $j++) {
	$score = "0";
	//$CC  = Normalize($clarities[$j],$lcm,7);
	$CC = $clarities[$j];
	$CW = $writings[$j];
	$CP = $belongings[$j];
	$CAS = $scales[$j];
	$CR = $relevances[$j];
	//echo  "-->: " . $CR . "<br>";

	$consistency = ConsistencyIndex($CC, $CW, $CP, $CAS, $CIU);
	//echo "Consistency INDEX: $consistency";
	$score = TupleAdd($CC, $score);
	$score = TupleAdd($CW, $score);
	$score = TupleAdd($CP, $score);
	$score = TupleAdd($CAS, $score);
	$score = TupleDiv($score, 4) * $relevances[$j];
	$sScore[] = $score;
	//echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . $CC . '</td><td>' . $CW . '</td><td>' . $CP . '</td><td>' . $CAS . '</td><td>' .$score. '</td></tr>';
	//echo '<tr><td>I<sub>' . ($j + 1) . '<sub></td><td>' . completeTuple($CC, 7) . '</td><td>' . completeTuple($CW, 7) . '</td><td>' . completeTuple($CP, 7) . '</td><td>' . completeTuple($CAS, 7) . '</td><td>' .completeTuple($score, 7). '</td><td>' . $CR . '</td></tr>';
}
//echo '</table>';
//echo "<br>";
$table['CC'] = array_merge($table, $clarities);
$table['CW'] = array_merge($table, $writings);
$table['CP'] = array_merge($table, $belongings);
$table['CAS'] = array_merge($table, $scales);
$table['CR'] = array_merge($table, $relevances);
$table['SCORE'] = array_merge($table, $sScore);
$table['Wr'] = array_merge($table, $relevances);


function collective_criteria($criteria)
{

	global $total;
	global $table;
	global $table_collective;
	$sum_criteria = 0;

	for ($i = 0; $i < $total; $i++) {
		$sum_criteria += $table[$criteria][$i] * $table['CR'][$i];
	}

	$table_collective[$criteria] = $sum_criteria / $total;
	return $sum_criteria / $total;
}

function total_score()
{
	global $table_collective;
	$item_score = 0;

	foreach ($table_collective as $value) {
		$item_score += $value;
	}

	return $item_score / 4;
}


function linguisticLabel($criteria, $index)
{

	global $table;

	if ($criteria != 'Total' && $criteria != 'level' && $criteria != 'item' && $criteria != 'SCORE') {
		return $table[$criteria][$index];
	}

	if ($criteria == 'SCORE') {
		return $table['SCORE'][$index];
	}

	if ($criteria == 'level') {

		return round($table['SCORE'][$index] + 1);
	}

	if ($criteria == 'item') {
		return $table['item'][$index];
	}
}

function consensus($index)
{
	global $itemCount;
	global $normalized_judges;
	global $table;
	global $dimensions;
	global $lcm;
	$sum = 0;
	$tableS = [];

	for ($i = 0; $i < count($normalized_judges); $i++) {
		$judge = $normalized_judges[$i];
		$item = $judge->Item($index);
		$clarity = $item->getClarity();
		$writing = $item->getWriting();
		$presence = $item->getBelonging();
		$scale = $item->getScale();
		$tableS['CC'][$i] = pow($table['CC'][$index] - $clarity, 2);
		$tableS['CW'][$i] = pow($table['CW'][$index] - $writing, 2);
		$tableS['CP'][$i] = pow($table['CP'][$index] - $presence, 2);
		$tableS['CAS'][$i] = pow($table['CAS'][$index] - $scale, 2);
	}

		// get rho and average
	for ($i = 0; $i < count($normalized_judges); $i++) {
		$sum += sqrt($tableS['CC'][$i] + $tableS['CW'][$i] + $tableS['CP'][$i] + $tableS['CAS'][$i]) * $dimensions[0]->judgeValue[$i];
	}
		//get consensus index
	$consensus = 1 - $sum / $lcm;
	//printf("%.2f", $consensus);
	//echo ($consensus);

	if ($consensus > .5) return true;
	else return false;
}
?>





