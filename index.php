<!DOCTYPE html>
<section class="main">
<?php include ('Diseño.php')?>
 <div class="wrapp">
			<div class="imagen">
				<a><img src="A03.png" ></a>
			</div>
		</div>
<div class="wrapp">  
  		
         <br>	
        <h3>Select your file that has the database of your questionnaire</h3>
  		<br/>
					
  		 
        <div class="apartado_1">
			<h3>Questionnaire plain data import</h3>
            <br>
           
          <form action="script1.php" method="post">
   					Iteration : 
   						<select name="selector">    
       					<option value="1" selected="1">1</option>
       					<option value="2">2</option>
      					<option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
  						</select>
			</form>          
           <br><br>
           
           <form>
 				 	<P> <strong>Content type </strong>: </P> 
 				 	<br/>
             <input type="radio" name="gender" value="Response" checked> Response<br>
					<input type="radio" name="gender" value="female"> Result<br>
			 <input type="radio" name="gender" value="Expert weight"> Expert weight
		  </form>
                      
           <br/><br/><br/>
            <form name="form1" method="post" action="">
              <label>
                <input type="checkbox" name="head1" id="head1">
                Use headings</label>
            </form>
            <br/><br/>
            
            
          <form action='fuzzy_tab.php' method='post' enctype="multipart/form-data">
   			Importing file CSV : <input type='file' name='fichero' size='20'>
            <br><br><br>
            <input name='submit' type='submit' class="boton3" value='Import & Analyze '>
  			</form>         
				
		        
        </div>
 		<div class="Texto2">
				<section><br>
				  <br><br>
                </section>
		</div>
</section>
<<footer>
    <div class="wrapp">
      <p>Página ASOC 2018</p>
    </div>
</footer>
</html>
	