<!-- file: kirjaudu.php (oth6)
	 desc: kirjautumislomake ja uudelle käyttäjälle ohjaus rekisteröitymiseen
	 date: 27.8.2018
	 auth: Maarit Parkkonen -->

<?php include("yla.php"); ?>
	<h4>Kirjoita verkkotunnuksesi, kiitos!</h4>
    <form action="sisaan.php" method="post">
      <label>Tunnus:</label>
      <input type="text" name="tunnus"> <br>
      <label>Salasana:</label>
      <input type="password" name="salasana"> <br>
      <input type="submit" value="Kirjaudu" id="ok">
    </form>
	<a href="rekisteroidy.php" id="uusi">Olen uusi käyttäjä</a>
	
<?php include("ala.php"); ?>
