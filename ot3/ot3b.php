<!DOCTYPE html> 
<html> 
<!--file: ot3b.php
    desc: tekstitiedoston valinta ja sen sisällön luku sekä näyttö
    date: 5.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot3b </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot3b.css"> 
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Palautteiden luku</h2>
		<label for="tiedosto">Valitse tiedosto:</label>
		<input type="file" name="tiedosto" accept=".txt" required>

		<!--tiedoston tietojen lukupainike-->
		<input type="submit" name="painike" value="Näytä tiedot" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
			if (isset($_REQUEST['painike'])){
				$tiedostoNimi=$_REQUEST['tiedosto'];		//luetaan valitun tiedoston nimi muuttujaan
				
				//jos tiedostoa ei ole
				if(!file_exists($tiedostoNimi)) {
					die("Tiedostoa ei löytynyt");			//virheilmoitus
				} 
				else {	//tiedosto on
					$tiedosto=fopen($tiedostoNimi,"r");						//avataan tiedosto
					$palautteet=fread($tiedosto,filesize($tiedostoNimi));	//luetaan koko tiedoston sisältö
					fclose($tiedosto);										//suljetaan tiedosto
					$palautteet=str_replace("\r\n","<br><br>",$palautteet); //muutetaan windowsin rivinvaihdot html:n 2xbr:ksi
					echo "<p>".$palautteet."</p>";							//tulostetaan sisältö
				}
			}
			?>
		</div>			
	</form>
 </body>

</html>