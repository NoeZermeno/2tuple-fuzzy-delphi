<?php
    include ("item.php");
	$max = 7;
	$total =46;
	$levels = '<table id="levels">';
	$levels .= '<tr>';
	$count = '';
	for ($x = 1; $x <= $max; $x++) {
		$levels .= '<td class="nivel' . $x . '">' . 's<sub>' .$x. '</sub>'.  '</td>';		
	}
	$levels .= '</tr>';
	$levels .= '</table>';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>GRID</title>
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/menu_tools_style.css">
        <link rel="stylesheet" href="CSS/style_trim.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link href="https://file.myfontastic.com/VDXsxxmWcbZZG8xXax2UK4/icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
        <script type="text/javascript" src="JS/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            //Filter for the Trim tool: Filters the data table according to the selected color (button).
            function fun(value) {
                for (var x = 1; x < 7; x++) {
                    if (x < value) {
                        $('#datos td.level' + x).parent('tr').addClass('hidden');
                    }
                    else {
                        $('#datos td.level' + x).parent('tr').removeClass('hidden');
                    }
                }
            }
            //
            function show_valueS(x) {
                document.getElementById("CI").innerHTML = x;
            }

            function show_valueE(x) {
                document.getElementById("EC").innerHTML = x;
            }
            // Filter visualization options: allows filtering according to the selected criteria.
            function hideColumns(sel) {
                if (sel == 0) {
                    for (i = 3; i <= $('#tableDatosBody tr:last td').length; i++) {
                        $('.col_' + i).show();
                    }
                }
                else {
                    for (i = 3; i <= 6; i++) {
                        if (i != sel) {
                            $('.col_' + sel).show();
                            $('.col_' + i).hide();
                        }
                    }
                }
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                var oTablaDatos = $('#datos').DataTable({
                    "scrollResize": true
                    , "scrollY": 450
                    , "scrollCollapse": true
                    , "paging": false
                    , "order": [
                        [0, "asc"]
                    ]
                    , "searching": false
                    , "columnDefs": [{
                        "targets": [1]
                        , "visible": true
                    }]
                });
            });
        </script>
    </head>

    <body>
        <main>
            <nav class="menu" id="nav_page_menu">
                <div id="tools_menu_prueba">
                    <div class='cssmenu'>
                        <ul>
                            <li class="tools_menu"><a href="">Visualizations</a>
                                <ul class="tools_menu">
                                    <li class="visualization" value="0" onclick="hideColumns(this.value)">All Information</li>
                                    <li class="visualization" value="3" onclick="hideColumns(this.value)">Collective Clarity</li>
                                    <li class="visualization" value="4" onclick="hideColumns(this.value)">Collective Writting</li>
                                    <li class="visualization" value="5" onclick="hideColumns(this.value)">Collective Presence</li>
                                    <li class="visualization" value="6" onclick="hideColumns(this.value)">Collective Answering Scale</li>
                                    <li class="visualization" value="7" onclick="hideColumns(this.value)">Average Revelance</li>
                                    <li class="visualization" value="8" onclick="hideColumns(this.value)">Consensus</li>
                                </ul>
                            </li>
                            <li class="tools_menu"><a href=""> Trim Tool</a>
                                <ul>
                                    <li class=li_menu>
                                        <div class="options_bar" id="Consistency">
                                            <p> Trim Tool: visualizes crop items below the following label</p>
                                            <div class='btns'>
                                                <label>
                                                    <input checked='' name='button-group' type='radio' value=1 class="bc" onclick="fun(this.value)"> <span class='btn first'>S<sub>0</sub></span> </label>
                                                <label>
                                                    <input name='button-group' type='radio' value=2 class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>1</sub></span> </label>
                                                <label>
                                                    <input name='button-group' type='radio' value=3 class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>2</sub></span> </label>
                                                <label>
                                                    <input name='button-group' type='radio' value='4' class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>3</sub></span> </label>
                                                <label>
                                                    <input name='button-group' type='radio' value='5' class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>4</sub></span> </label>
                                                <label>
                                                    <input name='button-group' type='radio' value='6' class="bc" onclick="fun(this.value)"> <span class='btn'>S<sub>5</sub></span> </label>
                                                <label>
                                                    <input name='button-group' type='radio' value='7' class="bc" onclick="fun(this.value)"> <span class='btn last'>S<sub>6</sub></span> </label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="tools_menu"> <a href="">Satisfiable Consistency</a>
                                <ul>
                                    <li class=li_menu>
                                        <div class="options_bar" id="Consistency_Index">
                                            <p>Satisfiable Consensus Level: </p>
                                            <input type="range" min="0" max="1" step=".1" value="0" class="slider" id="Consistency_Index" onchange="show_valueS(this.value);">
                                            <br>
                                            <label name="CI" id="CI">0</label>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cssmenu">
                    <ul>
                        <li class="tools_menu"><a href="" title="">HOME</a></li>
                        <li class="tools_menu"><a href="" title="">IMPORT</a></li>
                        <li class="tools_menu"><a href="" title="">ABOUT US</a></li>
                    </ul>
            </nav>
            <header>
                <!--<img src="images/header_logo.png" alt="logo" id="logo">-->
                <h1 id="title">2-tuple Fuzzy Delphi Tool System</h1> </header>
            <section id="table_content">
                <table id="datos" class="display" cellspacing="0" width="100%">
                    <thead>
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
                    <tbody id=tableDatosBody>
                        <?php 
				$label_output="";   //Variable temporal mientras se obtienen los resultados finales
					
					/*--Row creation--*/
					for ($y = 1; $y <= $total; $y++) {
                     
				?>
                            <tr>
                                <td class="col_1">
                                    <?php echo $y; ?>
                                </td>
                                <td class="col_2" id="questions">
                                    <?php echo getItem($y-1)['item']; ?>
                                </td>
                                <td class="col_3" id="cClarity">
                                    <?php echo linguisticLabel($y-1,'CC');?>
                                </td>
                                <td class="col_4" id="cWriting">
                                    <?php echo linguisticLabel($y-1,'CW'); ?>
                                </td>
                                <td class="col_5" id="cPresence">
                                    <?php echo linguisticLabel($y-1,'CP');?>
                                </td>
                                <td class="col_6" id="cScale">
                                    <?php echo linguisticLabel($y-1,'CAS'); ?>
                                </td>
                                <td class="col_7" id="score">
                                    <?php echo linguisticLabel($y-1,'score');?>
                                </td>
                                <td class="col_8">
                                    <?php
						if ($label_output=="Excelent" || $label_output=="Very Correct" ) {
						 	echo  "<img src='images/check.png' width=25px>";
						 }else{
						 	echo  "<img src='images/no_check.png' width=25px>";
						 }
						 ?> </td>
                                <td class=" level<?php echo linguisticLabel($y-1,'level'); ?> texto_sombra col_9">
                                    <?php echo linguisticLabel($y-1,'Total'); ?>
                                </td>
                            </tr>
                            <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>Showing 10 of 45</th>
                                        <th align="right">Results</th>
                                        <th>
                                            <?php echo "Falta"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Falta"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Falta"; ?>
                                        </th>
                                        <th>
                                            <?php echo "Falta"; ?>
                                        </th>
                                        <th>(Very correct , -0.45 )</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                    </tbody>
                </table>
            </section>
            <footer>
               <div class="footer_text"><p>License CC-By-NC-SA University of Granada Contact: <br> rosana@ugr.es, jeovani@correo.ugr.es, nzermeno@correo.ugr.es, jeronimoduran@correo.ugr.es, herrera@decsai.ugr.es</p> </div>
                <div class="icons">
                    <div class="icon-github">
                        <a href="" title=""></a>
                    </div>
                    <div class="icon-twitter">
                        <a href="https://twitter.com/canalugr" title="twitter_UGR"></a>
                    </div>
                </div>
            </footer>
        </main>
    </body>

    </html>