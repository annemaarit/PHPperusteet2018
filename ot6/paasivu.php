<!--file:  paasivu.php
    desc:  Tähtitieteilijöiden pääsivu
    date:  26.3.2018
    auth:  Maarit Parkkonen
	frame: w3.css
    osa kuvista: pixabay.com -->

<?php
session_start();
if (!isset($_SESSION["kayttaja"])) {
    header("Location: kirjaudu.php");
    die();
}
?>

<!DOCTYPE html>
<html>
<title>Tähtitieteilijät</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	body {font-family: "Lato", sans-serif}
	.avaruusDiat {display: none;}
	@media (max-width: 480px) {
		.otsake {display: none;}
		h2 {font-size:1.5em;}
	}
</style>
<body>

<!-- navit -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="menuAvaaSulje()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Tähtitieteilijät</a>
	<a href="#tiede" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Tähtitiede</a>
    <a href="#galaksit" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Galaksit</a>
    <a href="#tahdet" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Tähtien synty</a>
    <a href="#aurinkokunta" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Aurinkokuntamme</a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="Planeetat">Planeetat <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Merkurius</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Venus</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Maa</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Mars</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Jupiter</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Saturnus</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Uranus</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Neptunus</a>
      </div>
    </div>
	
    <a href="javascript:void(0)" class="w3-padding-large w3-hover-blue w3-hide-small w3-right"><i class="fa fa-search"></i></a>
	<a href="ulos.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right">Kirjaudu ulos</a>
  </div>
</div>

<!-- menupainike pienille näytöille -->
<div id="menuPainike" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#tiede" class="w3-bar-item w3-button w3-padding-large">Tähtitiede</a>
  <a href="#galaksit" class="w3-bar-item w3-button w3-padding-large">Galaksit</a>
  <a href="#tahdet" class="w3-bar-item w3-button w3-padding-large">Tähtien synty</a>
  <a href="#aurinkokunta" class="w3-bar-item w3-button w3-padding-large">Aurinkokuntamme</a>
  <div class="w3-dropdown-click">
    <div class="w3-bar-item w3-button" onclick="avaaValikko()">
		<span>Planeetat</span> 
		<i class="fa fa-caret-down"></i>
    </div>
    <div id="valikko" class="w3-dropdown-content w3-white w3-card-4">
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Merkurius</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Venus</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Maa</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Mars</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Jupiter</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Saturnus</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Uranus</a>
        <a onclick="document.getElementById('rakenteilla').style.display='block'" class="w3-bar-item w3-button">Neptunus</a>
    </div>
  </div>
</div>

<!-- sivu rakenteilla -modaali -->
 <div id="rakenteilla" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-blue-grey w3-center w3-padding-30"> 
        <span onclick="document.getElementById('rakenteilla').style.display='none'" 
       class="w3-button w3-blue-grey w3-xlarge w3-display-topright">×</span>
        <h2>Pahoittelemme</h2>
      </header>
      <div class="w3-container">
        <p class="w3-white w3-center w3-padding-32">
		Sivun rakentaminen on vielä kesken.
		</p>
        <button class="w3-button w3-blue w3-section w3-round-small" onclick="document.getElementById('rakenteilla').style.display='none'">Sulje <i class="fa fa-remove"></i></button>
      </div>
    </div>
 </div>

