<?php
require_once '../model/DB.php';

if(filter_has_var(INPUT_POST, "id_wiad")){
	$msg=filter_input(INPUT_POST, "id_wiad");
	$DB=new DB();
	$war=["id_wiad", $msg];

	if(filter_has_var(INPUT_POST, "przych"))
		$wiad=$DB->wybierz("wiadomosci_przychodzace", "*", "obj", $war, null, null);
	elseif(filter_has_var(INPUT_POST, "wych"))
		$wiad=$DB->wybierz("wiadomosci_wychodzace", "*", "obj", $war, null, null);
	echo json_encode($wiad)
}