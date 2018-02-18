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
