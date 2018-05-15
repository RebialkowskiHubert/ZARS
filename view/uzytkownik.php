<?php
session_start();
require_once "../model/DB.php";

if (isset($_SESSION["login"])) {
    $DB = new DB();
    $war=["login", $_SESSION["login"], "|", "id_uzytkownik", $_SESSION["login"]];
    $user=$DB->wybierz("uzytkownicy", "*", "obj", $war, null, null);
    $typ = $user->typ;

    if ($typ != 0)
        header("Location: ../view/admin.php");
} else
header("Location: ../index.php");
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../css/font-awesome.css" rel="stylesheet"/>
    <link href="../css/creative.css" rel="stylesheet"/>      

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Panel użytkownika</title>
</head>
<body>
    <?php 
    require_once 'dyscypliny.php';
    require_once 'nawigacja.php';
    ?>

    <input type="hidden" id="identuser" value="<?=$user->id_uzytkownik;?>"/>

    <div id="panelgl" class="podstrona">
        <nav class="pasek-boczny pomarancz odstep" style="z-index:3;width:200px;font-weight:bold;">
            <h3 class="odstep-64"><b>Panel główny</b></h3>
            <button class="przycisk" id="linkstart">Start</button>
            <button class="przycisk" id="linkdisc">Dyscypliny</button>
            <button class="przycisk" id="linkmess">Wiadomości</button> 
            <button class="przycisk" id="linkstadium">Obiekty</button> 
            <button class="przycisk" id="linkteams">Drużyny</button>
            <button class="przycisk" id="linkleague">Ligi</button>
            <button class="przycisk" id="linkplayer">Zawodnicy</button> 
        </nav>

        <div style="margin-left:240px;margin-right:40px">
            <?php
            require_once 'uzytkownikStart.php';            
            require_once 'wiadomosci.php';
            require_once 'wiadomosc.php';
            require_once 'nowaWiadomosc.php';
            require_once 'obiekty.php';
            require_once 'druzyny.php';
            require_once 'ligi.php';
            require_once 'zawodnicy.php';
            ?>
        </div>
    </div>
    <?php
    require_once 'edytujUzytkownika.php';
    require_once 'alert.php';
    require_once '../controller/js_include.php';
    ?>


    <script src="../js/datatables.min.js"></script>
    <script src="../js/zalogowany.js"></script>
    <script src="../js/uzytkownik.js"></script>
</body>
</html>