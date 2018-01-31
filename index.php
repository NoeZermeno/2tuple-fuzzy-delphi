<style type="text/css">
	.hide {
		display: none;
	}
	input[type=button] {
		margin-top: 25px;
	}
</style>
<script type="text/javascript" src="jquery-1.12.4.js"></script>
<script type="text/style" src="estilos.css"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#boton1').on('click', function(){
			$('div#etapa1').removeClass('oculto');
			$(this).addClass('oculto');
			$('input#boton2').removeClass('oculto');;
		});
	});
</script>
<?php

class Judge {
    private $items = [];
    private $weight;

    //propiedades

    public function setweight($weight) {
        $this->weight = $weight;
    }

    public function getweight() {
        return $this->weight;
    }

    //metodos

    public function addItem($item) {
        $this->items[] = $item;
    }
    
    public function Items() {
    	return $this->items;
    }

    public function Item($index) {
        return $this->items[$index];
    }
    
    public function ItemsCount() {
    	return count($this->items);
    }

}

class Item {

    private $clarity = [];
    private $writing = [];
    private $belonging = [];
    private $scale = [];
    private $weight = 0;
    private $sScale = 0;
    
    public function setClarity($value) {
    	if ( is_array($value) ) {
    		$this->clarity = $value;
    		return;
    	} else if (strpos($value, ',') !== false) {
    		$value = str_replace('"', '', $value);
    		$value = explode(',', $value);
    	}
    	$this->clarity[] = $value;
    }

    public function getClarity() {
        return $this->clarity;
    }

    public function setWriting($value) {
    	if ( is_array($value) ) {
    		$this->writing = $value;
    		return;
    	} else if (strpos($value, ',') !== false) {
    		$value = str_replace('"', '', $value);
    		$value = explode(',', $value);
    	}
    	$this->writing[] = $value;
    }

    public function getWriting() {
        return $this->writing;
    }

    public function setBelonging($value) {
    	if ( is_array($value) ) {
    		$this->belonging = $value;
    		return;
    	} else if (strpos($value, ',') !== false) {
    		$value = str_replace('"', '', $value);
    		$value = explode(',', $value);
    	}
    	$this->belonging[] = $value;
    }

    public function getBelonging() {
        return $this->belonging;
    }

    public function setScale($value) {
    	if ( is_array($value) ) {
    		$this->scale = $value;
    		return;
    	} else if (strpos($value, ',') !== false) {
    		$value = str_replace('"', '', $value);
    		$value = explode(',', $value);
    	}
    	$this->scale[] = $value;
    }

    public function getScale() {
        return $this->scale;
    }

    public function setWeight($value) {
        $this->weight = $value;
    }

    public function getWeight() {
        return $this->weight;
    }
    
    public function setSelectionScale($value) {
    	$this->sScale = $value;
    }
    
    public function getSelectionScale() {
    	return $this->sScale;
    }

}

function getHigherSelectionScale($judges) {
	$higher = 0;
	$judge = $judges[0];
	
	for ($i = 0; $i < $judge->ItemsCount(); $i++) {
		$item = $judge->Item($i);
		if ($item->getSelectionScale() > $higher) {
			$higher = $item->getSelectionScale();
		}
	}
	
	return $higher;
}

function getSelectionScale($item) {
	return $item->getSelectionScale();
}

function Normalize($values, $CurrentSelectionScale, $MaxSelectionScale) {
	$result = [];
	foreach ($values as $value) {
		$sub = [];
		if (is_array($value)) {
			foreach ($value as $subValue) {
				$sub[] = $subValue * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1);
			}
			$result[] = $sub;
		} else {
			$result[] = $value * ($MaxSelectionScale - 1) / ($CurrentSelectionScale - 1);
		}
	}
	return $result;
}

function ArrayToString($value) {
	if (is_array($value[0])) {
		return implode(',', $value[0]);
	} else {
		return implode(',', $value);
	}
}


function completeTuple($value,$sel) {
    $a = explode(',',$value);
    $c = [];
    for($i = 0;$i < count($a); $i++ ){
      $c[] ='(' . elementOfSet($a[$i], $sel) . ' , 0)';
    }
    return implode(',', $c);
}

function Tuple($value) {
	if (is_array($value[0])) {
		return implode(',', $value[0]);
	} else {
		$value = implode('', $value);
		return "$value,$value";
	}
}

