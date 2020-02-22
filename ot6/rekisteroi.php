<?php
/* 
   file: rekisteroi.php
   desc: lisää uuden käyttäjän tiedot tietokantaan
				- tarkistaa onko tunnus jo käytössä
				- tarkistaa että salasanan varmistus on ok
				- salaa salasanan ennen kantaan tallennusta
   date: 27.8.2018
   auth: Maarit Parkkonen
*/

require 'yhteys.php';

//luetaan lomakkeen tiedot
$tunnus = $_POST["tunnus"];
$salasana = $_POST["salasana"];
$salasana2 = $_POST["salasana2"];

//tutkitaan onko tunnus jo käytössä eli löytyykö tietokannasta, alustetaan kysely
$kysely=$yhteys->prepare("SELECT * FROM kayttajat WHERE tunnus=:tunnus");
	
//PHP:n muuttuja sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
$kysely->bindParam(":tunnus",$tunnus); 

//ajetaan SQL-lause
$kysely->execute();

//jos kyselyn tulos on tyhjä eli tunnusta ei ole kannassa
if ($kysely->fetch()==false){
	//tarkistetaan salasanojen varmistuksen vastaavuus
	if ($salasana!=$salasana2){		//salasanat eivät vastaa toisiaan			
		header("Location: erilaisetSalasanat.php");
		die();
	}
	else{	//kaikki ok
		//salataan salasana
		$salasana = password_hash($salasana, PASSWORD_DEFAULT);

		//alustetaan kantaan lisäys
		$lisays=$yhteys->prepare("INSERT INTO kayttajat (tunnus,salasana) VALUES (:tunnus, :salasana)");

		//PHP:n muuttujat sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
		$lisays->bindParam(":tunnus",$tunnus); 
		$lisays->bindParam(":salasana",$salasana);

		//ajetaan SQL-lause
		$lisays->execute();
	
		//ohjataan kirjautumis -sivulle
		header("Location: kirjaudu.php");
	}
}
else{
	//ohjataan varrattu tunnus -sivulle
	header("Location: varattuTunnus.php");
	die();
}
?>
