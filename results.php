<?php
include 'functions.php';
header("Content-Type: text/html;charset=utf-8");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>GRID</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style_trim.css">
	<link rel="stylesheet" type="text/css" href="css/menu_tools_style.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="//file.myfontastic.com/VDXsxxmWcbZZG8xXax2UK4/icons.css" >
	<!-- <script type="text/javascript" src="JS/jquery-1.12.4.js"></script> -->

	<script  src="//code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/features/scrollResize/dataTables.scrollResize.min.js"></script>
	<script src="js/functions.js" type="text/javascript"></script>
</head>
<body>
	<main class="internalMain">
		<header class="internalHeader">
			<div class="logoDaCSI internalLogo">
				<img src="./img/DaSCI_logo_180px.png" alt="Logo ">
			</div>
			<div class="logo2Tuplas">
				<img src="./img/internal_header.png" alt="Logo ">
			</div>
			<div class="logoUGR internalLogo">
				<img src="./img/UGR_logo_180px.png " alt="Logo ">
			</div>
		</header>
		<nav class="navBar">
			<div class='cssmenu toolsMenuContainer'>
				<ul class="siteMenu">
					<li class="menuItem">
						<a> Visualizations Options</a>
						<ul class="ul_menu">
							<li class="visualization" id="1er_visualization" value="0" onclick="hideColumns(this)">All Information</li>
							<li class="visualization" value="1" onclick="hideColumns(this)">Collective Clarity</li>
							<li class="visualization" value="2" onclick="hideColumns(this)">Collective Writting</li>
							<li class="visualization" value="3" onclick="hideColumns(this)">Collective Presence</li>
							<li class="visualization" value="4" onclick="hideColumns(this)">Collective Answering Scale</li>
							<li class="visualization" value="5" onclick="hideColumns(this)">Average Revelance</li>
							<li class="visualization" value="6" onclick="hideColumns(this)">Consensus</li>
						</ul>
					</li>
					<li class="menuItem">
						<a> Trim Tool</a>
						<ul>
							<li class=li_li_menu>
								<div class="options_bar" id="Consistency">
									<p class="pTools"> Trim Tool: visualizes crop items below the following label</p>
									<div class='btns'>
										<label>
											<input checked='' name='button-group' type='radio' value=1 class="bc" onclick="fun(this.value)">
											<span class='btn first'>S
												<sub>0</sub>
											</span>
										</label>
										<label>
											<input name='button-group' type='radio' value=2 class="bc" onclick="fun(this.value)">
											<span class='btn'>S
												<sub>1</sub>
											</span>
										</label>
										<label>
											<input name='button-group' type='radio' value=3 class="bc" onclick="fun(this.value)">
											<span class='btn'>S
												<sub>2</sub>
											</span>
										</label>
										<label>
											<input name='button-group' type='radio' value='4' class="bc" onclick="fun(this.value)">
											<span class='btn'>S
												<sub>3</sub>
											</span>
										</label>
										<label>
											<input name='button-group' type='radio' value='5' class="bc" onclick="fun(this.value)">
											<span class='btn'>S
												<sub>4</sub>
											</span>
										</label>
										<label>
											<input name='button-group' type='radio' value='6' class="bc" onclick="fun(this.value)">
											<span class='btn'>S
												<sub>5</sub>
											</span>
										</label>
										<label>
											<input name='button-group' type='radio' value='7' class="bc" onclick="fun(this.value)">
											<span class='btn last'>S
												<sub>6</sub>
											</span>
										</label>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="menuItem">
						<a href="#"> Satisfiable Consistency</a>
						<ul>
							<li class=li_li_menu>
								<div class="options_bar">
									<p class="pTools">Satisfiable Consistency Level: </p>
									<form name="consistency_form" method="POST">
										<input type="range" name="consistency_level" min="0" max="1" step=".25" value=".75" class="slider" id="Consistency_Index"
										    onchange="show_valueS(this.value);">
										<br>
										<label name="CI" id="CI">.75</label>
									</form>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="siteMenuContainer">
				<ul class="siteMenu">
					<li id="fb" class="menuItem" style="color: white;">
						FILTERED BY: ALL INFORMATION
					</li>
					<li class="menuItem" disabled>

					</li>
					<li class="menuItem">
						<a href="./index.html"> HOME</a>
					</li>
					<li class="menuItem">
						<!-- <a href="./import.html"> IMPORT</a> -->
						<a href="./import.html"> IMPORT</a>
					</li>
					<li class="menuItem">
						<a href="#"> ANNEX</a>
					</li>
					<li class="menuItem">
						<a href="https://github.com/NoeZermeno/2tuple-fuzzy-delphi"> CODE SOURCE
						</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<article class="container">
			
			<div class="mainResultsContainer">
				<!--The title container is at the end of the document to obtain the result of all calculations.-->
				
				<div class="tableContainer">
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
								<th>Level</th>
								<th>Alfa</th>
								<th>Consistency</th>
							</tr>
						</thead>
						<tbody id=tableDatosBody>
						<?php
