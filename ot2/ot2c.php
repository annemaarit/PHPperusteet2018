<!DOCTYPE html> 
<html> 
<!--file: ot2c.php
    desc: Käyttäjä antaa nimen ja kappalemäärän,
		  tulostetaan nimi näytölle kappalemäärän verran
    date: 3.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot2c </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot2.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
	
		<!--syöttökentät-->
		<label>Nimi:</label>
		<input type="text" name="nimi" class="syote">
		<label>Montako kertaa tulostetaan:</label>
		<input type="text" name="kpl" class="syote">

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Tulosta" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php	
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					$nimi=$_REQUEST['nimi'];		//luetaan syöte muuttujaan
					$kpl=$_REQUEST['kpl'];			//luetaan syöte muuttujaan
					for ($i=0;$i<$kpl;$i++){		//tulostussilmukka, toistetaan kpl verran
						echo $nimi."<br>";			//tulostetaan nimi
					}				
				}
			?>
		</div>			
	</form>
 </body>

</html>