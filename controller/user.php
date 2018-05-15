<?php
if(filter_has_var(INPUT_POST, "get")){
    header("Content-type: application/json");
    require_once '../model/DB.php';
    $DB=new DB();
    $loginy=[];
    $users=$DB->wybierz("uzytkownicy", "login", "all", null, null, null);
    echo json_encode($users);
}

elseif(filter_has_var(INPUT_POST, "uzytkownik")){
    $user= filter_input(INPUT_POST, "uzytkownik");
    require_once '../model/DB.php';
    $DB=new DB();
    if($DB->usun("uzytkownicy",$user))
        echo 'Konto użytkownika zostało usunięte.';
    else
        echo 'Wystąpił błąd, przepraszamy za utrudnienia.';
}
else{
    $OK = true;
    $id = filter_input(INPUT_POST, "id");
    $imie = filter_input(INPUT_POST, "imie");
    $nazwisko = filter_input(INPUT_POST, "nazwisko");
    $haslo1 = filter_input(INPUT_POST, "haslo1");
    $haslo2 = filter_input(INPUT_POST, "haslo2");

    if ((strlen($haslo1) < 8) || (strlen($haslo1) > 20)) {
        $OK = false;
        $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków.";
    }

    if ($haslo1 != $haslo2) {
        $OK = false;
        $_SESSION['e_haslo'] = "Podane hasła nie są identyczne!";
    }

    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);

    $data = filter_input(INPUT_POST, "data");
    $miejscowosc = filter_input(INPUT_POST, "miejscowosc");
    $email = filter_input(INPUT_POST, "email");
    $email2 = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($email2, FILTER_VALIDATE_EMAIL) == false) || ($email2 != $email)) {
        $OK = false;
        $_SESSION['e_email'] = "Podaj poprawny adres e-mail";
    }

    $telefon = filter_input(INPUT_POST, "telefon");
    if (ctype_alnum($telefon == false) || strlen($telefon) < 8) {
        $OK = false;
        $_SESSION['e_telefon'] = "Podaj poprawny format telefonu";
    }

    if ($OK === true) {
        require_once "../model/DB.php";
        $DB = new DB();
        $warunki=["id_uzytkownik", $id];

        $login=$DB->wybierz("uzytkownicy", "login", "obj", $warunki, null, null);
        $location=null;
        if(isset($_FILES['zdjecie'])){
            $nazwa="../data/users/aw".$login->login;
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
        $kolumny=["imie", "nazwisko", "haslo", "data", "miejscowosc", "email", "telefon", "data_wst", "awatar"];
        $wartosci=[$imie, $nazwisko, $haslo_hash, $data, $miejscowosc, $email, $telefon, $date, $location];
        $DB->edytuj("uzytkownicy", $kolumny, $wartosci, $warunki);
        echo json_encode($DB->wybierz("uzytkownicy", "awatar", "obj", $warunki, null, null));
        return true;
    }
}
?>