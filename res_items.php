<?php
    include ("item.php");
	$max = 7;
	$total =46;
	$levels = '<table id="levels">';
	$levels .= '<tr>';
	$count = '';
	for ($x = 1; $x <= $max; $x++) {
		$levels .= '<td class="level' . $x . '">' . 's<sub>' .$x. '</sub>'.  '</td>';		
	}
	$levels .= '</tr>';
	$levels .= '</table>';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Final Results</title>
		<link rel="stylesheet" type="text/css" href="CSS/style_results.css">
		<link rel="stylesheet" type="text/css" href="CSS/style_trim.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"/>
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
		<link href="https://file.myfontastic.com/VDXsxxmWcbZZG8xXax2UK4/icons.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		<script type="text/javascript" src="JS/jquery-1.12.4.js"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.js"></script>
		<script type="text/javascript" src="DataTables/datatables.min.js"></script>

		
			
		<script type="text/javascript">
			
            //Filter for the Trim tool: Filters the data table according to the selected color (button).


			function fun(value){

				for (var x = 1; x < 7; x++) {
                    if (x < value) {
						$('#data td.level' + x).parent('tr').addClass('hidden');
					} else {
							$('#data td.level' + x).parent('tr').removeClass('hidden');
					}
                }
			}
            
            //
            function show_valueS(x)
				{
				 document.getElementById("CI").innerHTML=x;
				}
				function show_valueE(x)
				{
				 document.getElementById("EC").innerHTML=x;
				}

            // Filter visualization options: allows filtering according to the selected criteria.
            function hideColumns(sel){
               
                if (sel=="allInformation") {
                    for (i=3 ; i<=$('#tableDataBody tr:last td').length ; i++){
                        $('.col_' + i).show();		
                    }	
                }else {
                    for (i=3 ; i<=6 ; i++){
                        if (i!=sel){
                            $('.col_'+sel).show();
                            $('.col_' + i).hide();		
                        }
                    }
                }
            }


            
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
				var oTableData = $('#data').DataTable({
					"scrollResize": true,
	    			"scrollY": 450,
	    			"scrollCollapse": true,
	    			"paging": false,
					"order": [[0, "asc"]],
					"searching": false,
					"columnDefs": [
						{
							"targets": [1],
							"visible": true
						}
					]
				});
			});
		</script>
	</head>
	
	<body>
		<div class="menu_bar">
			<nav class = "menu">
				<ul>
					<li><a href="" title="">HOME</a></li>
					<li><a href="" title="">IMPORT</a></li>
					<li><a href="" title="">ABOUT US</a></li>
				</ul>
			</nav>
		</div>

			<!--<div class="encabezado">
				<img src= "images/A1.png" alt="Pages header" id="logos">
			</div>--> 

		<section>
			<br>
				<h1 id="title">2-tuple Linguistic Delphi Method to Validate a Questionnaire by Consensus for a Blended Enviroment</h1>
			<br>
		</section>

		<div class="options_bar">
			<table>
				<tr>
					<td>
						<div class="Visualization_select" id="Consensus">
							<p> Visualization options: </p>
							<div class="styled-select semi-square">
							  <select onchange="hideColumns(this.value);">
							    <option value="allInformation">All information</option>
							    <option value="3">Collective Clarity</option>
							    <option value="4">Collective Writing</option>
							    <option value="5">Collective Presence</option>
							    <option value="6">Collective Answering Scale</option>
							    <option value="7">Average Relevance</option>
							    <option value="8">Consensus</option>
							  </select>
							</div>
						</div>
					</td>
					
					<td>
						<div class="options_bar" id="Consistency">
							<p> Trim Tool: visualizes crop items below the following label</p>	
					    <div class='btns'>
					      <label>
					        <input checked='' name='button-group' type='radio' value=1 class="bc" onclick="fun(this.value)">
					          <span class='btn first'>S<sub>0</sub></span>
					        </input>
					      </label>
					      <label>
					        <input name='button-group' type='radio' value=2 class="bc" onclick="fun(this.value)">
					          <span class='btn'>S<sub>1</sub></span>
					        </input>
					      </label>
					      <label>
					        <input name='button-group' type='radio' value=3 class="bc" onclick="fun(this.value)">
					          <span class='btn'>S<sub>2</sub></span>
					        </input>
					      </label>
					      <label>
					        <input name='button-group' type='radio' value='4' class="bc" onclick="fun(this.value)">
					          <span class='btn'>S<sub>3</sub></span>
					        </input>
					      </label>
					      <label>
					        <input name='button-group' type='radio' value='5' class="bc" onclick="fun(this.value)">
					          <span class='btn'>S<sub>4</sub></span>
					        </input>
					      </label>
					      <label>
					        <input name='button-group' type='radio' value='6' class="bc" onclick="fun(this.value)">
					          <span class='btn'>S<sub>5</sub></span>
					        </input>
					      </label>
					      <label>
					        <input name='button-group' type='radio' value='7' class="bc" onclick="fun(this.value)">
					          <span class='btn last'>S<sub>6</sub></span>
					        </input>
					      </label>
					    </div>
					  
						</div>
					</td>
					<td class="w10">
						<div class="options_bar" id = "Consistency_Index">
						  <p>Satisfiable Consistency Level: </p>
						   <input type="range" min="0" max="1"  step = ".1" value="0" class="slider" id="Consistency_Index" onchange="show_valueS(this.value);"><br>
                          
						   <label name="CI" id = "CI">0</label>
						</div>
					</td>
