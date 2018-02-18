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
	
</head>
<body>
	


<main>
	<nav class="menu" id="nav_bar">
		<div class='cssmenu' id="tools_menu">
			
		</div>

		<div class="cssmenu" id="page_menu">
			<ul>
				<li class="li_menu"><a href="index.html" title="">HOME</a></li>
				<li class="li_menu"><a href="import.html" title="">IMPORT</a></li>
				<li class="li_menu"><a href="" title="">ANNEX</a></li>
				<li class="li_menu"><a href="" title="https://github.com/NoeZermeno/2tuple-fuzzy-delphi">SOURCE cODE</a></li>
			</ul>
		</nav>
		<header>
			<!--<img src="images/header_logo.png" alt="logo" id="logo">-->
			<img src="images/DaSCI_logo_green.png" alt="logo_DaSCI" height="70px" id="logo_DaSCI">
				<h1 id="title">2-tuple Fuzzy Delphi Tool System</h1> 
				<img src="images/UGR_logo_white_small.png" alt="logo_UGR" height="70px" id="logo_UGR"> 
		</header>
		<section id="main_content">
		<?php




if (isset($_GET['error_mensaje'])){

   // array de mensajes.
  $mensajes[0]="blablalba";
  $mensajes[1]="nose nose";
  $mensajes[2]="etc";
  $mensajes[3]="falla encabezado";

  if (in_array($_GET['error_mensaje'],$mensajes)){
     echo "Error: ".$mensaje{$_GET['error_mensaje']};
  } else {
  	 if($_GET['error_mensaje'] == 0) {
  	 	echo "Does not match headers <br>";
  	 }
  	 if($_GET['error_mensaje'] == 1) {
  	 	echo "Does not match number of Judges<br>";
  	 }
  	 if($_GET['error_mensaje'] == 2) {
  	 	echo "Does not match number of Items<br>";
  	 }
     if($_GET['error_mensaje'] == 3) {
  	 	echo "The file that has been uploaded has headers<br>";
  	 }
  }
}

?>
		</section>
		<footer>
			<div class="footer_text"><p>License CC-By-NC-SA University of Granada Contact: <br> rosana@ugr.es, jeovani@correo.ugr.es, nzermeno@correo.ugr.es, jeronimoduran@correo.ugr.es, herrera@decsai.ugr.es</p> </div>
			<div class="icons">
				<a href="https://github.com/NoeZermeno/2tuple-fuzzy-delphi" class="icon-github"></a>
				<a href="https://twitter.com/DaSCI_es" title="twitter_DaSCI" class="icon-twitter"></a>
			</div>
		</footer>
	</main>
</body>

</html>
