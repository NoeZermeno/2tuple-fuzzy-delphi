<?php
	$max = 7;
	$total =10;
	$niveles = '<table id="niveles">';
	$niveles .= '<tr>';
	$count = '';
	for ($x = 1; $x <= $max; $x++) {
		$niveles .= '<td class="nivel' . $x . '">' . 's<sub>' .$x. '</sub>'.  '</td>';		
	}
	$niveles .= '</tr>';
	$niveles .= '</table>';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Filtros</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
		<link href="https://file.myfontastic.com/VDXsxxmWcbZZG8xXax2UK4/icons.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		<script type="text/javascript" src="jquery-1.12.4.js"></script>
		<script type="text/javascript" src="jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				var oTablaDatos = $('#datos').DataTable({
					"scrollResize": true,
	    			"scrollY": 400,
	    			"scrollCollapse": true,
	    			"paging": false,
					"order": [[5, "asc"]],
					"searching": false,
					"columnDefs": [
						{
							"targets": [5],
							"visible": false
						}
					]
				});
				$('#rango').on('change', function(){
					alert('a');
					var max = $('#rango').attr('max');;
					var nivel = $(this).val();
					for (var x = 1; x <= max; x++) {
						if (x < nivel) {
							$('#datos td.nivel' + x).parent('tr').addClass('oculto');
						} else {
							$('#datos td.nivel' + x).parent('tr').removeClass('oculto');
						}
					}
				});
			});
		</script>
		<script type="text/javascript">
			function show_valueS(x)
				{
				 document.getElementById("CI").innerHTML=x;
				}
				function show_valueE(x)
				{
				 document.getElementById("EC").innerHTML=x;
				}
		</script>

	</head>
	<body>
		
		<div class="iconos_redes">
				<nav class = "menu">
					<ul>
						<li><a href="" title="">HOME</a></li>
						<li><a href="" title="">IMPORT</a></li>
						<li><a href="" title="">ABOUT US</a></li>

					</ul>
				</nav>
			</div>

			<div class="encabezado">
				<img src= "images/A1.png" alt="Pages header" id="logos">
			</div>

			<section>
				<br>
					<h1 id="titulo">2-tuple Linguistic Delphi Method to Validate a Questionnaire by Consensus for a Blended Enviroment</h1>
				<br>
			</section>
			<div class="filtros_2">
					<table border="0">
						<tr>
							<td>
								<div class="bloque" id="consensus">
									<p> Visualization options: </p>
									<div class="styled-select semi-square">
									  <select>
									    <option>Collective Clarity</option>
									    <option>Collective Writing</option>
									    <option>Collective Presence</option>
									    <option>Collective Answering Scale</option>
									    <option>Average Relevance</option>
									    <option>Consensus</option>
									    <option>All information</option>
									  </select>
									</div>
								</div>
							</td>
							<td>
								<div class="bloque" id="Consistency">
									<p> Trim Tool: visualizes crop items below the following label</p>
									<?php echo $niveles; ?>
									<input type="range" name="rango" value="0" id="rango" min="1" max="<?php echo $max; ?>">
								</div>
							</td>
							<td class="w10">
								<div class="bloque" id = "Consistency_Index">
								  <p>Satisfiable Consensus Level: </p>
								   <input type="range" min="0" max="1"  step = ".1" value="0" class="slider" id="Consistency_Index" onchange="show_valueS(this.value);">
								   <label name="CI" id = "CI">0</label>
								</div>
							</td>
							<td class="w10">
								<div class="bloque" id = "Panel_Expert">
								  <p>Expert Panel Confidence: </p>
								   <input type="range" min="0" max="1"  step = ".1" value="0" class="slider" id="expert_confidence" onchange="show_valueE(this.value);">
								   <label name="EC" id = "EC">0</label>
								</div>
							</td>
							<td class="w20">
								<div class="bloque" id="Total_score">
									<p> Questionnaire Total Score</p>
									<h3>(Very correct , -0.45 )</h3>
								</div>
							</td>
							<td>
								<div id="datos_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="datos"></label></div>
							</td>
						</tr>
					</table>
		</div>
		<table id="datos" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Num</th>
					<th>Item</th>
					<th>Collective Clarity</th>
					<th>Collective Writing</th>
					<th>Collective Presence</th>
					<th>Collective Scale</th>
					<th>Score</th>
					<th>Total <filtering></th>
					<th>Consensus</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$limit = 27;

				function randomFloat($min = 0, $max = 1) {
	 		    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
				}

				$table = [];

					$items =[];
					$items[] = "Las actividades planteadas por el profesorado a través de los videos aumentaron mi interés por lo contenidos del curso.
					Escala Tipo A"; 
					$items[] = "La comunicación con mis compañeros a través de las actividades colaborativas aumentaron mi interés por lo contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "El uso de videos me ha facilitado el intercambio de información sobre los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "El trabajo colaborativo me ha facilitado el intercambio de información sobre los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "El uso de videos me ha facilitado la asociación de ideas relacionadas con los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "El trabajo colaborativo me ha facilitado la asociación de ideas relacionadas con los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "El uso de videos me ha facilitado la aplicación de nuevas ideas relacionadas con los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "El trabajo colaborativo me ha facilitado la aplicación de nuevas ideas relacionadas con los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "Trabajando colaborativamente he podido expresar mis emociones.Escala a utilizar: Tipo A"; 
					$items[] = "Trabajando colaborativamente he podido demostrar gratitud con algún miembro del grupo.Escala a utilizar: Tipo A"; 
					$items[] = "Trabajando colaborativamente he podido expresarme libremente y sin riesgos.Escala a utilizar: Tipo A"; 
					$items[] = "Me sentí cómodo interactuando con otros participantes del curso.Escala a utilizar: Tipo A"; 
					$items[] = "Trabajando colaborativamente me he sentido unido al grupo.Escala a utilizar: Tipo A"; 
					$items[] = "Sentí que mi punto de vista fue reconocido por otros participantes del curso.Escala a utilizar: Tipo A"; 
					$items[] = "En los videos se expresaban claramente los contenidos y la organización del curso.Escala a utilizar: Tipo A"; 
					$items[] = "Trabajando colaborativamente he obtenido información sobre los contenidos y la organización del curso.Escala a utilizar: Tipo A"; 
					$items[] = "En los videos se animaba a consultar los contenidos del curso y fuentes externas para generar conocimientos entre todos.Escala a utilizar: Tipo A"; 
					$items[] = "Trabajando colaborativamente se ha promovido y se ha animado la construcción de conocimientos.Escala a utilizar: Tipo A"; 
					$items[] = "A través de los videos se me han dado orientaciones explícitas para centrarme en los contenidos del curso.Escala a utilizar: Tipo A"; 
					$items[] = "A través del trabajo colaborativo he obtenido orientaciones explícitas para centrarme en los contenidos del curso.Escala a utilizar: Tipo A";
					$items[] = "Estoy satisfecho con las actividades propuestas en el curso.Escala a utilizar: Tipo B"; 
					$items[] = "Estoy satisfecho con la información aportada por mis compañeros.Escala a utilizar: Tipo B"; 
					$items[] = "Estoy satisfecho con las respuestas recibidas a mis preocupaciones, preguntas y necesidades relacionadas con los temas tratados en el curso.Escala a utilizar: Tipo B"; 
					$items[] = "Estoy satisfecho porque pude expresar mis preocupaciones, preguntas y necesidades relacionadas con los temas tratados en el curso.Escala a utilizar: Tipo B"; 
					$items[] = "Estoy satisfecho con los acuerdos adoptados en las actividades colaborativas.
					Escala a utilizar: Tipo B";
					$items[] = "Estoy satisfecho con los resúmenes realizados en las actividades del curso.Escala a utilizar: Tipo B"; 
					$items[] = "Considero que he alcanzado los objetivos del curso.Escala a utilizar: Tipo B"; 
					$items[] = "Estoy satisfecho con las conclusiones extraidas en las actividades colaborativas.Escala a utilizar: Tipo B"; 

	
				for ($k = 0 ; $k <$limit; $k++){
					$table[$k]["num"] = $k;	
					$table[$k]["item"] = $items[$k];	
				}
					for ($y = 0; $y < sizeof($table); $y++) {
						sizeof($table);

						$mean = round(randomFloat(3,6),2);
						$CoV = round(randomFloat(0,0.7),2);

						 if ($mean >5.4){
						 	$table[$y]["CC"] = "(S<sub>6</sub>, " . round(($mean-6),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["label"] = "Excelent";
						 	$nivel =7;
						 } elseif ($mean>4.9) {
						 	$table[$y]["CC"] = "(S<sub>5</sub>, " . round(($mean-5),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>5</sub>, " . round((round(randomFloat(3,6),2)-5),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>5</sub>, " . round((round(randomFloat(3,6),2)-5),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["label"]  = "Very Correct";
						 	$nivel = 6;
						 }elseif ($mean>4.4) {
						 	$table[$y]["CC"] = "(S<sub>5</sub>, " . round(($mean-5),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>5</sub>, " . round((round(randomFloat(3,6),2)-5),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>5</sub>, " . round((round(randomFloat(3,6),2)-5),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["label"]  = "Very Correct";
						 	$nivel = 6;
						 }elseif ($mean>3.9) {
						 	$table[$y]["CC"] = "(S<sub>4</sub>, " . round(($mean-4),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>4</sub>, " . round((round(randomFloat(3,6),2)-4),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>4</sub>, " . round((round(randomFloat(3,6),2)-4),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
							$table[$y]["label"]  = "Correct";
						 	$nivel = 5;
						 }elseif ($mean>3.4) {
						 	$table[$y]["CC"] = "(S<sub>4</sub>, " . round(($mean-4),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>4</sub>, " . round((round(randomFloat(3,6),2)-4),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>4</sub>, " . round((round(randomFloat(3,6),2)-4),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
							$table[$y]["label"]  = "Correct";

						 	$nivel = 5;
						 }elseif ($mean>2.9) {
						 	$table[$y]["CC"] = "(S<sub>3</sub>, " . round(($mean-3),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>3</sub>, " . round((round(randomFloat(3,6),2)-3),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>3</sub>, " . round((round(randomFloat(3,6),2)-3),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>3</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["label"]  = "Moderate";
						 	$nivel = 4;
						 }elseif ($mean>2.4) {
						 	$table[$y]["CC"] = "(S<sub>3</sub>, " . round(($mean-3),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>3</sub>, " . round((round(randomFloat(3,6),2)-3),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>3</sub>, " . round((round(randomFloat(3,6),2)-3),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
							$$table[$y]["label"]  = "Moderate";
						 	$nivel = 4;
						 }elseif ($mean>1.9) {
						 	$table[$y]["CC"] = "(S<sub>2</sub>, " . round(($mean-2),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>2</sub>, " . round((round(randomFloat(3,6),2)-2),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>2</sub>, " . round((round(randomFloat(3,6),2)-2),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
							$table[$y]["label"]  = "Incorrect";
						 	$nivel = 3;
						 }elseif ($mean>1.4) {
						 	$table[$y]["CC"] = "(S<sub>2</sub>, " . round(($mean-2),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>2</sub>, " . round((round(randomFloat(3,6),2)-2),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>2</sub>, " . round((round(randomFloat(3,6),2)-2),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
							$table[$y]["label"]  = "Incorrect";
						 	$nivel = 3;
						 }elseif ($mean>0.9) {
						 	$table[$y]["CC"] = "(S<sub>1</sub>, " . round(($mean-1),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>1</sub>, " . round((round(randomFloat(3,6),2)-1),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>1</sub>, " . round((round(randomFloat(3,6),2)-1),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["label"] = "Very Incorrect";
						 	$nivel = 2;
						 }elseif ($mean>0.5) {
						 	$table[$y]["CC"] = "(S<sub>1</sub>, " . round(($mean-1),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>1</sub>, " . round((round(randomFloat(3,6),2)-1),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>1</sub>, " . round((round(randomFloat(3,6),2)-1),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
						 	$table[$y]["label"]  = "Very Incorrect";
						 	$nivel = 2;
						 }else{
						 	$table[$y]["CC"] = "(S<sub>0</sub>, " . round(($mean-0),2)  . ")";
						 	$table[$y]["CW"] = "(S<sub>0</sub>, " . round((round(randomFloat(3,6),2)-0),2)  . ")";
						 	$table[$y]["CP"] = "(S<sub>0</sub>, " . round((round(randomFloat(3,6),2)-0),2)  . ")";
						 	$table[$y]["CAS"] = "(S<sub>6</sub>, " . round((round(randomFloat(3,6),2)-6),2)  . ")";
							$table[$y]["label"]  = "Lousy";
						 	$nivel = 1;
						 }

				echo "<tr> <td id='num'?>" . $table[$y]['num']."</td>";
				echo "<td id='preguntas' >" . $table[$y]['item']  . "</td>";
				echo "<td id='cClarity'>" . $table[$y]['CC'] . "</td>";
				echo "<td id='cWriting'>" . $table[$y]['CW'] . "</td>";
				echo "<td id='cPresence'>" . $table[$y]['CP'] . "</td>";
				echo "<td id='cScale'>" . $table[$y]['CAS'] . "</td>";
				echo "<td id='score'> score </td>";
				echo "<td  class='nivel$nivel texto_sombra'>" . $table[$y]["label"] . "</td>";
				
				echo "</tr>";
				}?>
				<tfoot>
				<tr>
					<th>Showing 10 of 45</th>
					<th align="right">Results</th>
					<th><?php echo "a";  ?></th>
					<th><?php echo "b" ?></th>
					<th><?php echo "c"; ?></th>
					<th><?php echo "d" ?></th>
					<th>(Very correct , -0.45 )</th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
			</tbody>
		</table>


		<footer>
			<p class="footer">.  This page was created by students of the UGR. The UGR has no direct relationship with the information on this website.</p>
			<a href="" title=""><div class="icon-github iconos"></div></a>
			<a href="https://www.ugr.es/servicios/correo-electronico" title="correo_UGR"><div class="icon-mail iconos"> </div></a>
			<a href="https://www.youtube.com/user/UGRmedios" title="medios_UGR"><div class="icon-youtube iconos"> </div></a>
			<a href="https://twitter.com/canalugr" title="twitter_UGR"><div class="icon-twitter iconos"></div></a>
			<a href="https://www.facebook.com/universidadgranada/" title="facebook_UGR"><div class="icon-facebook iconos"></div></a>
		</footer>
		</div>
	</body>
</html>
