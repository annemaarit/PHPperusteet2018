<?php
/* 
   file: ot5aYhteys.php
   desc: muodostaa uudelleen tietokannan sekä tietokantayhteyden
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

//alustus
$dsn = "mysql:host=localhost;dbname=veikkausliiga";					  //tietokantamoottori, tietokannan nimi
$tunnus = "root";
$salasana = "";

//Tietokannan luonti ja tietokantayhteys
try {																  //poikeuksien hallinta
	$yhteys = new PDO($dsn, $tunnus, $salasana);					  //yhteys -olion luonti PDO -luokasta
	$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //yhteys -olion virheattribuuttien asettaminen
	$sql = file_get_contents("liiga.sql"); 							  //tietokannan luomisen tietojen luku tekstitiedostosta
	$yhteys->exec($sql);											  //ajetaan tiedoston SQL -lauseet
} catch (PDOException $e) {											  //tietokantavirheen ilmoitus poikkeus -olion avulla
	die("Virhe: ".$e->getMessage());								  //virhetilanteessa pyydetään viesti poikkeus -oliolta
}

?>