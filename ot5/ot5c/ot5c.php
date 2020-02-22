<?php
/* 
   file: ot5c.php
   desc: hakee tietyn joukkueen tiedot tietokannasta ja
		 palauttaa tiedot json -muodossa
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

require '../ot5Yhteys.php';

//syötekentän tieto javascript -tiedoston kautta
$haettava=$_GET['joukkue']; //js:ltä tuleva tieto

//alustetaan haku
$kysely = $yhteys->prepare("SELECT * FROM sarjataulukko WHERE joukkue=:joukkue");

//PHP:n muuttuja sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
$kysely->bindParam(":joukkue",$haettava); 

//ajetaan SQL-lause
$kysely->execute();

//Lähetetään tiedot JSON-muodossa
header("Content-type: application/json");
print json_encode($kysely->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);

?>
