<!--file: class_lib.php
    desc: Asunnon neliöhinta -ohjelman luokkatiedosto
    date: 27.4.2018
    auth: Maarit Parkkonen-->
<?php
//luokka
class asunto{
	//ominaisuudet------------------------------------
	var $hinta;
	var $pinta_ala;
	
	//metodit-----------------------------------------
	
	//sijoittaa annetun parametrin kutsuvan olion hinta -ominaisuuteen
	function asetaHinta($uusi_hinta){
		$this->hinta=$uusi_hinta;
	}
	
	//sijoittaa annetun parametrin kutsuvan olion pinta-ala -ominaisuuteen
	function asetaPinta_ala($uusi_ala){
		$this->pinta_ala=$uusi_ala;
	}
	
	//palauttaa kutsuvan olion ominaisuuksista lasketun neliöhinnan 
	function laskeNelioHinta(){
		return $this->hinta/$this->pinta_ala;
	}
}
?>