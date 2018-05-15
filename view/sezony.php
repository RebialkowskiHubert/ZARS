<section id="sezony" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Sezony</h1></div>
            <?php
            if ($user->typ == 1)
                echo '
            <div class="col-md-6"></div>
            <div class="col-md-3"><button class="btn btn-lg btn-success" id="nowysez"><span class="fa fa-plus"></span> Dodaj sezon</button></div>';
            ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table id="tabsez" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Rok&nbsp;rozpoczęcia</th>
                        <th>Rok&nbsp;zakończenia</th>
                        <th>Edytuj</th>
                        <th>Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php 
if(isset($user) && $user->typ==1)
    require_once 'dodajSezon.php';
?>