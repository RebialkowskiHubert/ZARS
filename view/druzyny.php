<section id="druzyny" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Drużyny</h1></div>
            <?php
            if(isset($user))
                echo '
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn btn-lg btn-success" id="nowadruz">
                    <span class="fa fa-plus"></span> Zgłoś drużynę
                </button>
            </div>';
            ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table id="tabdruz" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nazwa&nbsp;drużyny</th>
                        <th>Rok&nbsp;założenia</th>
                        <th>Miasto</th>
                        <th>obiekt</th>
                        <th>Liga</th>
                        <?php
                        if(isset($user))
                            echo '<th>Ulubiona</th>';
                        
                        if(isset($user) && $user->typ==1)
                            echo '
                        <th>Edytuj</th>
                        <th>Usuń</th>';
                        ?>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</section>
<?php
if(isset($user))
    require_once 'dodajDruzyne.php';
require_once 'druzyna.php';
?>