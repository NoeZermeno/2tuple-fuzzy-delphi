/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

'use strict';

;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			var ext = '';
				fileName = e.target.value.split( '\\' ).pop();
				ext = e.target.value.split(".").pop();
				
				alert(fileName);
				alert(ext);
			if( fileName && ext=="csv"){
				label.querySelector( 'span' ).innerHTML = fileName;
				show1();
			}
			else{

				label.innerHTML = labelVal;}
		});
	});
}( document, window, 0 ));

function show1() {
//   document.getElementsByClassName("importBtn")[0].style.display = "block";
	// $(".importBtn").show();
	
}

function hide1() {
  document.getElementsByClassName("importBtn")[0].style.display = "none";
}