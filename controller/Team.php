<?php
require_once '../model/DB.php';
$DB=new DB();
$tabela="druzyny";
$kolumny=["nazwa_druzyna", "rok_zalozenia", "miasto_druzyna", "id_obiekt", "id_liga", "logo"];
$join=" d JOIN obiekty s ON d.id_obiekt=s.id_obiekt JOIN ligi l ON d.id_liga=l.id_liga";

if(filter_has_var(INPUT_POST, "get")){
	header("Content-type: application/json");

	if(filter_has_var(INPUT_POST, "idu")){
		$id_user=filter_input(INPUT_POST, "idu");
		$war=["id_uzytkownik", $id_user];
		echo json_encode($DB->wybierz("uzytkownik_druzyna", "id_druzyna", "all", $war, null, null));
	}
	else
		echo json_encode($DB->wybierz($tabela, "*", "all", null, $join, "id_druzyna DESC"));

	exit();
}

if(filter_has_var(INPUT_POST, "iddruz")){
	$id_druzyna=filter_input(INPUT_POST, "iddruz");
	$war=["id_druzyna", $id_druzyna];
	if(filter_has_var(INPUT_POST, "select")){
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, $join, null));
	}
	elseif(filter_has_var(INPUT_POST, "nazwadruz")){
		$wartosci=getPost();

		$location=null;
		if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){
			$nazwa="../data/teams/l".$wartosci[0];
			$ext=pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
			if($ext!="jpg" && $ext!="png" && $ext!="gif"){
				echo "1";
				return false;
			}
			$location=$nazwa.".".$ext;
			require_once "../model/lib/WideImage.php";
			WideImage::load($_FILES['logo']['tmp_name'])->resize(128, 128)->saveToFile($location);
		}
		array_push($wartosci, $location);

		$DB->edytuj($tabela, $kolumny, $wartosci, $war);
		echo json_encode($DB->wybierz($tabela, "*", "obj", $war, $join, null));
	}
	elseif(filter_has_var(INPUT_POST, "fav")){
		$id_user=filter_input(INPUT_POST, "iduser");
		$DB->dodaj("uzytkownik_druzyna", ["id_uzytkownik", "id_druzyna"], [$id_user, $id_druzyna]);
	}
	elseif(filter_has_var(INPUT_POST, "nfav")){
		$id_user=filter_input(INPUT_POST, "iduser");
		$DB->usun("uzytkownik_druzyna", ["id_uzytkownik", $id_user, "&", "id_druzyna", $id_druzyna]);
	}
	elseif(filter_has_var(INPUT_POST, "player")){
		$kolumny=["imie", "nazwisko", "pozycja", "poczatek_kontrakt", "koniec_kontrakt"];
		$war=["id_druzyna", $id_druzyna];
		echo json_encode($DB->wybierz("zawodnicy", $kolumny, "all", $war, null, null));
		unset($_POST["iddruz"], $_POST["player"], $id_druzyna);
	}

	else{
		$DB->usun($tabela, $war);
	}
}

elseif(filter_has_var(INPUT_POST, "identuser")){
	array_unshift($kolumny, "id_uzytkownik");
	$wartosci=getPost();

	$location=null;
	if(file_exists($_FILES['logo']['tmp_name']) && is_uploaded_file($_FILES['logo']['tmp_name'])){
		$nazwa="../data/teams/l".$wartosci[0];
		$ext=pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
		if($ext!="jpg" && $ext!="png" && $ext!="gif"){
			echo "1";
			return false;
		}
		$location=$nazwa.".".$ext;
		require_once "../model/lib/WideImage.php";
		WideImage::load($_FILES['logo']['tmp_name'])->resize(128, 128)->saveToFile($location);
	}
	array_push($wartosci, $location);

	$DB->dodaj("zgloszenia_druzyn", $kolumny, $wartosci);
	$druzyna=$DB->wybierz($tabela, "*", "obj", null, "".$join." WHERE id_druzyna IN(SELECT MAX(id_druzyna) FROM druzyny)", null);
	echo json_encode($druzyna);
}

function getPost(){
	$nazwadruz=filter_input(INPUT_POST, "nazwadruz");
	$rokdruz=filter_input(INPUT_POST, "rokdruz");
	$miastodruz=filter_input(INPUT_POST, "miastodruz");
	$obiektdruz=filter_input(INPUT_POST, "obiektdruz");
	$ligadruz=filter_input(INPUT_POST, "ligadruz");
	$dane=[$nazwadruz, $rokdruz, $miastodruz, $obiektdruz, $ligadruz];

	if(filter_has_var(INPUT_POST, "identuser")){
		$identuser=filter_input(INPUT_POST, "identuser");
		array_unshift($dane, $identuser);
	}

	return $dane;
}

unset($id_druzyna);