<?php
	$max = 7;
	$total = 29;
	$niveles = '<table id="niveles">';
	$niveles .= '<tr>';
	$count = 0;
	for ($x = 1; $x <= $max; $x++) {

		$niveles .= '<td class="nivel' . $x . '">' . round($count,2) .  '</td>';
		$count += 0.1666666666666667;
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
					"columnDefs": [
						{
							"targets": [5],
							"visible": false
						}
					]
				});
				$('#rango').on('change', function(){
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
			function show_value(x)
				{
				 document.getElementById("CI").innerHTML=x;
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
									<div class="styled-select blue semi-square">
									  <select>
									    <option>Collective criteria</option>
									    <option>Collective Clarity</option>
									    <option>Collective Writing</option>
									    <option>Collective Presence</option>
									    <option>Collective Answering Scale</option>
									    <option>Average Relevanc</option>
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
							<td>
								<div class="bloque" id = "Consistency_Index">
								  <p>Satisfiable Consensus Level: </p>
								   <input type="range" min="0" max="1"  step = ".1" value="0" class="slider" id="Consistency_Index" onchange="show_value(this.value);">
								   <label name="CI" id = "CI"></label>
								</div>
								<div class="bloque" id="Total_score">
									<p> Questionnaire Total Score</p>
									<h3>(Excellent , -0.45 )</h3>
								</div>
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
					<th>Label</th>
					<th>Consensus</th>
				</tr>
			</thead>

			<tbody>
				<?php
				function randomFloat($min = 0, $max = 1) {
	 		    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
				}

				$sClarity = [];
				$sPresence = [];

				$_2_tuplas = 0;
				$_2_tuplasC = 0;
				$_2_tuplasP = 0;
				$label_output="";
					for ($y = 1; $y <= $total; $y++) {
						//$nivel = rand(1, $max);

						

						$mean = round(randomFloat(0,6),2);
						$CoV = round(randomFloat(0,0.7),2);

						 if ($mean >5.4){
						 	$_2_tuplas = "(S<sub>6</sub>, " . round(($mean-6),2)  . ")";
						 	$_2_tuplasC = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Excelent";
						 	$nivel =7;
						 } elseif ($mean>4.9) {
						 	$_2_tuplas = "(S<sub>5</sub>, " . round(($mean-5),2)  . ")";
						 	$_2_tuplasC = "(S<sub>5</sub>, " . round((round(randomFloat(0,6),2)-5),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Very Correct";
						 	$nivel = 6;
						 }elseif ($mean>4.4) {
						 	$_2_tuplas = "(S<sub>5</sub>, " . round(($mean-5),2)  . ")";
						 	$_2_tuplasC = "(S<sub>5</sub>, " . round((round(randomFloat(0,6),2)-5),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Very Correct";
						 	$nivel = 6;
						 }elseif ($mean>3.9) {
						 	$_2_tuplas = "(S<sub>4</sub>, " . round(($mean-4),2)  . ")";
						 	$_2_tuplasC = "(S<sub>4</sub>, " . round((round(randomFloat(0,6),2)-4),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Correct";
						 	$nivel = 5;
						 }elseif ($mean>3.4) {
						 	$_2_tuplas = "(S<sub>4</sub>, " . round(($mean-4),2)  . ")";
						 	$_2_tuplasC = "(S<sub>4</sub>, " . round((round(randomFloat(0,6),2)-4),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Correct";

						 	$nivel = 5;
						 }elseif ($mean>2.9) {
						 	$_2_tuplas = "(S<sub>3</sub>, " . round(($mean-3),2)  . ")";
						 	$_2_tuplasC = "(S<sub>3</sub>, " . round((round(randomFloat(0,6),2)-3),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Moderate";
						 	$nivel = 4;
						 }elseif ($mean>2.4) {
						 	$_2_tuplas = "(S<sub>3</sub>, " . round(($mean-3),2)  . ")";
						 	$_2_tuplasC = "(S<sub>3</sub>, " . round((round(randomFloat(0,6),2)-3),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Moderate";
						 	$nivel = 4;
						 }elseif ($mean>1.9) {
						 	$_2_tuplas = "(S<sub>2</sub>, " . round(($mean-2),2)  . ")";
						 	$_2_tuplasC = "(S<sub>2</sub>, " . round((round(randomFloat(0,6),2)-2),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Incorrect";
						 	$nivel = 3;
						 }elseif ($mean>1.4) {
						 	$_2_tuplas = "(S<sub>2</sub>, " . round(($mean-2),2)  . ")";
						 	$_2_tuplasC = "(S<sub>2</sub>, " . round((round(randomFloat(0,6),2)-2),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Incorrect";
						 	$nivel = 3;
						 }elseif ($mean>0.9) {
						 	$_2_tuplas = "(S<sub>1</sub>, " . round(($mean-1),2)  . ")";
						 	$_2_tuplasC = "(S<sub>1</sub>, " . round((round(randomFloat(0,6),2)-1),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Very Incorrect";
						 	$nivel = 2;
						 }elseif ($mean>0.5) {
						 	$_2_tuplas = "(S<sub>1</sub>, " . round(($mean-1),2)  . ")";
						 	$_2_tuplasC = "(S<sub>1</sub>, " . round((round(randomFloat(0,6),2)-1),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Very Incorrect";
						 	$nivel = 2;
						 }else{
						 	$_2_tuplas = "(S<sub>0</sub>, " . round(($mean-0),2)  . ")";
						 	$_2_tuplasC = "(S<sub>0</sub>, " . round((round(randomFloat(0,6),2)-0),2)  . ")";
						 	$_2_tuplasP = "(S<sub>6</sub>, " . round((round(randomFloat(0,6),2)-6),2)  . ")";
						 	$label_output = "Lousy";
						 	$nivel = 1;
						 }


							
							$items = [];
							$items[] = "¿Con cuántas plataformas de educación virtual ha trabajado anteriormente?";
							$items[] = "¿Conocía previamente la plataforma Moodle?";
							$items[] = "¿Ha utilizado la plataforma para sus actividades académicas?";
							$items[] = "¿Ha recibido con anterioridad formación en Moodle?";
							$items[] = "Califique su nivel de dominio sobre la plataforma Moodle";
							$items[] = "En promedio, ¿cuánto tiempo emplea semanalmente en la plataforma cuando se encuentra en período de clases";
							$items[] = "En promedio, ¿cuánto tiempo emplea semanalmente en la plataforma cuando no se encuentra en período de clases";
							$items[] = "¿Ha utilizado la plataforma Moodle en el rol docente?";
							$items[] = "Aprendí a utilizar la plataforma de forma sencilla";
							$items[] = "Aprender como utilizar nuevas funciones de la plataforma es sencillo";
							$items[] = "Aprendí a utilizar la plataforma Moodle con apoyo de un colega";
							$items[]= "Puedo explorar funcionalidades de la plataforma por ensayo y error";
							$items[]= "En ocasiones necesito utilizar ayuda externa al trabajar con la plataforma (tutoriales, apoyo de colegas, manual de usuarios, etc...)";
							$items[]= "Es fácil navegar entre las diferentes secciones de la plataforma";
							$items[]= "Completo las actividades de la plataforma eficientemente";
							$items[]= "Considero que Moodle es una plataforma virtual flexible";
							$items[]= "Soy capaz de utilizar la información provista por el sistema";
							$items[]= "Identifico cada sección en la plataforma";
							$items[]= "El uso de ésta plataforma se asemeja a otras interfaces que me son habituales";
							$items[]= "Puedo utilizar la plataforma con facilidad, incluso después de haber pasado tiempo sin haberla empleado";
							$items[]= "Los mensajes informativos (de error, confirmación y advertencias) son claros";
							$items[]= "Tras un evento de error, encuentro fácilmente documentación sobre este";
							$items[]= "La información provista en la plataforma es fácil de entender";
							$items[]= "Estoy satisfecho con el lenguaje empleado en la plataforma";
							$items[]= "Estoy satisfecho con funcionamiento del sistema Moodle";
							$items[]= "Recomendaría a esta plataforma para el manejo de cursos en línea a un amigo";
							$items[]= "Me parece atractiva la interfaz del sistema";
							$items[]= "La organización de los componentes es clara";
							$items[]= "La organización de los menús me parece lógica";
							$items[]= "Pienso que el uso de la plataforma es amigable/cercano";


				?>
				<tr>
					<td> <?php echo $y; ?></td>
					<td id="preguntas"> <?php echo $items[$y]; ?></td>
					<td id="cClarity"><?php echo $_2_tuplasC; ?></td>
					<td id="cWriting"><?php echo $_2_tuplas; ?></td>
					<td id="cPresence"><?php echo $_2_tuplasP; ?></td>
					<td id="cScale"><?php echo $_2_tuplas; ?></td>
					<td id="score"> <?php echo $_2_tuplas; ?></td>
					<td  class="nivel<?php echo $nivel; ?> texto_sombra"> <?php echo $label_output; ?></td>
					<td> <?php
						if ($label_output=="Excelent" || $label_output=="Very Correct" ) {
						 	echo  "<img src='images/check.png' width=25px>";
						 }else{
						 	echo  "<img src='images/no_check.png' width=25px>";
						 }
						 ?>
				 	</td>
				</tr>

				<?php } ?>
				<tfoot>
				<tr>
					<th></th>
					<th align="right">Results</th>
					<th><?php echo $_2_tuplasC; ?></th>
					<th><?php echo $_2_tuplas; ?></th>
					<th><?php echo $_2_tuplasP; ?></th>
					<th><?php echo $_2_tuplas; ?></th>
					<th>Total Score</th>
					<th><?php
						if ($label_output=="Excelent" || $label_output=="Very Correct" ) {
						 	echo  "<img src='images/check.png' width=25px>";
						 }else{
						 	echo  "<img src='images/no_check.png' width=25px>";
						 }
						 ?></th>
					<th>Consensus</th>
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