<!--					<td class="w10">
						<div class="options_bar" id = "Panel_Expert">
						  <p>Expert Panel Confidence: </p>
						   <input type="range" min="0" max="1"  step = ".1" value="0" class="slider" id="expert_confidence" onchange="show_valueE(this.value);"><br>
						   <label name="EC" id = "EC">0</label>
						</div>
					</td>-->
					<td class="w20">
						<div class="options_bar" id="Total_score">
							<p> Questionnaire Total Score: <h4>(Very correct , -0.45 )</h4></p>
							
						</div>
					</td>
					<td>
						<div id="data_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder=""  aria-controls="data"></label></div>
					</td>-->
				</tr>
			</table>
		</div>
		

		<div id="divDataTable">
		<table id="data" class="display" cellspacing="0" width="100%">
			<thead >
				<tr>
					<th class="col_1">Num</th>
					<th class="col_2">Item</th>
					<th class="col_3">Collective Clarity</th>
					<th class="col_4">Collective Writing</th>
					<th class="col_5">Collective Presence</th>
					<th class="col_6">Collective Scale</th>
					<th class="col_7">Score</th>
					<th class="col_8">Consensus</th>
					<th class="col_9">Total</th>
				</tr>
			</thead>

			<tbody id=tableDataBody>
				
				<?php 
				$label_output="";   //Variable temporal mientras se obtienen los resultados finales
					
					/*--Row creation--*/
					for ($y = 1; $y <= $total; $y++) {
				?>
				<tr>
					<td class="col_1" > <?php echo $y; ?></td>
                    <td class="col_2" id="preguntas"> <?php echo getItem($y-1)['item']; ?></td>
					<td class="col_3" id="cClarity"><?php echo linguisticLabel($y-1,'CC');?></td>
					<td class="col_4" id="cWriting"><?php echo linguisticLabel($y-1,'CW'); ?></td>
					<td class="col_5" id="cPresence"><?php echo linguisticLabel($y-1,'CP');?></td>
					<td class="col_6" id="cScale"><?php echo linguisticLabel($y-1,'CAS'); ?></td>
					<td class="col_7" id="score"> <?php echo linguisticLabel($y-1,'score');?></td>
					
					<td class="col_8"> <?php
						if ($label_output=="Excelent" || $label_output=="Very Correct" ) {
						 	echo  "<img src='images/check.png' width=25px>";
						 }else{
						 	echo  "<img src='images/no_check.png' width=25px>";
						 }
						 ?>
				 	</td>
				 	<td class=" level<?php echo linguisticLabel($y-1,'level'); ?> texto_sombra col_9" > <?php echo linguisticLabel($y-1,'Total'); ?></td>
				</tr>

				<?php } ?>
				<tfoot>
				<tr>
					<th>Showing 10 of 45</th>
					<th align="right">Results</th>
					<th><?php echo "Falta"; ?></th>
					<th><?php echo "Falta"; ?></th>
					<th><?php echo "Falta"; ?></th>
					<th><?php echo "Falta"; ?></th>
					<th>(Very correct , -0.45 )</th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
			</tbody>
		</table>
	</div>

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
