<!DOCTYPE html> 
<html> 
<!--file: ot2b.php
    desc: Laskee vakioiden avulla ostettujen ilmapallojen kokonaishinnan ja tulostaa kuitin näytölle
    date: 3.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot2b </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot2.css"> 
 </head> 

 <body> 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Ilmapallokauppa</h2>
		
		<!--syöttökentät-->
		<label>Ilmapallojen lukumäärä:</label>
		<input type="text" name="kpl" class="syote">kpl

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Tulosta kuitti" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
				//vakiot
				define ("ALENNUS",10);				//10% alennus
				define ("ALENNUS_KPL",16);			//kappalemäärä, joka oikeuttaa alennukseen
				define ("HINTA_KPL",1.50);			//alentamaton kappalehinta
				
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					$kpl=$_REQUEST['kpl'];			//luetaan syöte muuttujaan
					if ($kpl<ALENNUS_KPL){			//jos ei alennukseen oikeutta
						$alennus=1;					//ei alennusta (kokonaishinta 100%)
					}
					else {							//jos alennukseen oikeus
						$alennus=1-(ALENNUS/100);	//kokonaishinta 100%-alennus%
					}
					$summa=$kpl*HINTA_KPL;			//kokonaissumma
					$aleSumma=$summa*$alennus;		//maksettava summa
					
					//kuitin tulostus
					echo "Palloja: ".$kpl." kpl<br>".
					     "Kappalehinta: ".HINTA_KPL." €<br>".
						 "Loppusumma: ".$summa." €<br>".
						 "Alennus: ".($summa-$aleSumma)." €<br>".
						 "Maksettava: ".$aleSumma." €";
				}
			?>
		</div>			
	</form>
 </body>

</html>