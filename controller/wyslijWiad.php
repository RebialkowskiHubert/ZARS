<?php
if(filter_has_var(INPUT_POST, "nickwiad")){
	require_once "../model/DB.php";

	$nick = filter_input(INPUT_POST, "nickwiad");
	$email = filter_input(INPUT_POST, "emailwiad");
	$wiadomosc = filter_input(INPUT_POST, "wiad");
	$dokogo = filter_input(INPUT_POST, "dokogo");
	$odkogo = filter_input(INPUT_POST, "odkogo");

	if($odkogo=="")
		$odkogo=0;
	if($dokogo=="")
		$dokogo=0;

	$DB = new DB();
	date_default_timezone_set("Europe/Warsaw");
	$data_message = date("Y-m-d H:i:s");

	$kolumny=["nick", "email_wiad", "wiadomosc", "data_wiad", "przeczytana", "od", "do"];
	$wartosci=[$nick, $email, $wiadomosc, $data_message, $odkogo, $dokogo];
	$DB->dodaj("wiadomosci_przychodzace", $kolumny, $wartosci);
	$DB->dodaj("wiadomosc_wychodzace", ["wiadomosc", "data_wiad", "od", "do"], [$wiadomosc, $data_message, $odkogo, $dokogo]);

	$wyslane=$DB->wybierz("wiadomosci_przychodzace", ["id_wiad", "data_wiad", "do"], "all", ["od", $odkogo], null, "data_wiad DESC");
	$wyslana=$wyslane[0];
	echo json_encode($wyslana);

	unset($nick, $email, $wiadomosc, $data_message, $odkogo, $dokogo);
}
?>