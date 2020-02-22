 <?php
/* 
   file: ot5LuoTk.php
   desc: muodostaa tietokannan
   date: 27.8.2018
   auth: Maarit Parkkonen
*/

$dsn = "localhost";														//palvelin
$tunnus = "root";														//käyttäjä
$salasana = "";

try {																	//poikeuksien hallinta
    $yhteys = new PDO("mysql:host=$dsn", $tunnus, $salasana);			//yhteys -olion luonti PDO -luokasta
    $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//yhteys -olion virheattribuuttien asettaminen
    $sql = "CREATE DATABASE veikkausliiga";								//tietokannan luova lause
    $yhteys->exec($sql);												//ajetaan SQL -lause
    echo "Tietokanta veikkausliiga on luotu<br>";
    }
catch(PDOException $e)													//tietokantavirheen ilmoitus poikkeus -olion avulla
    {
    echo $sql . "<br>" . $e->getMessage();								//virhetilanteessa pyydetään viesti poikkeus -oliolta
    }
$yhteys = null;
?> 