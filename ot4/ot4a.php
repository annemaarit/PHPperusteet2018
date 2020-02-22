<!DOCTYPE html> 
<html> 
<!--file: ot4a.php
    desc: Laskee käyttäjän antamalle luvulle neliöarvon
    date: 6.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot4a </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot4.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Neliön laskenta</h2>
		<!--syöttökentät-->
		<label>Anna kokonaisluku:</label>
		<input type="text" name="luku" class="syote">

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Laske luvun neliö" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					$luku=$_REQUEST['luku'];						 //luetaan syöte muuttujaan
					if ($luku!=null){								 //jos syöte ei ole tyhjä
						if (onKokonaisluku($luku)){					 //jos syöte on kokonaisluku
							$nelio=laskeLuvunNelio($luku);			 //neliön laskenta
							echo "Luvun ".$luku." neliö on ".$nelio; //tuloksen tulostus														
						}
						else{										 //tyhjä syöte
							echo "Anna kokonaisluku!";				
						}
					}
					else {
						echo "Luku puuttuu, anna kokonaisluku.";
					}
				}
				
				//laskee parametrina saamansa luvun neliön ja palauttaa tuloksen
				function laskeLuvunNelio($nro){
					return ($nro*$nro);
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