function elementOfSet($value, $sel) {
  $a = explode(',',$value);
    $c = [];
    for($i = 0;$i < count($a); $i++ ){
      $c[] ='s<sub>' . $a[$i] . '</sub><sup>' . $sel . '</sup> ';
    }
    return implode(',', $c);
  return 's<sub>' . $value . '</sub><sup>' . $sel . '</sup>' ;
}


function TupleAdd($value1, $value2) {
	$a = explode(',', $value1);
	$b = explode(',', $value2);
	$c = [];
	$c[] = $a[0] + $b[0] ;
	$c[] = $a[1] + $b[1] ;
	
	return implode(',', $c);
}

function TupleDiv($value, $div) {
	$a = explode(',', $value);
	
	$c = [];
  $mod = [];
  $inf = [];
  $sup = [];
	$c[] = $a[0] / $div ;
	$c[] = $a[1] / $div ;

	return implode(',', $c);

}

function TupleLinguisticDiv($value){
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

$handle = fopen('Libro1.csv', 'r');
$columnCount = 0;

while (!feof($handle)) {
	$row = fgets($handle);
	$cols = explode(';', $row);
	
	if (strpos($row, 'criteria') !== false) {
		$columnCount = count($cols);
		continue;
	}	
	
	if (count($cols) != $columnCount) {
		continue;
	}
	
	if (strpos($row, 'escala') !== false) { //Necesitamos esta fila para obtener la escala de selección posteriomente
		$scales = explode(';', $row);
		continue;
	}	
	

	$judge = new Judge();
	for ($i = 1; $i < count($cols); $i += 5) {
		//echo "$i<br>";
		
		$item = new Item();
			
		$item->setClarity($cols[$i]);
		$item->setWriting($cols[$i + 1]);
		$item->setBelonging($cols[$i + 2]);
		$item->setScale($cols[$i + 3]);
		$item->setWeight($cols[$i + 4]);
			
		$item->setSelectionScale($scales[$i]);
			
		$judge->addItem($item);
			
	}
		
	$judges[] = $judge;
	
}


//se crea un nuevo arreglo de jueces con los valores normalizados
$HSS = getHigherSelectionScale($judges);

foreach ($judges as $judge) {
	//var_dump( $judge );
	$normalized_judge = new Judge();
	foreach ($judge->Items() as $item) {
		$CSS = getSelectionScale($item);

		$normalized_item = new Item();
		$newValue = Normalize($item->getClarity(), $CSS, $HSS);
		$normalized_item->setClarity( $newValue );
		$newValue = Normalize($item->getWriting(), $CSS, $HSS);
		$normalized_item->setWriting( $newValue );
		$newValue = Normalize($item->getBelonging(), $CSS, $HSS);
		$normalized_item->setBelonging( $newValue );
		$newValue = Normalize($item->getScale(), $CSS, $HSS);
		$normalized_item->setScale( $newValue );
		$normalized_item->setWeight($item->getWeight());
			
		$normalized_item->setSelectionScale($item->getSelectionScale());
		//var_dump($normalized_item);
		$normalized_judge->addItem($normalized_item);

	}
	$normalized_judges[] = $normalized_judge;
}


$aJudge = $normalized_judges[0];
$itemCount = $aJudge->ItemsCount();
$rowCount = count($judges);

echo '<div id="etapa1" class="oculto">';
for ($j = 0; $j < $itemCount; $j++) {
  echo '<table border=1>';
  echo '<tr><th colspan="5">Item ' . ($j + 1) . '</th></tr>';
  echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Relevance</th></tr>';
  for ($i = 0; $i < count($normalized_judges); $i++) {
      $judge = $normalized_judges[$i];
      $item = $judge->Item($j);

      $clarity = ArrayToString($item->getClarity());
      $writing = ArrayToString($item->getWriting());
      $belonging = ArrayToString($item->getBelonging());
      $scale = ArrayToString($item->getScale());
      
      //echo "<tr><td>J" . ($i + 1) . "</td><td>" . $clarity . "</td><td>$writing</td><td>$belonging</td><td>$scale</td></tr>";
      echo "<tr><td>J" . ($i + 1) . "</td><td>" . elementOfSet($clarity ,$item->getSelectionScale()) . "</td><td>" . elementOfSet($writing ,$item->getSelectionScale())  ."</td><td>" . elementOfSet($belonging ,$item->getSelectionScale()) . "</td><td>" . elementOfSet($scale ,$item->getSelectionScale()) . "</td></tr>";
  }
  
  
  //echo "<tr><td></td><td>$clarity</td><td>$writing</td><td>$belonging</td><td>$scale</td></tr>";
  echo '</table>';
}
echo '</div>';

echo '<div id="etapa2" class="oculto">';
for ($j = 0; $j < $itemCount; $j++) {
  echo '<table border=1>';
  echo '<tr><th colspan="5">Item ' . ($j + 1) . '</th></tr>';
  echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Relevance</th></tr>';
  for ($i = 0; $i < count($normalized_judges); $i++) {
      $judge = $normalized_judges[$i];
      $item = $judge->Item($j);

      $clarity = Tuple($item->getClarity(),$item->getSelectionScale());
      $writing = Tuple($item->getWriting(),$item->getSelectionScale());
      $belonging = Tuple($item->getBelonging(),$item->getSelectionScale());
      $scale = Tuple($item->getScale(),$item->getSelectionScale());
      
      echo "<tr><td>J<sub>" . ($i + 1) . "</sub></td><td>" . completeTuple($clarity,$item->getSelectionScale()) . "</td><td>" . completeTuple($writing ,$item->getSelectionScale())."</td><td>" . completeTuple($belonging ,$item->getSelectionScale()) . "</td><td>" . completeTuple($scale ,$item->getSelectionScale()) . "</td></tr>";
  }
  
  
  //echo "<tr><td></td><td>$clarity</td><td>$writing</td><td>$belonging</td><td>$scale</td></tr>";
  echo '</table>';
}
echo '</div>';

$clarities = [];
$writings = [];
$belongings = [];
$scales = [];

echo '<div id="etapa3" class="oculto">';
for ($j = 0; $j < $itemCount; $j++) {
  echo '<table border=1>';
  echo '<tr><th colspan="5">Item ' . ($j + 1) . '</th></tr>';
  echo '<tr><th>Juez</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Relevance</th></tr>';
  
  $sClarity = '0,0';
  $sWriting = '0,0';
  $sBelonging = '0,0';
  $sScale = '0,0';
  
  for ($i = 0; $i < count($normalized_judges); $i++) {
      $judge = $normalized_judges[$i];
      $item = $judge->Item($j);

      $clarity = Tuple($item->getClarity());
      $sClarity = TupleAdd($sClarity, $clarity);
      $writing = Tuple($item->getWriting());
      $sWriting = TupleAdd($writing, $sWriting);
      $belonging = Tuple($item->getBelonging());
      $sBelonging = TupleAdd($belonging, $sBelonging);
      $scale = Tuple($item->getScale());
      $sScale = TupleAdd($scale, $sScale) . "<br>";
      
      echo "<tr><td>J<sub>" . ($i + 1) . "</sub></td><td>" . completeTuple($clarity,$item->getSelectionScale()) . "</td><td>" . completeTuple($writing ,$item->getSelectionScale())."</td><td>" . completeTuple($belonging ,$item->getSelectionScale()) . "</td><td>" . completeTuple($scale ,$item->getSelectionScale()) . "</td></tr>";
  }
  
  $sClarity = TupleDiv($sClarity, $rowCount);
  $clarities[] = $sClarity;
  $sWriting = TupleDiv($writing, $rowCount);
  $writings[] = $sWriting;
  $sBelonging = TupleDiv($belonging, $rowCount);
  $belongings[] = $sBelonging;
  $sScale = TupleDiv($scale, $rowCount);
  $scales[] = $sScale;
  
  echo "<tr><td></td><td>" .TupleLinguisticDiv($sClarity) . "</td><td>" . TupleLinguisticDiv($sWriting)."</td><td>". TupleLinguisticDiv($sBelonging)."/td><td>" . TupleLinguisticDiv($sScale) ."$sScale</td></tr>";
  echo '</table>';
}
echo '</div>';


echo '<table id="final" border=1 class="oculto">';
echo '<tr><th colspan="5">Agregation</th></tr>';
echo '<tr><th>Item</th><th>Clarity</th><th>Writing</th><th>Presence</th><th>Scale</th></tr>';
for ($j = 0; $j < $itemCount; $j++) { 
	echo '<tr><td>Q<sub>' . ($j + 1) . '<sub></td><td>' . $clarities[$j] . '</td><td>' . $writings[$j] . '</td><td>' . $belongings[$j] . '</td><td>' . $scales[$j] . '</td></tr>';
}
echo '</table>';
?>

<input type="button" id="boton1" value="Etapa 1" class="">
<input type="button" id="boton2" value="Etapa 2" class="oculto">
<input type="button" id="boton3" value="Etapa 3" class="oculto">
<input type="button" id="boton4" value="Etapa 4" class="oculto">