<!DOCTYPE html>
<!--file: ot5a.php
    desc: Muodostaa veikkausliiga -tietokannan ja tulostaa sen tiedot
    date: 23.8.2018
    auth: Maarit Parkkonen-->
<html>
<head>
<meta charset="utf-8"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="../ot5.css">
</head>
<body>
<h1>Veikkausliiga</h1>
	<table>
		<tr>
			<th>Joukkue</th>
			<th>Ottelut</th>
			<th>Voitot</th>
			<th>Tasapelit</th>
			<th>Häviöt</th>
			<th>Pisteet</th>
		</tr>
		
	<?php
	//avataan yhteys tietokantaan (ja muodostetaan se samalla)
	require 'ot5aYhteys.php';
	
	//muodostetaan SQL-lause
	$sql="SELECT * FROM sarjataulukko ORDER BY voitot DESC,tasapelit DESC";
	//alustetaan kysely
	$kysely = $yhteys->prepare($sql);
	//ajetaan SQL-lause
	$kysely->execute();
	
	//tulostetaan tietokantakyselyn palauttama tulos
	$vari=true;
	foreach ($kysely as $rivi) { 					//käydään läpi rivi kerrallaan
	  $vari=!$vari;									//joka toinen rivi eriväriseksi
	  if ($vari){ ?>										
		<tr class="vari">
	  <?php } else { ?>	
		<tr> <?php } 
			$voitot=$rivi["voitot"];				//taulukon otsikot
			$tasat=$rivi["tasapelit"];				
			$tappiot=$rivi["tappiot"];?>
			<td><?php echo $rivi["joukkue"]; ?></td>		<!--joukkueen nimi-->
			<td><?php echo $voitot+$tasat+$tappiot;?></td>	<!--otteluiden määrä-->
			<td><?php echo $voitot; ?></td>					<!--voitot kpl-->
			<td><?php echo $tasat;?></td>					<!--tasapelit kpl-->
			<td><?php echo $tappiot;?></td>					<!--tappiot kpl-->
			<td><?php echo (3*$voitot)+$tasat;?></td>		<!--pisteet-->
		</tr>		
	<?php } ?> 

	</table>	
</body>
</html>

