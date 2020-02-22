/* file: ot5.js
   desc: Veikkausliiga -sovelluksen toiminnoissa:
   			-uusien havaintojen lisäys
			-lintulajikohtaisten havaintojen haku
			-kaikkien havaintojen näyttäminen
			-yksittäisen havainnon poisto (tapahtuu kaikki havainnot taulukossa)
		tarvittavat skriptit.
   date: 23.8.2018
   auth: Maarit Parkkonen
 */

$(function(){ 	
//globaalit muuttujat
var nakyvissa=null;								//mikä toiminto näkyvissä (null=ei mikään eli päänäkymä)
var id;											//päivityksessä haetun joukkueen id

//toimintoelementit
var $osaUusi=$("div#osaUusi");					//Uusi joukkue -elementti
var $osaHae=$("div#osaHae");					//Hae joukkueen tiedot -elementti
var $osaPaivita=$("div#osaPaivita");			//Päivitä joukkue -elementti
var $osaPoista=$("div#osaPoista");				//Poista joukkue -elementti

var $paivitysKentat=$("div#paivitysKentat");

//painikkeet
var $painikkeet=$("div#painikkeet");			//päänäytön kaikki painikkeet
var $uusiPainike=$("#uusi");					//Uusi joukkue -elementin avaus
var $haePainike=$("#hae");						//Hae joukkue -elementin avaus
var $paivitaPainike=$("#paivita");				//Päivitä joukkue -elementin avaus
var $poistaPainike=$("#poista");				//Poista joukkue -elementin avaus

var $tallennaPainike=$("#tallenna");			//uuden joukkueen tietojen lisäys tietokantaan
var $teeHakuPainike=$("#teeHaku");				//joukkueen tietojen haku tietokannasta
var $poistaJoukkuePainike=$("#poistaJoukkue");	//joukkueen poistaminen tietokannasta
var $haeTiedotPainike=$("#haeTiedot");			//päivitettävän joukkueen tietojen hakeminen
var $teePaivitysPainike=$("#teePaivitys");		//päivittää tiedot tietokantaan

var $peruPainike=$("button.peru");				//kaikkien elementtien peru/paluu/sulje -painikkeet
	

//Päivitä lomakkeen syötekentät
var $joukkuePaivita=$("#joukkuePaivita");		
var $voitotP=$("#voitotP");				
var $tasatP=$("#tasapelitP");				
var $tappiotP=$("#tappiotP");		

//Uusi joukkue lomakkeen syötekentät
var $joukkue=$("#joukkue");				
var $voitot=$("#voitot");				
var $tasat=$("#tasapelit");				
var $tappiot=$("#tappiot");				

//Haku lomakkeen syötekenttä
var $joukkueHaku=$("#joukkueHaku");	

//Poista lomakkeen syötekenttä
var $joukkuePoista=$("#joukkuePoista");	

//tulostusalue
var $tulostus=$("#tulostus");	
	
	//Sivun alustus---------------------------------------------------------//
	
	//liigataulukko näkyviin
	window.addEventListener('load',tulostaLiigataulukko(),false);
	
	//elementtien piilotus
	$osaPaivita.hide();	
	$osaUusi.hide();					
	$osaHae.hide();				
	$osaPoista.hide();
	
	//Päänäytön painikkeet-------------------------------------------------//	
	
	//avaa Uusi joukkue -elementin
	$uusiPainike.on("click",function(){
		naytaElementti($osaUusi);		//elementin avaus
		$joukkue.focus();				//kohdistin joukkue -kenttään
	});	
	
	//avaa Haku -elementin
	$haePainike.on("click",function(){
		naytaElementti($osaHae);		//elementin avaus
		$joukkueHaku.focus();			//kohdistin joukkue -kenttään
	});	

	//avaa Päivitys -elementin
	$paivitaPainike.on("click",function(){
		naytaElementti($osaPaivita);	//elementin avaus
		$paivitysKentat.hide();			//joukkuetietojen syöttökentät pois näkyvistä
		$teePaivitysPainike.hide();		//päivitä -painike pois näkyvistä
		$haeTiedotPainike.show();		//Hae tiedot -painike näkyviin
		$joukkuePaivita.focus();		//kohdistin joukkue -kenttään
	});	
	
	//avaa Poista joukkue -elementin
	$poistaPainike.on("click",function(){
		naytaElementti($osaPoista); 	//elementin avaus
		$joukkuePoista .focus();		//kohdistin joukkue -kenttään
	});
	//------------------------------------------------------------------------------------//
	
	//toimintaelementin avaaminen näkyviin
	function naytaElementti(elementti){
		$painikkeet.hide();
		if (nakyvissa!=null){		//jos edellinen elementti näkyvissä
			nakyvissa.hide();		//piilotetaan
			$tulostus.html("");		//tulostusalueen tyhjennys
		}
		elementti.fadeIn(100);		//uusi elementti näkyviin	
		nakyvissa=elementti;		//merkitään elementti muistiin
	}
	
	
	//elementtien peru/paluu/sulje -painikkeet
	$peruPainike.on("click",function(){
		paanayttoon();		//paluu päänäyttöön
	});	

	//paluu päänäyttöön
	function paanayttoon(){
		nakyvissa.hide();			//piilota näkyvä toimintaelementti
		$("input").val("");			//tyhjennä syöttökentät
		$painikkeet.fadeIn(100);	//päänäytön painikkeet näkyviin
		$tulostus.html("");			//tulostusalueen tyhjennys
		tulostaLiigataulukko();
		nakyvissa=null;				//ei toimintaelementtejä näkyvissä
	}

	//Liigataulukon näyttäminen-------------------------------------------------------------------//
	function tulostaLiigataulukko(){		
		$.ajax({url: "ot5b/ot5b.php", success: function(result) {	//pyydetään tietoja php -tiedoston kautta	
			tulostaTaulukko(result); 								//lähetetään  palvelimelta tullut luettelo tulostettavaksi							 
		} 				
		});	
	}
	
    //Uuden joukkueen tallennus-------------------------------------------------------------------//
    $tallennaPainike.click(function(){  	//Uusi joukkue -elementin tallenna painikkeesta
		if (tarkistaTiedot()==true){		//syöttökenttien tietojen tarkistus
			var pyynto="ot5d/ot5d.php?joukkue="+$joukkue.val()+"&voitot="+$voitot.val()+"&tasapelit="+$tasat.val()+"&tappiot="+$tappiot.val();
			$.ajax({url: pyynto , success: function(result) {		//pyydetään tietoja php -tiedoston kautta
				tulostaTaulukko(result); 							//lähetetään  palvelimelta tullut luettelo tulostettavaksi		
			} 				
			});		
			paanayttoon();											//paluu päänäyttöön
		} 
    });
	
	//Uusi havainto -lomakkeen syöttökenttien tietojen tarkistus
	//	-palauttaa false, jos tiedot virheelliset
	//	-palauttaa true, jos tiedot ok
	function tarkistaTiedot(){
			if ($joukkue.val()==""){		//jos lajinimi puuttuu
				$tulostus.html("Joukueen nimi puuttuu");
				$joukkue.focus();
				return false;						
				}
			else if ($voitot.val()==""){	//jos kappalemäärä puuttuu
				$tulostus.html("Voitot puuttuu");
				$voitot.focus();
				return false;
			}
			else if ($tasat.val()==""){	//jos kappalemäärä puuttuu
				$tulostus.html("Tasapelit puuttuu");
				$tasat.focus();
				return false;
			}
			else if ($tappiot.val()==""){	//jos kappalemäärä puuttuu
				$tulostus.html("Tappiot puuttuu");
				$tappiot.focus();
				return false;
			}
			else{
				return true;
			}
	}

    //Joukkueen hakeminen--------------------------------------------------------------------------//
    $teeHakuPainike.click(function(){			//hakupainikkeesta
		var haettava=$joukkueHaku.val();		//haettavan joukkueen nimi
		if (haettava!=""){						//jos hakukenttä ei tyhjä
			var pyynto="ot5c/ot5c.php?joukkue="+haettava;		//ajax -pyyntö
			$.ajax({url: pyynto , success: function(result) {	//pyydetään tietoja php -tiedoston kautta	
				tulostaTaulukko(result); 						//lähetetään  palvelimelta tullut luettelo tulostettavaksi		
			} 				
			});
		}
		else {									//jos tyhjä hakukenttä
			$tulostus.html("Joukkueen nimi puuttuu");
			$joukkueHaku.focus();			
		}
    });
		
    //Joukkueen tietojen päivittäminen---------------------------------------------------------------------// 
	
	//tallennettujen tietojen haku syötekenttiin
	$haeTiedotPainike.click(function(){
		var hae=$joukkuePaivita.val();		//haettavan joukkueen nimi
		if (hae!=""){						//jos hakukenttä ei tyhjä
			var pyynto="ot5c/ot5c.php?joukkue="+hae;			//ajax -pyyntö
			$.ajax({url: pyynto , success: function(result) {	//pyydetään tietoja php -tiedoston kautta	
				if (result.length>0){							//joukkue löytyi
					$paivitysKentat.show();						//syötekentät näkyviin
					$teePaivitysPainike.show();								
					$joukkuePaivita.val(result[0].joukkue);		//joukkueen tiedot syötekenttiin
					$voitotP.val(result[0].voitot);	
					$tasatP.val(result[0].tasapelit);	
					$tappiotP.val(result[0].tappiot);
					id=result[0].id;							//id talteen 
					$haeTiedotPainike.hide();					
					tulostaLiigataulukko();
				}	
				else{
					$tulostus.html("Joukkuetta ei löytynyt");
				}				
			} 				
			});
		}
		else {								//jos tyhjä hakukenttä
			$tulostus.html("Joukkueen nimi puuttuu");
			$joukkuePaivita.focus();			
		}		
	});	
	
	//tietojen päivitys tietokantaan
	$teePaivitysPainike.click(function(){
		var pyynto="ot5f/ot5f.php?id="+id+"&joukkue="+$joukkuePaivita.val()+"&voitot="+$voitotP.val()+"&tasapelit="+$tasatP.val()+"&tappiot="+$tappiotP.val();
		$.ajax({url: pyynto , success: function(result) {	//pyydetään tietojen tallennus php -tiedoston kautta	
			tulostaTaulukko(result); 						//lähetetään  palvelimelta tullut luettelo tulostettavaksi		
		} 				
		});		
		paanayttoon();										//paluu päänäyttöön
	});


    //Joukkueen poistaminen------------------------------------------------------------------------// 
    $poistaJoukkuePainike.click(function(){					
		var pyynto="ot5e/ot5e.php?joukkue="+$joukkuePoista.val();	//pyydetään joukkueen poistamista php -tiedoston kautta	
		$.ajax({url: pyynto , success: function(result) {	
			tulostaTaulukko(result); 								//lähetetään  palvelimelta tullut luettelo tulostettavaksi		
		} 				
		});														
		paanayttoon();												//paluu päänäyttöön
    });

	

	//muodostaa ja tulostaa html -taulukon php -tiedoston palauttamasta luettelosta
	function tulostaTaulukko(luettelo){		
	if (luettelo.length>0){ 								//palautuksessa on rivejä
		var otsikot=["Joukkue","Ottelut","Voitot","Tasapelit","Häviöt","Pisteet"];		//html-taulukon otsikot
		var varillinen=false;								//html-taulukon riviin liitettävä tyylimääre
		var tuloste;										//html muotoinen tuloste
		var i;
		var ottelutKpl;										
		var pisteet;
		
		tuloste = "<table><tr>"; 						
		for(i = 0; i < otsikot.length; i++){				//Käydään taulukon otsikot läpi
			tuloste +="<th>"+otsikot[i]+"</th>";			//ja lisätään ne tulosteen jatkoksi
		}
		tuloste += "</tr>";
		
		
		for(i = 0; i < luettelo.length; i++){				//käydään taulukon tiedot läpi rivi eli joukkue kerrallaan	
			if (varillinen){ 								//jokatoinen rivi värilliseksi css -luokkamääritteen kautta
				tuloste +='<tr class="vari">';	
				varillinen=false;
			}
			else{	
				tuloste +="<tr>";
				varillinen=true;
			}			
			ottelutKpl=Number(luettelo[i].voitot)+Number(luettelo[i].tasapelit)+Number(luettelo[i].tappiot); //lasketaan otteluiden määrä
			pisteet=(3*Number(luettelo[i].voitot))+Number(luettelo[i].tasapelit);							 //pisteiden laskenta
			//yhden joukkueen tiedot html -taulukossa
			tuloste += "<td>" + luettelo[i].joukkue + "</td><td>" + ottelutKpl + "</td><td>" + luettelo[i].voitot + "</td><td>" + luettelo[i].tasapelit + "</td><td>" + luettelo[i].tappiot + "</td><td>" + pisteet +"</td></tr>";
		}
		tuloste += "</table>";
	}
	else{ //palautus oli tyhjä
		tuloste="Ei tietoja";
	}
		$tulostus.html("");
		$tulostus.append(tuloste);	//valmiin html -taulukon tulostus	
	}
	
});