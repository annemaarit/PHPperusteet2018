<!DOCTYPE html> 
<html> 
<!--file: ot1d.php
    desc: Laskee summan litrahinnan ja litramäärän
		  perusteella
    date: 12.2.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot1d </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot1.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 			
		<h2>Bensapumppu</h2>
		<!--syöttökentät-->
		<label>Litrahinta:</label>
		<input type="text" name="hinta" class="syote">
		<label>Litramäärä:</label>
		<input type="text" name="maara" class="syote">
		
		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Laske maksettava" class="nappi">
		
		<!--tulostusalue syöttökenttien arvoille-->
		<div id="tuloste2">
			<?php
				if (isset($_REQUEST['painike'])){	//jos painiketta painettu
					$hinta=$_REQUEST['hinta'];		//luetaan syöte muuttujaan
					$maara=$_REQUEST['maara'];		//luetaan syöte muuttujaan
					echo "Litrahinta: ".$hinta." €<br>Litramäärä: ".$maara." l"; //tulostetaan syötteet takaisin sivulle
				}
			?>
		</div>
		
		<!--tulostusalue laskennan tulokselle eli summalle-->
		<div id="tuloste">
			<?php
				if (isset($_REQUEST['painike'])){	//jos painiketta painettu
					$hinta=$_REQUEST['hinta'];		//luetaan syöte muuttujaan
					$maara=$_REQUEST['maara'];		//luetaan syöte muuttujaan
					$summa=$hinta*$maara;			//lasketaan summa
					echo "Maksettava ".$summa." €";		//tulostetaan summa sivulle
				}
			?>	
		</div>
	</form>
 </body>

</html>