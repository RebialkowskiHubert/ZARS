<?php
require_once '../model/DB.php';
$DB=new DB();
$tabela="zawodnicy";
$kolumny=["imie", "nazwisko", "data_urodzenia", "id_druzyna", "poczatek_kontrakt", "koniec_kontrakt", "waga", "wzrost", "pozycja"];

if(filter_has_var(INPUT_POST, "get")){
	header("Content-type: application/json");
	echo json_encode($DB->wybierz($tabela, "*", "all", null, " z JOIN druzyny d ON z.id_druzyna=d.id_druzyna", "id_zawodnik DESC"));
	exit();
}

if(filter_has_var(INPUT_POST, "idzaw")){
	$id=filter_input(INPUT_POST, "idzaw");
	$war=["id_zawodnik", $id];
	if(filter_has_var(INPUT_POST, "select")){
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, " z JOIN druzyny d ON z.id_druzyna=d.id_druzyna", null));
	}

	elseif(filter_has_var(INPUT_POST, "imiezaw")){
		$wartosci=getPost();
		$DB->edytuj($tabela, $kolumny, $wartosci, $war);
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, " z JOIN druzyny d ON z.id_druzyna=d.id_druzyna", null));
	}

	else{
		$DB->usun($tabela, $war);
	}
}

elseif(filter_has_var(INPUT_POST, "identuser")){
	array_unshift($kolumny, "id_uzytkownik");
	$wartosci=getPost();
	$DB->dodaj("zgloszenia_zawodnikow", $kolumny, $wartosci);
	$zawodnik=$DB->wybierz($tabela, "*", "obj", null," z JOIN druzyny d ON z.id_druzyna=d.id_druzyna WHERE id_zawodnik IN(SELECT MAX(id_zawodnik) FROM zawodnicy)", null);
	echo json_encode($zawodnik);
}

function getPost(){
	$imiezaw=filter_input(INPUT_POST, "imiezaw");
	$nazwiskozaw=filter_input(INPUT_POST, "nazwiskozaw");
	$datazaw=filter_input(INPUT_POST, "datazaw");	
	$druzynazaw=filter_input(INPUT_POST, "druzynazaw");
	$startzaw=filter_input(INPUT_POST, "startzaw");
	$stopzaw=filter_input(INPUT_POST, "stopzaw");
	$wagazaw=filter_input(INPUT_POST, "wagazaw");
	$wzrostzaw=filter_input(INPUT_POST, "wzrostzaw");
	$pozycjazaw=filter_input(INPUT_POST, "pozycjazaw");
	$dane=[$imiezaw, $nazwiskozaw, $datazaw, $druzynazaw, $startzaw, $stopzaw, $wagazaw, $wzrostzaw, $pozycjazaw];

	if(filter_has_var(INPUT_POST, "identuser")){
		$identuser=filter_input(INPUT_POST, "identuser");
		array_unshift($dane, $identuser);
	}
	
	return($dane);
}

unset($id);