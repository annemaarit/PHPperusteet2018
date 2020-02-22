<!DOCTYPE html> 
<html> 
<!--file: ot4d.php
    desc: Laskee asunnon neliöhinnan käyttäjän
		  antamien tietojen perusteella
			-vain tyhjien syötteiden tarkastus
			-ei syötteiden laadun tarkastusta
    date: 27.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot4d </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot4.css">
	<!--php-luokkatiedoston linkitys ja sijainti-->
	<?php include("class_lib.php");?>
 </head> 

 <body> 
 	<?php
		//muuttujien alustus
		$hinta=$ala=$tulos="";
		$tyhja=true;
		
		//jos painiketta painettu
		if (isset($_REQUEST['painike'])){					
			$hinta=$_REQUEST['hinta'];					//luetaan syöte muuttujaan
			$ala=$_REQUEST['pa'];						//luetaan syöte muuttujaan
			$tyhja=((empty($hinta))||(empty($ala)));	//puuttuuko syötteitä
			if (!($tyhja)){	 							//jos syötteitä ei puutu
				$talo=new asunto();						//uusi asunto -luokan ilmentymä: talo -olio
				$talo->asetaHinta($hinta);				//annetaan talo -olion hinta -ominaisuudelle arvo
				$talo->asetaPinta_ala($ala);			//annetaan talo -olion pinta-ala -ominaisuudelle arvo
						
				//muodostetaan tulosilmoitus talo -olion laskentametodia käyttäen
				$tulos="Neliöhinta on: ".round(($talo->laskeNelioHinta()),2)." €";						
			}
		}
	?>
 
 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>"> 	
		<h2>Asunnon hinta</h2> 
		
		<!--syöttökentät-->
		<label>Anna hinta:</label>
		<input type="text" name="hinta" class="syote"  value="<?php echo $hinta;?>">
		
		<label>Anna pinta-ala:</label>
		<input type="text" name="pa" class="syote"  value="<?php echo $ala;?>"> 

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Laske neliöhinta" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">
			<?php
				//jos painiketta painettu
				if (isset($_REQUEST['painike'])){					
					if (!($tyhja)){	 				//jos syötteet annettu	
						echo $tulos;				//näytetään tulos				
					}
					else{							//syötteitä puuttui
						echo "Tietoja puuttuu";		//näytetään virheilmoitus
					}
				}

			?>
		</div>			
	</form>
 </body>

</html>