<?php
require_once '../model/DB.php';
$DB=new DB();
$tabela="sezony";
$kolumny=["rok_rozpoczecia", "rok_zakonczenia"];

if(filter_has_var(INPUT_POST, "get")){
	header("Content-type: application/json");
	echo json_encode($DB->wybierz($tabela, "*", "all", null, null, "id_sezon DESC"));
	exit();
}

if(filter_has_var(INPUT_POST, "idsez")){
	$id=filter_input(INPUT_POST, "idsez");
	$war=["id_sezon", $id];
	if(filter_has_var(INPUT_POST, "select")){
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, null, null));
	}
	elseif(filter_has_var(INPUT_POST, "startsez")){
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
	$sezon=$DB->wybierz($tabela, "*", "obj", null," WHERE id_sezon IN(SELECT MAX(id_sezon) FROM sezony)", null);
	echo json_encode($sezon);
}

function getPost(){
	$startsez=filter_input(INPUT_POST, "startsez");
	$stopsez=filter_input(INPUT_POST, "stopsez");
	$dane=[$startsez, $stopsez];
	return $dane;
}

unset($id);