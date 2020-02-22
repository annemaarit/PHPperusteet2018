<!-- file: rekisteroidy.php (oth6)
	 desc: uuden käyttäjän rekisteröityminen
	 date: 27.8.2018
	 auth: Maarit Parkkonen -->

<?php include("yla.php"); ?>
	<h4>Luo uusi verkkotunnus</h4>
    <form action="rekisteroi.php" method="post">
      <label>Tunnus:</label>
      <input type="text" name="tunnus"> <br>
      <label>Salasana:</label>
      <input type="password" name="salasana"> <br>
      <label>Salasana uudelleen:</label>
      <input type="password" name="salasana2" > <br>
      <input type="submit" value="Rekisteröidy" id="ok">
    </form>
	
<?php include("ala.php"); ?>
