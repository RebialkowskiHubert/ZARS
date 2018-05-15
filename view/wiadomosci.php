<?php
if(!isset($user))
    exit();
?>
<section id="wiadomosci" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Wiadomości</h1></div>
            <div class="col-md-6"></div>
            <div class="col-md-3"><button class="btn btn-lg btn-success" id="nowawiad"><span class="fa fa-plus"></span> Nowa wiadomość</button></div>
        </div>
    </div>

    <ul class="nav nav-tabs zakladki" role="tablist">
        <li class="active"><a role="tab" data-toggle="tab" href="#odb" id="linkodb">Odebrane</a></li>
        <li><a role="tab" data-toggle="tab" href="#wys" id="linkwys">Wysłane</a></li>
    </ul>

    <div class="container-fluid">
        <div class="tab-content">
            <div class="tab-pane active"  id="odb">
                <div class="table-responsive">
                    <table id="tabwiadodb" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nick</th>
                                <th>E-mail</th>
                                <th>Data&nbsp;wiadomości</th>
                                <th>Status</th>
                                <th>Usuń</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane" id="wys">
                <div class="table-responsive">
                    <table id="tabwiadwys" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Login</th>
                                <th>Data&nbsp;wiadomości</th>
                                <th>Usuń</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>