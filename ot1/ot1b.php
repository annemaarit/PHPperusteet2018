<!DOCTYPE html> 
<html> 
<!--file: ot1b.php
    desc: Tervetulotoivotus syötteenä annetulle nimelle
    date: 12.2.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot1b </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot1.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
		
		<!--nimen syöttökenttä-->
		<label>Kirjoita nimesi:</label>
		<input type="text" name="nimi" class="syote">
		
		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Paina" class="nappi">
		
		<!--vastauksen tulostusalue-->
		<div id="tuloste">
			<?php
				if (isset($_REQUEST['painike'])){ //jos painiketta painettu
					$nimi=$_REQUEST['nimi'];	  //luetaan syöte muuttujaan
					echo "Tervetuloa ".$nimi."!"; //tulostetaan syöte takaisin sivulle
				}
			?>
		</div>
	</form>
 </body>

</html>