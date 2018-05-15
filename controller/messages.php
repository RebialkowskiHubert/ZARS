<?php
header("Content-type: application/json");
session_start();
require_once "../model/DB.php";
$DB=new DB();
$tabela="wiadomosci_przychodzace";
$login=$_SESSION["login"];
$war=["login", $login, "|", "id_uzytkownik", $login];
$user=$DB->wybierz("uzytkownicy", "*", "obj", $war, null, null);
$data=array();
$i=0;

if(filter_has_var(INPUT_POST, "wys")){
    $war=["od", $user->id_uzytkownik];
    $wiadomosci=$DB->wybierz("wiadomosci_wychodzace", ["id_wiad", "data_wiad", "do"], "all", $war, null, "data_wiad DESC");

    foreach ($wiadomosci as $wiadomosc) {
        $war=["login", $wiadomosc["do"], "|", "id_uzytkownik", $wiadomosc["do"]];
        $uzytkownik=$DB->wybierz("uzytkownicy", "*", "obj", $war, null, null);
        $login=$uzytkownik->login;
        $para=array('login'=>$login);
        $data[]=$wiadomosc;
        array_push($data[$i], $para);
        $i++;
    }
}
else{

    if($user->typ==1){        
        $wiadomosci = $DB->wybierz($tabela, ["id_wiad", "nick", "email_wiad", "data_wiad", "przeczytana"], "all", null, " WHERE do=".$user->id_uzytkownik." OR do=0", "data_wiad DESC");
    }
    
    else{
        $war=["do", $user->id_uzytkownik];
        $wiadomosci = $DB->wybierz($tabela, ["id_wiad", "nick", "email_wiad", "data_wiad", "przeczytana"], "all", $war, null, "data_wiad DESC");
    }

    foreach ($wiadomosci as $wiadomosc) {
        $data[]=$wiadomosc;
    }
}
echo json_encode($data);
?>