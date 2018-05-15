<?php
if(filter_has_var(INPUT_POST, "id")){
	$id= filter_input(INPUT_POST, "id");
	require_once '../model/DB.php';
	$DB=new DB();
	$DB->edytuj("wiadomosci_przychodzace", ["przeczytana"], [1], ["id_wiad", $id]);
}