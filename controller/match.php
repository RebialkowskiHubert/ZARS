<?php
require_once '../model/DB.php';
$DB=new DB();
$tabela="mecze";

if(filter_has_var(INPUT_POST, "idlig")){
	$id=filter_input(INPUT_POST, "idlig");

	if(filter_has_var(INPUT_POST, "select")){
		$war=["id_liga", $id];
		echo json_encode($DB->wybierz($tabela, "id_mecz", "all", $war, null, null));
	}

	elseif(filter_has_var(INPUT_POST, "stat")){
		$join="k JOIN statystyki_druzyny d ON k.id_statystyki_druzyny=d.id_statystyki_druzyny";
		$join.=" JOIN druzyny r ON d.id_druzyna=r.id_druzyna";
		$join.=" WHERE d.id_liga=".$id;
		echo json_encode($DB->wybierz("statystyki_klubu", "*", "all", null, $join, null));
	}

	elseif(filter_has_var(INPUT_POST, "bram")){
		$kolumny=["CONCAT(z.Imie, ' ', z.Nazwisko) as Zawodnik", "d.nazwa_druzyna", "COUNT(sz.bramka) as bramki"];
		$join=" sz JOIN mecze m ON m.id_mecz = sz.id_mecz JOIN zawodnicy z ON z.id_zawodnik = sz.id_zawodnik JOIN druzyny d ON z.id_druzyna = d.id_druzyna WHERE m.id_liga = ".$id." GROUP BY sz.id_zawodnik ORDER BY sz.bramka DESC";
		echo json_encode($DB->wybierz("statystyki_zawodnikow", $kolumny, "all", null, $join, null));
	}
}

elseif(filter_has_var(INPUT_POST, "idmecz")){
	$idmecz=filter_input(INPUT_POST, "idmecz");

	if(filter_has_var(INPUT_POST, "upd")){
		$war=["id_mecz", $idmecz];
		$DB->usun("statystyki_zawodnikow", $war);

		$kolumny=["id_zawodnik", "id_mecz", "bramka"];

		$bram1=filter_input(INPUT_POST, "goldr1");
		$bram2=filter_input(INPUT_POST, "goldr2");
		for($i=0; $i<$bram1; $i++){
			$x=filter_input(INPUT_POST, "bramone".$i);
			if($x==0)
				continue;

			$val=[$x, $idmecz, 1];
			$DB->dodaj("statystyki_zawodnikow", $kolumny, $val);
		}

		for($i=0; $i<$bram2; $i++){
			$x=filter_input(INPUT_POST, "bramtwo".$i);
			if($x==0)
				continue;

			$val=[$x, $idmecz, 1];
			$DB->dodaj("statystyki_zawodnikow", $kolumny, $val);
		}

		$kolumny=["bramki_druzyna1", "bramki_druzyna2"];
		$val=[$bram1, $bram2];
		$DB->edytuj($tabela, $kolumny, $val, $war);

		$id_druzyna1=filter_input(INPUT_POST, "iddruz1");
		$id_druzyna2=filter_input(INPUT_POST, "iddruz2");
		$id_liga=filter_input(INPUT_POST, "idligi");
		$goleA1=filter_input(INPUT_POST, "golA1");
		$goleA2=filter_input(INPUT_POST, "golB1");
		$goleB1=filter_input(INPUT_POST, "golA2");
		$goleB2=filter_input(INPUT_POST, "golB2");

		$DB->aktualizujMecz($id_druzyna1, $id_druzyna2, $id_liga, $goleA1, $goleA2, $bram1, $bram2);
	}

	elseif(filter_has_var(INPUT_POST, "iddruz")){
		$id_druzyna=filter_input(INPUT_POST, "iddruz");
		$kolumny=["z.id_zawodnik", "imie", "nazwisko"];
		$join="s JOIN zawodnicy z ON s.id_zawodnik=z.id_zawodnik";
		$war=["id_mecz", $idmecz, "&", "id_druzyna", $id_druzyna];
		echo json_encode($DB->wybierz("statystyki_zawodnikow", $kolumny, "all", $war, $join, null));
	}
	
	else{
		$kolumny=["m.kolejka", "d1.id_druzyna AS id1", "d1.nazwa_druzyna as druzynaA", "m.bramki_druzyna1", "d2.id_druzyna AS id2", "d2.nazwa_druzyna as druzynaB", "m.bramki_druzyna2", "d1.logo as logoA", "d2.logo as logoB"];
		$join="m JOIN druzyny d1 ON m.id_druzyna1=d1.id_druzyna JOIN druzyny d2 ON m.id_druzyna2=d2.id_druzyna WHERE id_mecz=".$idmecz;
		echo json_encode($DB->wybierz($tabela, $kolumny, "obj", null, $join, null));
	}
	
}

elseif(filter_has_var(INPUT_POST, "iddruz")){
	$id_druzyna=filter_input(INPUT_POST, "iddruz");
	$kolumny=["id_zawodnik", "imie", "nazwisko"];
	$war=["id_druzyna", $id_druzyna];
	echo json_encode($DB->wybierz("zawodnicy", $kolumny, "all", $war, null, null));
}