<!DOCTYPE html> 
<html> 
<!--file: ot4b.php
    desc: Tarkistaa onko annettu ikä >= 18
    date: 6.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot4b </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot4.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Oletko täysi-ikäinen?</h2>
		<!--syöttökentät-->
		<label>Anna ikäsi:</label>
		<input type="text" name="ika" class="syote">

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Tarkista" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
				define ("AIKUINEN",18);
				
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					$ika=$_REQUEST['ika'];						 //luetaan syöte muuttujaan
					if ($ika!=null){							 //jos syöte ei ole tyhjä
						if (onKokonaisluku($ika)){				 //jos syöte on kokonaisluku
							if (onTaysiIkainen($ika)){			 //tarkistetaan ikä
								echo "Olet täysi-ikäinen";
							}
							else {
								echo "Et ole täysi-ikäinen";
							}								
						}
						else{									 //tyhjä syöte
							echo "Kirjoita ikäsi kokonaislukuna.";				
						}
					}
					else {
						echo "Ikä puuttuu, anna ikäsi.";
					}
				}
				
				//tarkistaa parametrina saamansa luvun suuruuden,
				//palauttaa true=on, false=ei ole
				function onTaysiIkainen($nro){
					if ($nro>=AIKUINEN){
						return true;
					}
					else{
						return false;
					}
				}
				
				//tarkistaa onko parametrin arvo kokonaisluku, palauttaa true=on, false=ei ole
				function onKokonaisluku($nro){
					if (filter_var($nro, FILTER_VALIDATE_INT) === 0 || !filter_var($nro, FILTER_VALIDATE_INT) === false){
						return true;
					}
					else{
						return false;
					}
				}
				
			?>
		</div>			
	</form>
 </body>

</html>