<?php
require_once '../model/DB.php';
$DB=new DB();
$tabela="obiekty";
$kolumny=["nazwa_obiekt", "miasto_obiekt", "rok_powstania", "pojemnosc", "x", "y"];

if(filter_has_var(INPUT_POST, "get")){
	header("Content-type: application/json");
	echo json_encode($DB->wybierz($tabela, "*", "all", null, null, null));
	exit();
}

if(filter_has_var(INPUT_POST, "idstad")){
	$id=filter_input(INPUT_POST, "idstad");
	$war=["id_obiekt", $id];
	if(filter_has_var(INPUT_POST, "select")){
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, null, null));
	}

	elseif(filter_has_var(INPUT_POST, "nazwastad")){
		$wartosci=getPost();
		$DB->edytuj($tabela, $kolumny, $wartosci, $war);
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, null, null));
	}
	else{
		$DB->usun($tabela, $war);
	}
}

else{
	$wartosci=getPost();
	$DB->dodaj($tabela, $kolumny, $wartosci);
	$obiekt=$DB->wybierz($tabela, "*", "obj", null, " WHERE id_obiekt IN(SELECT MAX(id_obiekt) FROM obiekty)", null);
	echo json_encode($obiekt);
}

function getPost(){
	$nazwastad=filter_input(INPUT_POST, "nazwastad");
	$miastostad=filter_input(INPUT_POST, "miastostad");
	$rokstad=filter_input(INPUT_POST, "rokstad");
	$pojstad=filter_input(INPUT_POST, "pojstad");
	$x=filter_input(INPUT_POST, "x");
	$y=filter_input(INPUT_POST, "y");
	$dane=[$nazwastad, $miastostad, $rokstad, $pojstad, $x, $y];
	return($dane);
}

unset($id);