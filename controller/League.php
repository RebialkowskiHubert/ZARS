<?php
require_once '../model/DB.php';
$DB=new DB();
$tabela="ligi";
$kolumny=["id_liga", "nazwa_liga", "kraj", "poziom", "id_sezon"];

if(filter_has_var(INPUT_POST, "get")){
	header("Content-type: application/json");
	echo json_encode($DB->wybierz($tabela, "*", "all", null, " l JOIN sezony s ON l.id_sezon=s.id_sezon", "id_liga DESC"));
	exit();
}

if(filter_has_var(INPUT_POST, "idlig")){
	$id=filter_input(INPUT_POST, "idlig");
	$war=["id_liga", $id];
	if(filter_has_var(INPUT_POST, "select")){
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, " l JOIN sezony s ON l.id_sezon=s.id_sezon", null));
	}

	elseif(filter_has_var(INPUT_POST, "nazwalig")){
		$wartosci=getPost();
		$DB->edytuj($tabela, $kolumny, $wartosci, $war);
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, " l JOIN sezony s ON l.id_sezon=s.id_sezon", null));
	}

	elseif(filter_has_var(INPUT_POST, "druzynal")){
		echo json_encode($DB->wybierz("druzyny", "nazwa_druzyna", "all", $war, null, null));
	}

	else{
		$DB->usun($tabela, $war);
	}
}

else{
	$data=getPost();
	$DB->dodaj($tabela, $kolumny, $wartosci);
	$liga=$DB->wybierz($tabela, "*", "obj", null," l JOIN sezony s ON l.id_sezon=s.id_sezon WHERE id_liga IN(SELECT MAX(id_liga) FROM ligi)", null);
	echo json_encode($liga);
}

function getPost(){
	$nazwalig=filter_input(INPUT_POST, "nazwalig");
	$krajlig=filter_input(INPUT_POST, "krajlig");
	$poziomlig=filter_input(INPUT_POST, "poziomlig");
	$sezonlig=filter_input(INPUT_POST, "sezonlig");
	$dane=[$nazwalig, $krajlig, $poziomlig, $sezonlig];
	return($dane);
}

unset($id);