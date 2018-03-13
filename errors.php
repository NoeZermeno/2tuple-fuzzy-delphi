<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GRID</title>
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" href="CSS/menu_tools_style.css"> -->
	<link rel="stylesheet" href="css/style_trim.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link href="https://file.myfontastic.com/VDXsxxmWcbZZG8xXax2UK4/icons.css" rel="stylesheet">
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet"> -->
	<script type="text/javascript" src="JS/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<main class="internalMain">
		<header class="internalHeader">
			<div class="logoDaCSI internalLogo"><img src="./img/DaSCI_logo_180px.png" alt="Logo " ></div>
			<div class="logo2Tuplas"><img src="./img/internal_header.png" alt="Logo "></div>
			<div class="logoUGR internalLogo"><img src="./img/UGR_logo_180px.png " alt="Logo " ></div>
		</header>
		<nav class="navBar">
			<div class="siteMenuContainer">
				<ul class="siteMenu">
					<li class="menuItem">
						<a href="./index.html"> HOME</a>
					</li>
					<li class="menuItem">
						<a href="./import.html"> IMPORT</a>
					</li>
					<li class="menuItem">
						<a href="#"> ANNEX</a>
					</li>
					<li class="menuItem">
						<a href="https://github.com/NoeZermeno/2tuple-fuzzy-delphi"> CODE SOURCE</a>
					</li>
				</ul>
			</div>
			
		</nav>
		<article class="internalContent">
			<div class="mainInternalContent">
				<?php
			if (isset($_GET['error_mensaje'])) {
						// array de mensajes.
				$mensajes[0] = "blablalba";
				$mensajes[1] = "nose nose";
				$mensajes[2] = "etc";
				$mensajes[3] = "falla encabezado";
				if (in_array($_GET['error_mensaje'], $mensajes)) {
					echo "Error: " . $mensaje {
						$_GET['error_mensaje']};
				} else {
					if ($_GET['error_mensaje'] == 0) {
						echo "<h2 class='titleContainer'> Does not match headers</h2>";
					}
					if ($_GET['error_mensaje'] == 1) {
						echo "<h2 class='titleContainer'>Does not match number of Judges</h2>";
					}
					if ($_GET['error_mensaje'] == 2) {
						echo "<h2 class='titleContainer'>Does not match number of Items</h2>";
					}
					if ($_GET['error_mensaje'] == 3) {
						echo "<h2 class='titleContainer'>The file that has been uploaded has headers</h2>";
					}
				}
			}
			?>
			</div>
		</article>
		<footer>
			<div class="textFooter">
				<p>University of Granada License CC-By-NC-SA</p>
			</div>
			<div class="iconsFooter">
				<a href="https://github.com/NoeZermeno/2tuple-fuzzy-delphi" class="icon-github" target="_blank"></a>
				<a href="https://twitter.com/DaSCI_es" title="twitter_DaSCI" class="icon-twitter" target="_blank"></a>
			</div>
		</footer>
	</main>	




	
</body>

</html>
