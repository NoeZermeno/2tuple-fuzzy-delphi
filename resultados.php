<?php
	$max = 7;
	$total = 50;
	$niveles = '<table id="niveles">';
	$niveles .= '<tr>';
	for ($x = 1; $x <= $max; $x++) {

		$niveles .= '<td class="nivel' . $x . '"></td>';
		
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
				"order": [[6, "asc"]],
				"columnDefs": [
					{
						"targets": [6],
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
</head>
<body>
		
		
		<div class="iconos_redes">
			<a href="" title=""><div class="icon-github iconos"></div></a>
			<a href="https://www.ugr.es/servicios/correo-electronico" title="correo_UGR"><div class="icon-mail iconos"> </div></a>
			<a href="https://www.youtube.com/user/UGRmedios" title="medios_UGR"><div class="icon-youtube iconos"> </div></a>
			<a href="https://twitter.com/canalugr" title="twitter_UGR"><div class="icon-twitter iconos"></div></a>
			<a href="https://www.facebook.com/universidadgranada/" title="facebook_UGR"><div class="icon-facebook iconos"></div></a>
		</div>

		<div id="logo_ugr">
			<img src="images/UGR_logo2.png" alt="logo UGR" height="160px" class="left">
			<img src="images/DaSCI_logo.png" alt="dAscIlogo UGR" height="150px" class="right">
		</div>
	
		<section>
			<br>
			<h1>RESULTADOS</h1>
			<br>		
				</section>		
	
	<div id="bloque">
		<?php echo $niveles; ?>
		<input type="range" name="rango" id="rango" min="1" max="<?php echo $max; ?>">
	</div>
	<table id="datos" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Item</th>
				<th>Mean</th>
				<th>Desv. STD</th>
				<th>CoV</th>
				<th>2-tuple</th>
				<th>Label output</th>
				<th>Consensus</th>
	
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Item</th>
				<th>Mean</th>
				<th>Desv. STD</th>
				<th>CoV</th>
				<th>2-tuple</th>
				<th>Label output</th>
				<th>Consensus</th>
			</tr>
		</tfoot>
		<tbody>
			<?php 
			function randomFloat($min = 0, $max = 1) {
 		    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
			}

			$_2_tuplas = 0;
			$label_output="";
				for ($y = 1; $y <= $total; $y++) { 
					//$nivel = rand(1, $max);

					 
					$mean = round(randomFloat(3,6),2);
					$CoV = round(randomFloat(0,0.7),2);
					
					 if ($mean >5.4){
					 	$_2_tuplas = "(S<sub>6</sub>, " . round(($mean-6),2)  . ")";
					 	$label_output = "Excelente";
					 } elseif ($mean>4.9) {
					 	$_2_tuplas = "(S<sub>5</sub>, " . round(($mean-5),2)  . ")";
					 	$label_output = "Muy Correcto";
					 }elseif ($mean>4.4) {
					 	$_2_tuplas = "(S<sub>5</sub>, " . round(($mean-5),2)  . ")";
					 	$label_output = "Muy Correcto";
					 }elseif ($mean>3.9) {
					 	$_2_tuplas = "(S<sub>4</sub>, " . round(($mean-4),2)  . ")";
					 	$label_output = "Correcto";
					 }elseif ($mean>3.4) {
					 	$_2_tuplas = "(S<sub>4</sub>, " . round(($mean-4),2)  . ")";
					 	$label_output = "Correcto";
					 }elseif ($mean>2.9) {
					 	$_2_tuplas = "(S<sub>3</sub>, " . round(($mean-3),2)  . ")";
					 	$label_output = "Moderado";
					 }elseif ($mean>2.4) {
					 	$_2_tuplas = "(S<sub>3</sub>, " . round(($mean-3),2)  . ")";
					 	$label_output = "Moderado";
					 }elseif ($mean>1.9) {
					 	$_2_tuplas = "(S<sub>2</sub>, " . round(($mean-2),2)  . ")";
					 	$label_output = "Incorrecto";
					 }elseif ($mean>1.4) {
					 	$_2_tuplas = "(S<sub>2</sub>, " . round(($mean-2),2)  . ")";
					 	$label_output = "Incorrecto";
					 }elseif ($mean>0.9) {
					 	$_2_tuplas = "(S<sub>1</sub>, " . round(($mean-1),2)  . ")";
					 	$label_output = "Muy Incorrecto";
					 }elseif ($mean>0.5) {
					 	$_2_tuplas = "(S<sub>1</sub>, " . round(($mean-1),2)  . ")";
					 	$label_output = "Muy Incorrecto";
					 }else{
					 	$_2_tuplas = "(S<sub>0</sub>, " . round(($mean-0),2)  . ")";
					 	$label_output = "Pésimo";
					 }


					 if ($CoV<.1) {
					 	$nivel = 7;
					 }elseif ($CoV<.2) {
					 	$nivel = 6;
					 }elseif ($CoV<.3) {
					 	$nivel = 5;
					 }elseif ($CoV<.4) {
					 	$nivel = 4;
					 }elseif ($CoV<.5) {
					 	$nivel = 3;
					 }elseif ($CoV<.7) {
					 	$nivel = 2;
					 }elseif ($CoV<.85) {
					 	$nivel = 1;
					 }else{
					 	$nivel=1;
					 }

			?>
			<tr>
				<td> <?php echo $y; ?></td>
				<td> <?php echo $mean; ?></td>
				<td> <?php echo round(randomFloat(0,2),2); ?></td>
				<td> <?php echo $CoV; ?></td>
				<td> <?php echo $_2_tuplas; ?></td>
				<td  class="nivel<?php echo $nivel; ?> texto_sombra"> <?php echo $label_output; ?></td>
				<!--<td class="texto_sombra"> <?php echo $label_output; ?></td>-->
				

				<td> <?php 

				if ($CoV<.5) {
				 	echo "YES";
				 }else{
				 	echo "NO";
				 } 
				 ?></td>
				 <td></td>
			</tr>
			<?php } ?>
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