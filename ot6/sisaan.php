<?php
/* 
   file: sisaan.php
   desc: lomakkeella annettujen tietojen vastaavuuden tarkistus tietokannasta
			- jos tiedot ok, avataan pääsivu
			- jos tiedoissa virheitä, avataan ilmoitus
   date: 27.8.2018
   auth: Maarit Parkkonen
*/
session_start();

require 'yhteys.php';

//luetaan lomakkeen tiedot
$tunnus = $_POST["tunnus"];
$salasana = $_POST["salasana"];

//tutkitaan löytyykö tunnus tietokannasta, alustetaan kysely
$kysely=$yhteys->prepare("SELECT * FROM kayttajat WHERE tunnus=:tunnus");
	
//PHP:n muuttuja sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
$kysely->bindParam(":tunnus",$tunnus); 

//ajetaan SQL-lause
$kysely->execute();

//kyselyn eka rivi
$rivi = $kysely->fetch();

//jos kyselyn tulos ei ole tyhjä eli tunnus löytyi
if ($rivi!=false){
	//jos lomakkeen salasana vastaa taulukon salasanaa (huomioi myös salauksen)
    if  (password_verify($salasana, $rivi['salasana'])){
        $_SESSION["kayttaja"] = $tunnus;		//käyttäjälle luodaan oma istunto
        header("Location: paasivu.php");		//ohjataan pääsivulle
        die();									
    }
	//jos salasana on väärä
	else{
		header("Location: vaaraSalasana.php");	//ohjataan ilmoitussivulle
		die();
	}
}
//jos käyttäjätunnusta ei löydy
else{
	header("Location: vaaraTunnus.php");		//ohjataan ilmoitussivulle
	die();
}
?>
