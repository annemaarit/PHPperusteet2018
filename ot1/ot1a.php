<!DOCTYPE html> 
<html> 
<!--file: ot1a.php
    desc: Lauseen tulostus
    date: 12.2.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot1a </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot1.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 			
		<?php 
		//tekstin tulostus sivulle
		echo "<p>Hei maailma! <br> Ohjelmointi on hauskaa! <br> Haluan oppia lisää!</p>";
		?>			
	</form>
 </body>

</html>