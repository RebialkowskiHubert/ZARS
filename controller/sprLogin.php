<?php

$login=filter_input(INPUT_POST, "login");
require_once '../model/DB.php';
$DB=new DB();
$war=["login", $login, "|", "id_uzytkownik", $login];
$uzytkownik=$DB->wybierz("uzytkownicy", "*", "obj", $war, null, null);
if($uzytkownik!="")
    echo json_encode($uzytkownik);
else
    echo 'Brak użytkownika o podanym loginie.';