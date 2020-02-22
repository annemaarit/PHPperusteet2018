<?php
/* 
   file: ot5Yhteys.php
   desc: muodostaa tietokantayhteyden
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

//alustus
$dsn = "mysql:host=localhost;dbname=veikkausliiga";			//tietokantamoottori, tietokannan nimi
$tunnus = "root";
$salasana = "";

//Tietokantayhteys
try {														//poikeuksien hallinta
	$yhteys = new PDO($dsn, $tunnus, $salasana);			//yhteys -olion luonti PDO -luokasta
	$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //yhteys -olion virheattribuuttien asettaminen
	$yhteys->exec("SET CHARACTER SET utf8;");				//merkistön varmistus
} catch (PDOExcetion $e) { 									//tietokantavirheen ilmoitus poikkeus -olion avulla
	die("Virhe: ".$e->getMessage());						//virhetilanteessa pyydetään viesti poikkeus -oliolta
}

?>