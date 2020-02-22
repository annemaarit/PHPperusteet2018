<!DOCTYPE html> 
<html> 
<!--file: ot3a.php
    desc: Viestin tallennus txt-tiedostoon ja
		  lähetys sähköpostiviestinä SMTP-palvelimen kautta
    date: 4.4.2018
    auth: Maarit Parkkonen-->
	
 <head>
	<title> ot3a </title> 
	<meta charset="utf-8"/> 
	<!--tyylitiedoston sijainti-->
	<link rel="stylesheet" type="text/css" href="ot3a.css">
 </head> 

 <body> 
 	<?php
		define ("MINIMIPITUUS",10);		//syötteiden merkkien vähimmäismäärä
		
		//muuttujien alustus
		$nimi=$viesti="";
		$nimiTyhja=$viestiTyhja=$nimiVirhe=$viestiVirhe=false;
		
		//jos painiketta painettu
		if (isset($_REQUEST['painike'])){					
			$nimi=$_REQUEST['nimi'];		//luetaan syöte muuttujaan
			$viesti=$_REQUEST['viesti'];	//luetaan syöte muuttujaan
			
			//onko syötteet tyhjiä?
			$nimiTyhja=empty($nimi);
			$viestiTyhja=empty($viesti);
			
			//jos syötteet eivät ole tyhjiä
			if ((!($nimiTyhja))&&(!($viestiTyhja))){
				
				//estetään ilkivalta
				$nimi=testaaSyote($nimi);
				$viesti=testaaSyote($viesti);
				
				//onko syötteet riittävän pitkiä?
				$nimiVirhe=testaaPituus($nimi);
				$viestiVirhe=testaaPituus($viesti);
				
				//jos syötteet ok
				if (($nimiVirhe!=true)&&($viestiVirhe!=true)){
						
						//tallennetaan tiedot tiedostoon
						$tiedosto = fopen("palautteet.txt", "a+") or die("Tiedoston avaus epäonnistui"); //avataan ja jatketaan tallennusta tiedoston lopusta
						$viesti=$nimi.": ".$viesti."\r\n";		//tallennettava rivi, loppuun lisätään rivinvaihto
						fwrite($tiedosto, $viesti);				//kirjoitetaan rivi tiedostoon
						fclose($tiedosto);						//tiedoston sulku
						
						//sähköpostin lähetys: TÄMÄ TOIMII!!!! :)
						//$viesti = wordwrap($viesti,70);							//viestin rivitys
						//ini_set("smtp_port",587);									//smtp-portin asetus php.ini tiedostoon
						//ini_set("SMTP","smtp.kolumbus.fi");						//käytössä olevan smtp-palvelimen domain
						//ini_set("sendmail_from","maarit.parkkonen@outlook.com");	//keneltä viesti lähetetään			
						//mail("maarit.parkkonen@outlook.com","Palaute",$viesti);	//smtp-viestin lähetys
						
						$nimi=$viesti="";
				}
			}
		}
		
		//tarkistaa ja muuttaa epäilyttävät merkit annetusta tekstistä
		function testaaSyote($data) {
			$data = trim($data," \t\n");		   //ylimääräiset tyhjät ja tab sekä rivinvaihdot pois alusta ja lopusta
			$data = stripslashes($data);		   //"takakenot"
			$data = htmlspecialchars($data);	   //html:n erikoismerkit
			$data = str_replace("\r\n"," ",$data); //rivinvaihdot pois 
			return $data;						   //palauttaa turvallisen tekstin
		}
		
		//tarkistaa annetun tekstin merkkien määrän ja vertaa annettuun vakioon
		function testaaPituus($data){
			if (strlen($data)<MINIMIPITUUS){
				return true;					//liian lyhyt
			}
			else{
				return false;					//ok
			}
		}
	?>
 
	<!--lomakkeen tietojen lähetystapa ja käsittelypaikka (tiedosto käsittelee itse)-->
 	<form method="post" action="<?php echo ($_SERVER['PHP_SELF']);?>"> 	
		<h2>Kirjoita palaute</h2>
		
		<!--syöttökentät-->
		<label>Nimi:</label>
		<input type="text" name="nimi" class="syote" value="<?php echo $nimi;?>"> 
		<label for="viesti">Viesti:</label>
		<textarea name="viesti" rows="6" cols="49"><?php echo $viesti;?></textarea> 

		<!--lomakkeen tietojen lähetyspainike-->
		<input type="submit" name="painike" value="Lähetä" class="nappi">
		
		<!--tulostusalue-->
		<div id="tuloste">		
			<?php
			//jos painiketta painettu
			if (isset($_REQUEST['painike'])){
				//jos syötteissä virheitä
				if ($nimiTyhja||$viestiTyhja||$nimiVirhe||$viestiVirhe){
					//virhelistaus
					$ilmoitus="<div id='virheet'>Tiedoissa oli virheitä:<ul>";
					if ($nimiTyhja)	 {$ilmoitus=$ilmoitus."<li>Nimi puuttui"."</li>";};
					if ($viestiTyhja){$ilmoitus=$ilmoitus."<li>Viesti puuttui"."</li>";};
					if ($nimiVirhe)  {$ilmoitus=$ilmoitus."<li>Nimi on liian lyhyt (alle ".MINIMIPITUUS." merkkiä).</li>";};
					if ($viestiVirhe){$ilmoitus=$ilmoitus."<li>Viesti on liian lyhyt (alle ".MINIMIPITUUS." merkkiä).</li>";};
					$ilmoitus=$ilmoitus."</ul>Korjaa tiedot.</div>";
					echo $ilmoitus;
				}
				//syötteet ok, tallennus ja viestin lähetys onnistunut
				else{
					echo "<p>Viestisi on tallennettu</p>";
				}
			}
			?>
		</div>			
	</form>
 </body>

</html>