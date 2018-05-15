<script src="https://maps.google.com/maps/api/js?key=AIzaSyCKl_XbYZ6UKgwPTeswb13Qgr8qINvNMdw"></script>
<section id="obiekty" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Obiekty</h1></div>
            <?php
            if (isset($user) && $user->typ == 1)
                echo '
            <div class="col-md-6"></div>
            <div class="col-md-3"><button class="btn btn-lg btn-success" id="nowystad"><span class="fa fa-plus"></span> Dodaj obiekt</button></div>';
            ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table id="tabstad" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nazwa&nbsp;obiektu</th>
                        <th>Miasto</th>
                        <th>Rok&nbsp;powstania</th>
                        <th>Pojemność</th>
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
require_once 'obiekt.php';
if(isset($user) && $user->typ==1)
    require_once 'dodajobiekt.php';
?>