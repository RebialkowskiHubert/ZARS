<?php

require_once '../model/DB.php';
$DB=new DB();

if(filter_has_var(INPUT_POST, "selzaw")){
	$kolumny=["id_zgloszenia_zawodnika", "login", "z.imie", "z.nazwisko", "nazwa_druzyna"];
	$join=" z JOIN uzytkownicy u ON z.id_uzytkownik=u.id_uzytkownik JOIN druzyny d ON z.id_druzyna=d.id_druzyna";
	echo json_encode($DB->wybierz("zgloszenia_zawodnikow", $kolumny, "all", null, $join, null));
}

elseif(filter_has_var(INPUT_POST, "seldruz")){
	$kolumny=["id_zgloszenia_druzyny", "login", "nazwa_druzyna", "rok_zalozenia", "miasto_druzyna", "nazwa_obiekt", "nazwa_liga"];
	$join=" z JOIN uzytkownicy u ON z.id_uzytkownik=u.id_uzytkownik JOIN obiekty s ON z.id_obiekt=s.id_obiekt JOIN ligi l ON z.id_liga=l.id_liga";
	echo json_encode($DB->wybierz("zgloszenia_druzyn", "*", "all", null, $join, null));
}

elseif(filter_has_var(INPUT_POST, "idzaw")){
	$idzaw=filter_input(INPUT_POST, "idzaw");
	$war=["id_zgloszenia_zawodnika", $idzaw];

	if(filter_has_var(INPUT_POST, "show")){
		$kolumny=["id_zgloszenia_zawodnika", "login", "z.imie", "z.nazwisko", "data_urodzenia", "nazwa_druzyna", "poczatek_kontrakt", "koniec_kontrakt", "waga", "wzrost", "pozycja"];
		$join=" z JOIN uzytkownicy u ON z.id_uzytkownik=u.id_uzytkownik JOIN druzyny d ON z.id_druzyna=d.id_druzyna WHERE id_zgloszenia_zawodnika= ".$idzaw;
		echo json_encode($DB->wybierz("zgloszenia_zawodnikow", $kolumny, "obj", null, $join, null));
		return;
	}

	elseif(filter_has_var(INPUT_POST, "accept")){
		$kolumny=["imie", "nazwisko", "data_urodzenia", "id_druzyna", "poczatek_kontrakt", "koniec_kontrakt", "waga", "wzrost", "pozycja"];
		$zawodnik=$DB->wybierz("zgloszenia_zawodnikow", $kolumny, "obj", $war, null, null);
		$a=[];
		$a[0]=$zawodnik->imie;
		$a[1]=$zawodnik->nazwisko;
		$a[2]=$zawodnik->data_urodzenia;
		$a[3]=$zawodnik->id_druzyna;
		$a[4]=$zawodnik->poczatek_kontrakt;
		$a[5]=$zawodnik->koniec_kontrakt;
		$a[6]=$zawodnik->waga;
		$a[7]=$zawodnik->wzrost;
		$a[8]=$zawodnik->pozycja;

		$DB->dodaj("zawodnicy", $kolumny, $a);
		$DB->usun("zgloszenia_zawodnikow", $war);
		return;
	}

	elseif(filter_has_var(INPUT_POST, "delete")){
		$DB->usun("zgloszenia_zawodnikow", $war);
		return;
	}
}

elseif(filter_has_var(INPUT_POST, "iddruz")){
	$iddruz=filter_input(INPUT_POST, "iddruz");
	$war=["id_zgloszenia_druzyny", $iddruz];

	if(filter_has_var(INPUT_POST, "accept")){
		$kolumny=["nazwa_druzyna", "rok_zalozenia", "miasto_druzyna", "id_obiekt", "id_liga", "logo"];
		$druzyna=$DB->wybierz("zgloszenia_druzyn", $kolumny, "obj", $war, null, null);
		$a=[];
		$a[0]=$druzyna->nazwa_druzyna;
		$a[1]=$druzyna->rok_zalozenia;
		$a[2]=$druzyna->miasto_druzyna;
		$a[3]=$druzyna->id_obiekt;
		$a[4]=$druzyna->id_liga;
		$a[5]=$druzyna->logo;
		
		$DB->dodaj("druzyny", $kolumny, $a);
		$DB->usun("zgloszenia_druzyn", $war);
		return;
	}

	elseif(filter_has_var(INPUT_POST, "delete")){
		$DB->usun("zgloszenia_druzyn", $war);
		return;
	}
}