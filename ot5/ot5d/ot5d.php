<?php
/* 
   file: ot5d.php
   desc: lisää yhden uuden joukkueen tietoineen tietokantaan ja
		 palauttaa kannan tiedot json -muodossa
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

require '../ot5Yhteys.php';

//syötekenttien tiedot javascript -tiedoston kautta
$joukkue=$_GET['joukkue']; 
$voitot=$_GET['voitot']; 
$tasapelit=$_GET['tasapelit']; 
$tappiot=$_GET['tappiot']; 

//Alustetaan kantaan lisäys. PHP:n muuttujat sidotaan SQL-parametreihin bindParam-metodilla
$lisays=$yhteys->prepare("INSERT INTO sarjataulukko (joukkue,voitot,tasapelit,tappiot) VALUES (:joukkue, :voitot, :tasapelit,:tappiot)");

//PHP:n muuttujat sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
$lisays->bindParam(":joukkue",$joukkue); //estetään sql-injektiota
$lisays->bindParam(":voitot",$voitot);
$lisays->bindParam(":tasapelit",$tasapelit);
$lisays->bindParam(":tappiot",$tappiot);

//ajetaan SQL-lause
$lisays->execute();

//alustetaan kaikkien joukkueiden ja niiden tietojen haku
//joukkueet järjestetään ensisijaisesti voittojen ja toissijaisesti tasapelien mukaan laskevaan järjestykseen
$kysely = $yhteys->prepare("SELECT * FROM sarjataulukko ORDER BY voitot DESC,tasapelit DESC");
$kysely->execute();

//Lähetetään tiedot JSON-muodossa
header("Content-type: application/json");
print json_encode($kysely->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
?>