<!-- sisältö -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

  <!-- isot avaruusdiat -->
  <div class="avaruusDiat w3-display-container w3-center">
    <img src="images/tahtisumu.jpg" style="width:100%">
    <div class="w3-display-topmiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h2 class="w3-wide">Tähtisumu</h2>
      <p><b>Uusien tähtien kehto!</b></p>   
    </div>
  </div>
  <div class="avaruusDiat w3-display-container w3-center">
    <img src="images/linnunrata.jpg" style="width:100%">
    <div class="w3-display-topmiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h2 class="w3-wide">Linnunrata</h2>
      <p><b>Kotigalaksimme - yli 100 miljardia tähteä!</b></p>    
    </div>
  </div>
  <div class="avaruusDiat w3-display-container w3-center">
    <img src="images/galaksi.jpg" style="width:100%">
    <div class="w3-display-topmiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
      <h2 class="w3-wide">Galaksi</h2>
      <p><b>Galaksit täyttävät koko tunnetun maailmankaikkeuden!</b></p>    
    </div>
  </div>
  
  <!-- Tähtitiede osa -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="tiede">
    <h2 class="w3-wide">TÄHTITIEDE</h2>
    <p class="w3-opacity"><i>Kaikkeuden tutkimista</i></p>
    <p class="w3-justify w3-margin-bottom">Tähtitieteellisen tutkimuksen piiriin kuuluu aivan kaikki ilmakehän ulkopuolella oleva:
	Kuu, oma aurinkokuntamme, sen lähitähdet, oma galaksimme Linnunrata, sen naapurigalaksit ja
	koko universumin galaksipaljous. </p>
	
	<p class="w3-opacity"><i>Historialliset vaiheet</i></p>
      <div class="w3-row-padding w3-padding-16" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <img src="images/kaukoputki.jpg" alt="kaukoputki" style="width:100%">
          <div class="w3-container w3-black">
            <p class="w3-opacity w3-margin-top">Kaukoputki</p>
            <p>Muutti maailmankuvan kokonaan ..</p>
            <button class="w3-button w3-teal w3-margin-bottom w3-round-small" onclick="document.getElementById('kaukoputki').style.display='block'">Lue lisää</button>
          </div>
        </div>	  
        <div class="w3-third w3-margin-bottom">
          <img src="images/kamera.jpg" alt="kamera" style="width:100%">
          <div class="w3-container w3-black">
            <p class="w3-opacity w3-margin-top">Valokuvaus</p>
            <p>Tähtitieteen toinen suuri mullistaja..</p>
            <button class="w3-button w3-teal w3-margin-bottom w3-round-small" onclick="document.getElementById('valokuvaus').style.display='block'">Lue lisää</button>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <img src="images/radioantenni.jpg" alt="radiosäteily" style="width:100%">
          <div class="w3-container w3-black">
            <p class="w3-opacity w3-margin-top">Radiosäteily</p>
            <p>Avasi näkymättömän maailmankaikkeuden..</p>
            <button class="w3-button w3-teal w3-margin-bottom w3-round-small" onclick="document.getElementById('radiosateily').style.display='block'">Lue lisää</button>
          </div>
        </div>
      </div>	 
	  
    <p class="w3-opacity"><i>Harrastuksena</i></p>	
	<p class="w3-justify">Tähtitiede on kuitenkin edelleen myös sitä, että menee ulos pimeän aikaan ja katsoo omin silmin taivaalle. 
	Kuun vaiheet, kuun- ja auringonpimennykset, meteoriparvien aiheuttamat tähdenlennot ja useimmat planeetat näkyvät hyvin myös paljain silmin.
	Toisinaan taivaan halki saattaa kulkea komeetta upeine pyrstöineen, ja revontulia näkyy taivaalla Etelä-Suomessakin, kun Auringon magneettinen aktiivisuus on huipussaan.</p>
	
	<p class="w3-justify">Ammattitason tähtitiedettä voi edistää toisinaan myös harrastajavoimin. Jos omassa käytössä on kaukoputki, sen avulla voi tehdä sellaisia pitkäkestoisia tai nopeita havaintoja, 
     joihin ammattilaislaitteet eivät ehdi. Tällä tavalla ovat suomalaisetkin tähtiharrastajat olleet mukana esimerkiksi gammapurkausten ja supernovien ammattitutkimuksessa. </p>
  </div>
  
  <!-- kaukoputki tietomodaali -->
  <div id="kaukoputki" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-30"> 
        <span onclick="document.getElementById('kaukoputki').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide">Kaukoputki</h2>
      </header>
      <div class="w3-container">
        <p class="w3-white w3-padding">
		Aina 1600-luvulle saakka kaikki tähtitieteelliset havainnot piti tehdä paljain silmin.
		Kaukoputken keksimisen myötä saatettiin nähdä kauempana olevia ja himmeämpiä kohteita, ja maailmankuvamme mullistui.
		Maa ei ollutkaan maailmankaikkeuden keskipiste, vaan planeettamme kiersikin Aurinkoa, 
		joka sekin oli vain yksi monista tähdistä Linnunradan tähtimuodostelmassa
		</p>
        <button class="w3-button w3-blue w3-section w3-round-small" onclick="document.getElementById('kaukoputki').style.display='none'">Sulje <i class="fa fa-remove"></i></button>
      </div>
    </div>
  </div>
   
  <!-- Valokuvaus tietomodaali -->
  <div id="valokuvaus" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-30"> 
        <span onclick="document.getElementById('valokuvaus').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide">Valokuvaus</h2>
      </header>
      <div class="w3-container">
        <p class="w3-white w3-padding">
		Valokuvauksen keksiminen 1800-luvun alkupuolella mullisti tähtitieteen uudelleen.
		Entistä himmeämpiä kohteita saatiin havaittua, kun niistä voitiin tehdä pitkiä valotuksia. 
		Lisäksi taivaan kohteet saatiin nyt ikuistettua jälkipolville ja niissä tapahtuvat muutokset voitiin huomata. 
		Näin löytyi esim. kääpiöplaneetta Pluto, pieni liikkuva piste tähtimeren seassa. 
		</p>
        <button class="w3-button w3-blue w3-section w3-round-small" onclick="document.getElementById('valokuvaus').style.display='none'">Sulje <i class="fa fa-remove"></i></button>
      </div>
    </div>
  </div>

  <!-- Radiosäteily tietomodaali -->
  <div id="radiosateily" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal w3-center w3-padding-30"> 
        <span onclick="document.getElementById('radiosateily').style.display='none'" 
       class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
        <h2 class="w3-wide">Radiosäteily</h2>
      </header>
      <div class="w3-container">
        <p class="w3-white w3-padding">
		Radiotähtitiede keksittiin, kun sotilaskäyttöön kehitetty radioantenni havaitsi Linnunradan keskuksesta tulevaa radiosäteilyä.
		Jo aiemmin oli ymmärretty, että näkyvä valo on vain yksi kapea siivu säteilystä, jota sähkö ja magnetismi aiheuttavat. 
		</p>
        <p class="w3-white w3-padding">
		Radiotähtitiede avasi tietä uusille havaintomenetelmille kuten infrapunatähtitieteelle ja röntgentähtitieteelle.
		Nämä keksinnöt avasivat meille viimein ikkunan maailmankaikkeuteen, joka oli ollut meiltä aiemmin piilossa.
		Ymmärtämyksemme maailmankaikkeudesta on syventynyt merkittävästi näiden uusien havaintojen valossa. 		
		</p>
        <button class="w3-button w3-blue w3-section w3-round-small" onclick="document.getElementById('radiosateily').style.display='none'">Sulje <i class="fa fa-remove"></i></button>
      </div>
    </div>
  </div>

  <!-- Galaksien osa -->
  <div class="w3-black" id="galaksit">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">GALAKSIT</h2>
      <p class="w3-opacity w3-center"><i>Tyhjän avaruuden saarekkeet</i></p><br>
	<img src="images/galaksi2.jpg" class="w3-round w3-margin-bottom" alt="galaksi" style="width:100%">
    <p class="w3-justify">
	Galaksit ovat valtavia kaasusta, pölystä, pimeästä aineesta ja tähdistä muodostuneita rakenteita, joita painovoima pitää kasassa. 
	Maailmankaikkeudessa arvellaan olevan ainakin 170 miljardia galaksia. </p> 
	<p class="w3-justify">
	Galakseja on monen kokoisia ja näköisiä. Tutunnäköiset spiraaligalaksit muodostavat epäsäännöllisten galaksien kanssa
	yhteensä noin 60 prosenttia kaikista tunnetun avaruuden galakseista.  </p>
	
	<div>
		<button onclick="haitari('rakenne')" class="w3-btn w3-block w3-white w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Galaksien rakenne</strong>
		</button>
		<div id="rakenne" class="w3-container w3-hide">
			<img src="images/galaksit.jpg" class="w3-round w3-margin" alt="avaruus" style="float:left; box-shadow: 0 0 16px #777777;">
			Ensimmäiset galaksit muodostuivat alle miljardin vuoden kuluttua alkuräjähdyksestä,
			kun universumin täyttäneessä kaasussa olevat pienet tihentymät alkoivat tiivistyä entisestään painovoiman vaikutuksesta.
			<br><br>
			Useimpien galaksien ytimessä uskotaan olevan supermassiivinen musta aukko. 
			Galakseja ympäröi vaikeasti nähtävissä oleva pallomainen haloksi kutsuttu kehä, jossa on muutamia vanhoja tähtiä,
			pallomaisia tähtijoukkoja sekä runsaasti pimeää ainetta.
		</div>

		<button onclick="haitari('spiraali')" class="w3-btn w3-block w3-white w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Spiraaligalaksit</strong>
		</button>
		<div id="spiraali" class="w3-container w3-hide">
			<img src="images/galaksit3.jpg" class="w3-round w3-margin" alt="avaruus" style="float:left; box-shadow: 0 0 16px #777777;">
				Spiraaligalaksit ovat litteän kiekkomaisia. Niitten spiraalihaaroissa syntyy runsaasti nuoria tähtiä.
				Spiraalihaarojen välissä on hiukan vanhempia tähtiä, ja galaksien keskusaluetta kiertää vanhoja tähtiä.
				Monien spiraaligalaksien keskusalue on sauvamaisen muotoinen, ja näitä galakseja kutsutaan sauvaspiraaligalakseiksi.	
				<br><br>
				Myös oman galaksimme Linnunradan on huomattu olevan sauvaspiraaligalaksi. Aurinkokunta sijaitsee Linnunradan kiekon tasossa,
				ja meitä ympäröivä kiekko näkyy pimeällä yötaivaalla sumumaisena vanana.
		</div>
		
		<button onclick="haitari('ellipsi')" class="w3-btn w3-block w3-white w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Elliptiset galaksit</strong>
		</button>
		<div id="ellipsi" class="w3-container w3-hide">
			<img src="images/galaksit2.jpg" class="w3-round w3-margin" alt="avaruus" style="float:left; box-shadow: 0 0 16px #777777;">
				Elliptiset galaksit muodostavat noin 10 - 15 prosenttia kaikista galakseista. Ne ovat joko täysin pallomaisia tai hiukan pitkulaisia
				tähtimuodostelmia, joiden tähdet ovat pääasiassa vanhoja. Elliptisissä galakseissa on hyvin vähän kaasua, josta uusia tähtiä voisi muodostua.
				Universumin kaikkein massiivisimmat galaksit ovat elliptisiä galakseja, ja ainakin osan niistä uskotaan syntyvän galaksien yhteentörmäyksissä.
		</div>		
	</div>
   </div>
  </div>

  <!-- Tähtien synty osa-->
  <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="tahdet">
  
    <h2 class="w3-wide w3-center">TÄHTIEN SYNTY</h2>
	
    <p class="w3-opacity w3-center"><i>Pilvipölystä kaasupalloksi</i></p>
	<div class="w3-center"><img src="images/tahtijoukko.jpg" alt="tähtijoukko" style="width:60%; margin:20px" ></div>
    <p class="w3-justify">
	Tähdet syntyvät, kun tähtienvälinen kaasu- ja pölypilvi luhistuu kasaan.
	Pilvi koostuu pääasiassa vedystä, joka on kaikkein kevyin alkuaine.
	Mukana on myös heliumia, pölyä (noin yksi prosentti) ja hiukan raskaampia alkuaineita.</p> 
	
	<h2>Vaiheet</h2>
	
	<button onclick="haitari('pilvi')" class="w3-btn w3-block w3-black w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Pilven luhistuminen</strong> <span class="otsake w3-serif"><i> tähtien alkukoti</i></span>
	</button>
	<div id="pilvi" class="w3-container w3-hide">
		<p>	Jos luhistuva pilvi on kovin pieni, tähtiä syntyy ehkä vain yksi, mutta toisinaan hyvin suuret pilvet alkavat luhistua
		ja tähtiä syntyy runsaasti. Usein puhutaankin tähtien syntyalueista. Valtaosa tähdistä löytyy systeemeistä,
		joissa toisiaan kiertää kaksi tai useampia tähtiä. </p>
	</div>
  
	<button onclick="haitari('ydin')" class="w3-btn w3-block w3-black w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Ytimen tiivistyminen</strong> <span class="otsake w3-serif w3-center"><i> tähdet ja planeetat</i></span>
	</button>
	<div id="ydin" class="w3-container w3-hide">
		<p>Kun pilvi luhistuu, sen ytimeen alkaa tiivistyä tähti (tai useampia tähtiä). 
		Vaikuttaa siltä, että tähtien syntyessä niitten ympärille muodostuu pilven materiaalista hyvin yleisesti myös yksi
		tai useampia planeettoja. Tähdet ja planeetat siis syntyvät yhdessä. </p>
	</div>
  
	<button onclick="haitari('massa')" class="w3-btn w3-block w3-black w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Massan kasvattaminen</strong> <span class="otsake w3-serif"><i> lämpötila nousee</i></span>
	</button>
	<div id="massa" class="w3-container w3-hide">
		<p>	Kun muodostumassa oleva tähti kerää lisää massaa emopilvestään, lämpötila sen ytimessä nousee.
		Jos tähti kerää tarpeeksi massaa (noin 18 prosenttia Auringon massasta), vety alkaa fuusioitua heliumiksi.
		Ellei massa riitä lämpötilan nostamiseen näin ylös, lopputuloksena on ns. ruskea kääpiö,
		joka säteilee hiljaksiin lämpöenergiaansa avaruuteen. </p>
	</div>
  
	<button onclick="haitari('fuusio')" class="w3-btn w3-block w3-black w3-left-align w3-hover-teal w3-padding-16 w3-section">
		<strong class="w3-wide">Vedyn fuusioituminen</strong> <span class="otsake w3-serif"><i> tähti on syntynyt</i></span>
	</button>
	<div id="fuusio" class="w3-container w3-hide">
		<p>Kun vedyn fuusio on alkanut tähden ytimessä, tähteä aletaan kutsua pääsarjan tähdeksi. 
		Kaikki tähdet massastaan riippumatta viettävät pääosan elinkaarestaan pääsarjassa muuttaen vetyä heliumiksi 
		ja säteillen ulos fuusioprosesseissa muodostunutta energiaa. Mitä enemmän massaa tähdellä on, sitä kiivaammin se muuttaa vetynsä heliumiksi.
		Raskaimmissa tähdissä ytimen lämpötila on niin korkea, että myös helium ja sitä raskaammat alkuaineet fuusioituvat ja tuottavat energiaa.
		Vasta rauta on alkuaineena sellainen, että sen ydinten liittäminen yhteen kuluttaa energiaa enemmän kuin tuottaa sitä,
		joten raudan fuusiota ei enää tapahdu tähdissä.  </p>
	</div>
  </div>
  
  <!-- aurinkokunta osa--> 
 <div class="w3-black" id="aurinkokunta">
  <div class="w3-container w3-content w3-center w3-padding-64 w3-black" style="max-width:800px">
    <h2 class="w3-wide">AURINKOKUNTAMME</h2>
    <p class="w3-opacity w3-margin-bottom"><i>Planeettamme kotipaikka</i></p>
    <p class="w3-justify">Aurinkokunta muodostui noin 4,57 miljardia vuotta sitten suuren tähtienvälisen kaasupilven luhistuessa. 
					Pilveen syntyi monia tiivistymiskeskuksia, joihin syntyi tähtiä. Oma Aurinkomme oli yksi niistä. </p>  

  <ul class="nav nav-tabs">
    <li class="active"><a class="w3-teal" data-toggle="tab" href="#synty">Syntyminen</a></li>
    <li><a class="w3-teal" data-toggle="tab" href="#planeetat">Planeetat</a></li>
    <li><a class="w3-teal" data-toggle="tab" href="#aurinko">Aurinko</a></li>
  </ul>

  <div class="tab-content">
    <div id="synty" class="tab-pane fade in active">
      <h3></h3>
				<img src="images/aurinkokunta.jpg" alt="aurinkokunta" style="width:60%; margin:20px">
				<p class="w3-justify">
				Auringon ympärille muodostui pilven materiaalista kiekko, joka koostui pääasiassa vety- ja heliumkaasusta.
				Kiekon muodostumiseen meni noin 100 000 vuotta. Joukossa oli myös raskaampia alkuaineita kuten happea, hiiltä ja typpeä
				sekä erilaisista yhdisteistä muodostunutta pölyä, jota oli kaikesta aineesta noin yksi prosentti.
				Kun pölyhiukkaset törmäilivät toisiinsa kiekossa, alkoi muodostua suurempia kiinteitä kappaleita.
				Planeetat muodostuivat niistä miljoonien vuosien törmäilyn seurauksena. 
				</p>
    </div>
    <div id="planeetat" class="tab-pane fade">
      <h3></h3>
				<img src="images/tahdet.jpg" alt="tähdet" style="width:60%; margin:20px">
				<p class="w3-justify">				
				Aurinkokunnassa on kahdentyyppisiä planeettoja: pieniä kiviplaneettoja sekä suuria kaasuplaneettoja:<br><br>
				Kaasuplaneetat muodostuivat ensin. Kaasuplaneetat muodostuivat kiekossa ns. jäärajan takana. 
				Siellä etäisyys Auringosta oli niin suuri, että kaasumaiset aineet alkoivat jäätyä ja ne oli helpompaa kaapata planeettojen rakennusaineeksi.
				Jouduttuaan planeetan pinnalle jäät kaasuuntuivat uudelleen ja muodostivat planeettojen paksut kaasukehät.
				<br><br>Kiviplaneetat ovat muodostuneet pääasiassa aurinkokunnan synnyttäneen pilven vähäisestä pölymäärästä. 
				Ainoastaan Maalla ja Venuksella on merkittävän paksut kaasukehät. 
				Kiviplaneetat muodostuivat sisemmässä aurinkokunnassa, jäärajan sisäpuolella. 
				</p>
    </div>
    <div id="aurinko" class="tab-pane fade">
      <h3></h3>
				<img src="images/aurinko.jpg" alt="aurinko" style="width:60%; margin:20px">
				<p class="w3-justify">				
				Aurinko puolestaan imi itseensä jatkuvasti lisää materiaalia sitä ympäröivästä kiekosta.
				Lopulta, noin 50 miljoonan vuoden jälkeen, se oli riittävän massiivinen alkaakseen muuttaa vetyä heliumiksi ytimessään.
				Näin Auringosta tuli täysikasvuinen tähti. Jo tätä ennen se oli kuitenkin puhaltanut voimakkaiden tähtituulien avulla kiekon 
				ympäriltään, jättäen vain planeetat jäljelle.</p>
    </div>
    </div>
   </div>	
  </div> 
   
<!-- sisällön loppu -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p class="w3-medium">Copyright Tähtitieteilijät, 2018</p>
</footer>

<script src="tahtitiede.js"></script>  
</body>
</html>
