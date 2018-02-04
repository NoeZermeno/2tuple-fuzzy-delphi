/*!
 * jQuery JavaScript Library v1.12.4
 * http://jquery.com/
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2016-05-20T17:17Z
 */
 
function show1(){
      		document.getElementById("but01").style.display = "block";
    }
		function hide1(){
      		document.getElementById("but01").style.display = "none";
    }

function fileValidation1(){
    var fileInput = document.getElementsByName('file1');
    var filePath = fileInput.value;
    var allowedExtensions = /(.csv)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Error! . . .  Please only upload files with .csv extension');
        fileInput.value = '';
        return false;
	}
} 

function fileValidation2(){
    var fileInput = document.getElementByName('file2');
    var filePath = fileInput.value;
    var allowedExtensions = /(.csv)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Error! . . .  Please only upload files with .csv extension');
        fileInput.value = '';
        return false;
	}
} 

function fileValidation3(){
    var fileInput = document.getElementByName('file3');
    var filePath = fileInput.value;
    var allowedExtensions = /(.csv)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Error! . . .  Please only upload files with .csv extension');
        fileInput.value = '';
        return false;
	}
}