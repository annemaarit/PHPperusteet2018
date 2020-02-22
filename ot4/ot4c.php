<!DOCTYPE html> 
<html> 
<!--file: ot4c.php
    desc: Näyttää tämän päivän ja huomisen päiväyksen ja kellonajan
    date: 6.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot4c </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot4.css">
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Päiväys</h2>

		<!--tietojen näyttöpainike-->
		<input type="submit" name="painike" value="Näytä päiväys" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
				define ("AIKUINEN",18);
				date_default_timezone_set("Europe/Helsinki");					//aikavyöhykkeen asetus (ei huomioi muuten kesäaikaa)
				
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					echo "Tämä päivä on: ".date("j.n.Y")."<br>";				//j=paiva ilman etunollia, n=kuukausi ilman etunollia, Y=vuosi neljällä numerolla
					echo "Kello on: ".date("G:i")."<br><br>";					//G=tunti 24h:n mukaisesti ilman etunollia, i=sekunnit
					$huominen=strtotime("+24 hours");							//huomisen aikaleima, HUOM! "tomorrow" ei käy, ei anna kellon aikaa
					echo "Huominen päivä on: ".date("j.n.Y",$huominen)."<br>";
					echo "Kello huomenna tähän aikaan on: ".date("G:i",$huominen);
				}
			?>
		</div>			
	</form>
 </body>

</html>