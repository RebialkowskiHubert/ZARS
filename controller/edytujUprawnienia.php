<?php

require_once "../model/DB.php";
$DB=new DB();
$uzytkownik= filter_input(INPUT_POST, "uzytkownik");

$result=$DB->zmienUprawnienia($uzytkownik);
echo $result->typ;