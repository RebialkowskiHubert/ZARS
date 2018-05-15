<section id="ligi" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Ligi</h1></div>
            <?php
            if (isset($user) && $user->typ == 1)
                echo '
            <div class="col-md-6"></div>
            <div class="col-md-3"><button class="btn btn-lg btn-success" id="nowalig"><span class="fa fa-plus"></span> Dodaj ligę</button></div>';
            ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table id="tablig" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nazwa&nbsp;ligi</th>
                        <th>Kraj</th>
                        <th>Poziom</th>
                        <th>Sezon</th>
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
require_once 'liga.php';

if(isset($user) && $user->typ==1)
    require_once 'dodajLige.php';
?>