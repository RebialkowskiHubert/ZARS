<section id="zawodnicy" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Zawodnicy</h1></div>
            <?php
            if(isset($user))
                echo '
            <div class="col-md-6"></div>
            <div class="col-md-3">
                <button class="btn btn-lg btn-success" id="nowyzaw">
                    <span class="fa fa-plus"></span> Zgłoś zawodnika
                </button>
            </div>';
            ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table id="tabzaw" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Drużyna</th>
                        <?php
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
    require_once 'dodajZawodnika.php'; 
require_once 'zawodnik.php'; 
?>