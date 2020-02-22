/*  file: tahtitiede.js
    desc: Tähtitieteilijät sivun skriptit
    date: 26.3.2018
    auth: Maarit Parkkonen*/

var myIndex = 0;
$rakenne=$("#rakenne");

//sivun latautuessa
$(function(){			
	isoKaruselli();	
	$info.hide();
	haitari($rakenne);
});

//sivun alussa vaihtuvat isot avaruuskuvat
function isoKaruselli() {
    var i;
    var x = document.getElementsByClassName("avaruusDiat");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(isoKaruselli, 4000);    
}

//menupainikkeen planeetat -alavalikko
function avaaValikko() {
    var x = document.getElementById("valikko");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
    }
}

// avaa/sulkee menuvalikon
function menuAvaaSulje() {
    var x = document.getElementById("menuPainike");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

function haitari(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}