$label_output = ""; //Variable temporal mientras se obtienen los resultados finales
/*--Row creation--*/
for ($y = 1; $y <= $total; $y++) {
    ?>
							<tr>
								<td>
									<?php if ($y < 10) {
        echo "I<sub>0" . $y . "<sub>";
    } else {
        echo "I<sub>" . $y . "<sub>";
    }

    ?>
								</td>
								<td id="questions">
									<?php echo linguisticLabel('item', $y - 1); ?>
								</td>
								<td class="col_1" id="cClarity">
									<?php //echo completeTuple(Normalize(linguisticLabel('CC',$y-1),13,7),7);?>
									<?php completeTuple(Normalize(linguisticLabel('CC', $y - 1), $lcm, $output_scale), $output_scale);?>
								</td>
								<td class="col_2" id="cWriting">
									<?php completeTuple(Normalize(linguisticLabel('CW', $y - 1), $lcm, $output_scale), $output_scale);?>
									<?php //echo linguisticLabel('CW',$y-1) ?>
								</td>
								<td class="col_3" id="cPresence">
									<?php completeTuple(Normalize(linguisticLabel('CP', $y - 1), $lcm, $output_scale), $output_scale);?>
									<?php //echo linguisticLabel('CP',$y-1);?>
								</td>
								<td class="col_4" id="cScale">
									<?php completeTuple(Normalize(linguisticLabel('CAS', $y - 1), $lcm, $output_scale), $output_scale);?>
									<?php //echo linguisticLabel('CAS',$y-1); ?>
								</td>
								<td class="col_5" id="cRelevance">
									<?php printf("%.3f", linguisticLabel('CR', $y - 1));?>
								</td>
								<td id="score">
									<?php completeTuple(Normalize(linguisticLabel('SCORE', $y - 1), $lcm, $output_scale), $output_scale);

    ?>

									<?php //echo linguisticLabel('SCORE',$y-1);?>
								</td>
								<td class="col_6">
								<?php
if (consensus($y - 1)) {
        echo "<img src='./img/check.png' width=25px>";
    } else {
        echo "<img src='./img/no_check.png' width=25px>";
    }
    ?>
								</td>
								<td class=" level<?php echo level(Normalize(linguisticLabel('SCORE', $y - 1), $lcm, $output_scale)); ?>">
									<?php lLabel(Normalize(linguisticLabel('SCORE', $y - 1), $lcm, $output_scale));?>
								</td>
								<td>
									<?php echo level(Normalize(linguisticLabel('SCORE', $y - 1), $lcm, $output_scale)); ?>
								</td>
								<td>
									<?php echo alfa(Normalize(linguisticLabel('SCORE', $y - 1), $lcm, $output_scale)); ?>
								</td>

								<td>
									<?php echo consistency($y - 1); ?>
								</td>
							</tr>
						<?php
}
?>
						</tbody>
						<tfoot>
							<tr>
								<th align="right">items</th>
								<th align="right">Results</th>
								<th name="fcc" class="col_1">
									<?php //completeTuple(Normalize(collective_criteria('CC'), $lcm, $output_scale), $output_scale);?>
								</th>
								<th name="fcw" class="col_2">
									<?php //completeTuple(Normalize(collective_criteria('CW'), $lcm, $output_scale), $output_scale);?>
								</th>
								<th name="fcp" class="col_3">
									<?php //completeTuple(Normalize(collective_criteria('CP'), $lcm, $output_scale), $output_scale);?>
								</th>
								<th name="fcas" class="col_4">
									<?php //completeTuple(Normalize(collective_criteria('CAS'), $lcm, $output_scale), $output_scale);?>
								</th>
								<th class="col_5"></th>
								<th class="col_6"></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="titleText">
					<h2 id="qt" class="titleContainer">
						
					</h2>
					<div class="checkbox">
							<input id="chkChangeLabels" type="checkbox" onClick="columnformat(this.checked)"> As Linguistic Labels<br>
						</div>

				</div>
			</div>
		</article>
		<footer>
			<div class="textFooter">
				<p>University of Granada License CC-By-NC-SA</p>
			</div>
			<div class="iconsFooter">
				<a href="https://github.com/NoeZermeno/2tuple-fuzzy-delphi" class="icon-github" target="_blank"></a>
				<a href="https://twitter.com/DaSCI_es" title="twitter_DaSCI" class="icon-twitter" target="_blank"></a>
				<a></a> <!--Temporary: Remove logo 000webhost-->
			</div>
		</footer>
	</main>
</body>
</html>