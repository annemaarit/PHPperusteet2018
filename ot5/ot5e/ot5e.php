<?php
/* 
   file: ot5e.php
   desc: poistaa tietyn joukkueen tietokannasta ja
		 palauttaa kannan tiedot json -muodossa
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

require '../ot5Yhteys.php';

//alustetaan poisto
$poisto = $yhteys->prepare("DELETE FROM sarjataulukko WHERE joukkue=:joukkue");

//syötekentän tieto javascript -tiedoston kautta
$joukkue=$_GET['joukkue']; 

//PHP:n muuttuja sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
$poisto->bindParam(":joukkue",$joukkue); 

//ajetaan SQL-lause
$poisto->execute();

//alustetaan kaikkien joukkueiden ja niiden tietojen haku
//joukkueet järjestetään ensisijaisesti voittojen ja toissijaisesti tasapelien mukaan laskevaan järjestykseen
$kysely = $yhteys->prepare("SELECT * FROM sarjataulukko ORDER BY voitot DESC,tasapelit DESC");
$kysely->execute();

//Lähetetään tiedot JSON-muodossa
header("Content-type: application/json");
print json_encode($kysely->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);

?>
