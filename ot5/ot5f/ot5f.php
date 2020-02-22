<?php
/* 
   file: ot5f.php
   desc: päivittää tietyn joukkueen tiedot tietokannassa ja
		 palauttaa kaikkien joukkueiden tiedot json -muodossa
   date: 23.8.2018
   auth: Maarit Parkkonen
*/

require '../ot5Yhteys.php';

//syötekenttien tiedot javascript -tiedoston kautta
$id=$_GET['id']; 
$joukkue=$_GET['joukkue']; 
$voitot=$_GET['voitot']; 
$tasapelit=$_GET['tasapelit']; 
$tappiot=$_GET['tappiot']; 

//alustetaan kantaan päivitys
$paivitys=$yhteys->prepare("UPDATE sarjataulukko SET joukkue=:joukkue, voitot=:voitot, tasapelit=:tasapelit, tappiot=:tappiot WHERE id=:id");

//PHP:n muuttujat sidotaan SQL-parametreihin bindParam-metodilla, jolla estetään sql-injektiota
$paivitys->bindParam(":id",$id); 
$paivitys->bindParam(":joukkue",$joukkue);
$paivitys->bindParam(":voitot",$voitot);
$paivitys->bindParam(":tasapelit",$tasapelit);
$paivitys->bindParam(":tappiot",$tappiot);

//ajetaan SQL-lause
$paivitys->execute();

//alustetaan kaikkien joukkueiden ja niiden tietojen haku
//joukkueet järjestetään ensisijaisesti voittojen ja toissijaisesti tasapelien mukaan laskevaan järjestykseen
$kysely = $yhteys->prepare("SELECT * FROM sarjataulukko ORDER BY voitot DESC,tasapelit DESC");

//ajetaan SQL-lause
$kysely->execute();

//Lähetetään kyselyn 2 tiedot JSON-muodossa
header("Content-type: application/json");
print json_encode($kysely->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
?>
