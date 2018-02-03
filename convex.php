<?php

function convexCombination($w1,$s1,$w2,$s2,$g)
	{
		//check weights
		$sum = $w1 + $w2;
		if ($sum != 1.0)
		{
			echo "Error[convexCombination]: weights " . $w1 . " and " . $w2 . " should be normalized<br>";
			return;
		}
		$toRound = $w1*$s1 + $w2*$s2;
		$c2 = min($g, round($toRound));
		echo "G=" . $g . " to round = " . $toRound . " => " . $c2 ."<br>";
		return $c2;
	}


	function computeC2($w1,$h1,$w2,$h2,$g)
	{
		$debug = true;
		$r = count($h1);
		$s = count($h2);
		$t = array();  //an empty hesitant
		//check sizes

		if ($r*$s < 1)	
		{
			echo "Error[computeC2]: at least a single element per hesitant is required<br>";
			
			echo('<hr>h1<pre>');	print_r($h1);	echo('</pre>');
			echo('<hr>h2<pre>');	print_r($h2);	echo('</pre>');
			echo $r . " x " . $s . "<br>";
			return;		
		}
		//we call r x s times the computation of C2
		for ($i=0;$i<$r;$i++)
		for ($j=0;$j<$s;$j++)
		{
			
			$t[$i*$r+$j] = convexCombination($w1, $h1[$i], $w2, $h2[$j],$g);
			if ($debug) 
				echo $h1[$i] . " with " . $h2[$j] . " output term s_".$t[$i*$r+$j] . "<br>";
		}
		//remove redundant elements, reset indexes and return
		$c2 = array_values(array_unique($t)); 
		
		if ($debug) 
		{ 	
			echo('<hr>C2<pre>');	print_r($c2);	echo('</pre>');
		}
		return $c2;
	}

	$h1 = [];
	$h1[] = 5;
	$h1[] = 5;
	$h2 = [];
	$h2[] = 4;
	$h2[] = 6;
	//echo "values:  (.25,5,.75,4,6)<br>";
	//echo "___________________<br>";
	//convexCombination(.25,5,.75,4,6);
	//echo "___________________<br>";
	computeC2(.25,$h1,.75,$h2,6);
?>