<div id="goscdyscypliny" class="podstrona">
    <?php
    require_once '../model/DB.php';
    $DB=new DB();
    require_once 'dyscypliny.php'; 
    ?>
</div>

<main id="gosc" class="podstrona">
    <nav class="pasek-boczny pomarancz odstep" style="z-index:3;width:200px;font-weight:bold;">
            <h3 class="odstep-64"><b>Panel główny</b></h3>
            <button class="przycisk" id="linkdisc">Dyscypliny</button> 
            <button class="przycisk" id="linkstadium">Obiekty</button> 
            <button class="przycisk" id="linkteams">Drużyny</button>
            <button class="przycisk" id="linkleague">Ligi</button>
            <button class="przycisk" id="linkplayer">Zawodnicy</button> 
        </div>
    </nav>

    <div style="margin-left:240px;margin-right:40px">
        <?php
        require_once 'ligi.php';
        require_once 'zawodnicy.php';
        require_once 'obiekty.php';
        require_once 'druzyny.php';
        ?>
    </div>
</main>