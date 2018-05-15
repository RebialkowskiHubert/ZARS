<?php
if(filter_has_var(INPUT_POST, "wiadomosc")){
	require_once '../model/DB.php';
	$DB=new DB();
	$id=filter_input(INPUT_POST, "wiadomosc");

	if(filter_has_var(INPUT_POST, "przych")){
		if($DB->usun("wiadomosci_przychodzace", ["id_wiad",$id]))
			echo 'Wiadomość została usunięta.';
		else
			echo 'Wystąpił błąd, przepraszamy za utrudnienia.';
	}
	elseif(filter_has_var(INPUT_POST, "wych")){
		if($DB->usun("wiadomosci_wychodzace", ["id_wiad",$id]))
			echo 'Wiadomość została usunięta.';
		else
			echo 'Wystąpił błąd, przepraszamy za utrudnienia.';	
	}
}