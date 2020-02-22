<!DOCTYPE html> 
<html> 
<!--file: ot2a.php
    desc: Laskee painoindeksin ja ilmoittaa sitä vastaavan sanallisen tiedon
		  käyttäjän antamien painon ja pituuden perusteella
    date: 3.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot2a </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot2.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Painoindeksi</h2>
		<!--syöttökentät-->
		<label>Pituus:</label>
		<input type="text" name="pituus" class="syote">cm
		<label>Paino:</label>
		<input type="text" name="paino" class="syote">kg

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Laske painoindeksi" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
				//painoindeksiluokkien raja-arvovakiot
				define ("ALIPAINO",18.4);
				define ("LIEVA_YLIPAINO",25.0);
				define ("MERKITTAVA_YLIPAINO",30.0);
				
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					$pituus=$_REQUEST['pituus'];						//luetaan syöte muuttujaan
					$paino=$_REQUEST['paino'];							//luetaan syöte muuttujaan
					$indeksi=$paino/(($pituus*0.01)*($pituus*0.01));	//lasketaan painoindeksi pyöristettynä kymmenesosiin	
					
					echo "Painoindeksisi on: ".round($indeksi,1)."<br>"; //tulostetaan painoindeksi
				
					//etsitään ja tulostetaan painoindeksiä vastaava sanallinen muoto
					//vertaamalla indeksin arvoa luokkakohtaisiin vakioihin
					if ($indeksi<=ALIPAINO){
						echo "Alhainen paino";
						}
					else if ($indeksi>ALIPAINO&&$indeksi<LIEVA_YLIPAINO){
						echo "Normaali paino";
					}
					else if ($indeksi>=LIEVA_YLIPAINO&&$indeksi<MERKITTAVA_YLIPAINO){
						echo "Lievä ylipaino";
					}
					else if ($indeksi>=MERKITTAVA_YLIPAINO){
						echo "Merkittävä ylipaino";
					}
				}
			?>
		</div>			
	</form>
 </body>

</html>