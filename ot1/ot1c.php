
<?php
	// file: ot1c.php
	// desc: Tulostaa tekstin URL:n merkkijonon
	//		 kenttä-arvo -parien mukaisesti
	// date: 12.2.2018
	// auth: Maarit Parkkonen

	$merkki=$_GET['merkki'];	//merkki -kentän arvo muuttujaan
	$malli=$_GET['malli'];		//malli -kentän arvo muuttujaan
	echo "Autosi merkki on: ".$merkki." ja vuosimalli: ".$malli; //tulostetaan teksti sivulle
?>