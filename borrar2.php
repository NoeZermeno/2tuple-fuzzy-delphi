<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="estilo_btn_select.css"
	<script src="jquery-3.3.1.min.js" type="text/javascript"></script>
<script>

	function ocultar(sel){
		
		if (sel=="todos") {
			for (i=1 ; i<=$('#datos tr:last td').length ; i++){
				$('.' + i).show();		
			}	
			
		}else {
			for (i=1 ; i<=$('#datos tr:last td').length ; i++){
			 	if (i!=sel){
					$('.'+sel).show();
					$('.' + i).hide();		
				}
			}
		
		}
	}

	

		
</script>

<link rel="stylesheet" href="estilo.css">
</head>
<body>
	<select onchange="ocultar(this.value);">
      <option value='todos'>Todos</option>
      <option value='1'>Gateway 1</option>
      <option value='2'>Gateway 2</option>
      <option value='3'>Gateway 3</option>
      




 </select>


<table id="datos" align="center" border="2">
	<tr>
		<td class="1"> Colum 1</td>
		<td class="2"> Colum 2</td>
		<td class="3"> Colum 3</td>
		<td > Results</td>
	</tr>
	<tr>
		
		<td class ="1">1</td>
		<td class ="2">4</td>
		<td class ="3">7</td>
		<td > 12</td>
	</tr>
	<tr>
		
		<td class ="1">2</td>
		<td class ="2">5</td>
		<td class ="3">8</td>
		<td > 10</td>
	</tr>
	<tr>
		
		<td class ="1">3</td>
		<td class ="2">6</td>
		<td class ="3">9</td>
		<td > 25</td>
	</tr>
</table>

    <div class="switch">
  <input name="switch" id="one" type="radio" checked/>
  <label for="one" class="switch__label">One</label>
  <input name="switch" id="two" type="radio" />
  <label for="two" class="switch__label">Two</label>
  <input name="switch" id="three" type="radio" />
  <label for="three" class="switch__label">Three</label>
  <div class="switch__indicator" /></div>
</div>
    
   
</div>
    
</body>
</html>



