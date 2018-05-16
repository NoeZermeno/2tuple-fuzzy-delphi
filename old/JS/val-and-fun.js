/*!
 * jQuery JavaScript Library v1.12.4
 * http://jquery.com/
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2016-05-20T17:17Z
 */
$(document).ready(function() {
  hide1(); //clear input files labels
});

// // 
// function ext_cont(f) {
// 	var ext = ['csv'];
// 	var v = f.value.split('.').pop().toLowerCase();
// 	for (var i = 0, n; n = ext[i]; i++) {
// 		if (n.toLowerCase() == v) {
// 			show1();
// 			return
// 		}
// 	}
// 	var t = f.cloneNode(true);
// 	t.value = '';
// 	f.parentNode.replaceChild(t, f);
// 	alert('The file extension is not valid. Please enter a file »name.csv«');
// }

// Function to verify file extension and change icon color	
"use strict";
(function (document, window, index) {
	 // this function clean the file
	var inputs = document.querySelectorAll(".inputfile");
	Array.prototype.forEach.call(inputs, function (input) {
		var label = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener("change", function (e) {
			var fileName = "";
			var ext = "";
			fileName = e.target.value.split("\\").pop();
			ext = e.target.value.split(".").pop();


			if (fileName && ext == "csv") {
				label.querySelector("span").innerHTML = fileName;
				if (e.target.id == "file-1") {
					$(".hidden").show();
					$("#imgFile-1").attr("src", "img/upload_ok.png");
				} else{ 
					if (e.target.id == "file-2") {
						$("#imgFile-2").attr("src","img/upload_ok.png");
					} else{
						if (e.target.id == "file-3") {
						$("#imgFile-3").attr("src", "img/upload_ok.png");
						}
					}
				}
			
			} else {
				label.innerHTML = labelVal;
				if (e.target.id == "file-1") {
						$(".hidden").hide();
					$("#imgFile-1").attr("src", "img/upload.png");
				} else{
					if (e.target.id == "file-2") {
						$("#imgFile-2").attr("src", "img/upload.png");
					} else{
						if (e.target.id == "file-3") {
							$("#imgFile-3").attr("src", "img/upload.png");
						}
					}
				}	
				alert("The file extension is not valid. Please enter a file »name.csv«");
			}
		});
	});
})(document, window, 0);

//Function for cleaning the form
function hide1() {
	
	$(".hidden").hide();
	$("#imgFile-1").attr("src", "img/upload.png");
	$("span.iclearinputfile").text("Choose file...");
	$("img.iclearinputfile	").attr("src", "img/upload.png");
}

   
