<?php

$OK = true;

require_once "../model/DB.php";
$DB = new DB();
$tabela="uzytkownicy";
$login = filter_input(INPUT_POST, "login");
$war=["login", $login];
$loginy = $DB->wybierz($tabela, "COUNT(*)", "col", $war, null, null);
if ($loginy > 0) {
    $OK = false;
    echo "1";
}

$email = filter_input(INPUT_POST, "email1");
$email2 = filter_var($email, FILTER_SANITIZE_EMAIL);

if ((filter_var($email2, FILTER_VALIDATE_EMAIL) == false) || ($email2 != $email))
    $OK = false;

$war=["email", $email];
$emaile = $DB->wybierz($tabela, "COUNT(*)", "col", $war, null, null);
if ($emaile > 0) {
    $OK = false;
    echo "2";
}

if (isset($_POST["imie"])) {
    $imie = filter_input(INPUT_POST, "imie");
    $nazwisko = filter_input(INPUT_POST, "nazwisko");
    $haslo1 = filter_input(INPUT_POST, "haslo1");
    $haslo2 = filter_input(INPUT_POST, "haslo2");

    if ((strlen($haslo1) < 8) || (strlen($haslo1) > 20))
        $OK = false;

    if ($haslo1 != $haslo2)
        $OK = false;

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    $data = filter_input(INPUT_POST, "dataur");
    $miejscowosc = filter_input(INPUT_POST, "miejscowosc");

    $telefon = filter_input(INPUT_POST, "telefon");
    if (ctype_alnum($telefon == false) || strlen($telefon) < 9)
        $OK = false;

    if (!isset($_POST['regulamin']))
        $OK = false;

    if ($OK === true) {
        $location=null;
        if(isset($_FILES['zdjecie'])){
            $nazwa="../data/users/aw".$login;
            $ext=pathinfo($_FILES['zdjecie']['name'], PATHINFO_EXTENSION);
            if($ext!="jpg" && $ext!="png" && $ext!="gif"){
                echo "1";
                return false;
            }
            $location=$nazwa.".".$ext;
            require_once "../model/lib/WideImage.php";
            WideImage::load($_FILES['zdjecie']['tmp_name'])->resize(128, 128)->saveToFile($location);
        }

        $date = date("Y-m-d H:i:s");
        $kolumny=["imie", "nazwisko", "login", "haslo", "data", "miejscowosc", "email", "telefon", "data_wst", "typ", "awatar"];
        $wartosci=[$imie, $nazwisko, $login, $haslo_hash, $data, $miejscowosc, $email, $telefon, $date, 0, $location];
        $DB->dodaj($tabela, $kolumny, $wartosci);
        echo "0";
        return true;
    }
}
?>