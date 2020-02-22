<!-- file: ulos.php (oth6)
	 desc: sivustolta ulos kirjautuminen
	 date: 27.8.2018
	 auth: Maarit Parkkonen -->

<?php
session_start();
unset($_SESSION["kayttaja"]);	//käyttäjän istunnon lopetus

include("yla.php"); ?>

	<p>Olet kirjautunut ulos sivulta. Kiitos käynnistä!
	<a href="kirjaudu.php" >Kirjaudu uudestaan</a></p>

<?php include("ala.php"); ?>