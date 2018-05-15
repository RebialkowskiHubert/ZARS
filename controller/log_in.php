<?php

require_once '../model/DB.php';

$loginn = filter_input(INPUT_POST, "loginn");
$hasloo = filter_input(INPUT_POST, "hasloo");

$DB = new DB();

$war=["login", $loginn, "|", "id_uzytkownik", $loginn];
$user=$DB->wybierz("uzytkownicy", "*", "obj", $war, null, null);

if (!isset($user->haslo))
    echo "-1";
else {
    if (password_verify($hasloo, $user->haslo)){
        session_start();
        $_SESSION["login"]=$user->login;

        echo $user->typ;
    }
    else
        echo "-1";
}
?>