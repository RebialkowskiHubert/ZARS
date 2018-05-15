<?php
if(!isset($user) || $user->typ!=1)
    exit();
?>
<section id="start" style="text-align: center;">
    <h1 id="imie" class="wejscie">Witaj <?= $user->imie ?>!</h1>
    <h2 id="today" class="wejscie">Dzisiaj jest 
        <?php
        $dzien = date('d');
        $dzien_tyg = date('l');
        $miesiac = date('n');
        $rok = date('Y');

        $miesiac_pl = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia');

        $dzien_tyg_pl = array('Monday' => 'poniedziałek', 'Tuesday' => 'wtorek', 'Wednesday' => 'środa', 'Thursday' => 'czwartek', 'Friday' => 'piątek', 'Saturday' => 'sobota', 'Sunday' => 'niedziela');

        echo $dzien_tyg_pl[$dzien_tyg] . ", " . $dzien . " " . $miesiac_pl[$miesiac] . " " . $rok . " roku";
        ?>
    </h2>
    <h2 id="liczbaus" class="wejscie">Z systemu korzysta <span id="liczbauz"></span> użytkowników</h2>
    <h2 id="nieprzeczytane" class="wejscie"></h2>
</section>