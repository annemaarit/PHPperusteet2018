<?php
/* 
   file: ot5b.php
   desc: hakee kaikkien joukkueiden tiedot tietokannasta ja
		 palauttaa tiedot json -muodossa
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

require '../ot5Yhteys.php';

//alustetaan kaikkien tietojen haku
$kysely = $yhteys->prepare("SELECT * FROM sarjataulukko ORDER BY voitot DESC,tasapelit DESC");

//ajetaan SQL-lause
$kysely->execute();

//Lähetetään tiedot JSON-muodossa
header("Content-type: application/json");
print json_encode($kysely->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
?>