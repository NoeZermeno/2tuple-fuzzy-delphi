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
function ext_cont(f){
        var ext=['csv'];
        var v=f.value.split('.').pop().toLowerCase();
        for(var i=0,n;n=ext[i];i++){
            if(n.toLowerCase()==v)
                return
              }
        var t=f.cloneNode(true);
        t.value='';
        f.parentNode.replaceChild(t,f);
        alert('extensión no válida');
}
