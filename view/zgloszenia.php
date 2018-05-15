<?php
if(!isset($user))
    exit();
?>
<section id="zgloszenia" class="podstrona">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><h1>Zgłoszenia</h1></div>
        </div>
    </div>

    <ul class="nav nav-tabs zakladki" role="tablist">
        <li class="active"><a role="tab" data-toggle="tab" href="#zgzaw" id="linkzaw">Zgłoszenia zawodników</a></li>
        <li><a role="tab" data-toggle="tab" href="#zgdruz" id="linkdruz">Zgłoszenia drużyn</a></li>
    </ul>

    <div class="container-fluid">
        <div class="tab-content">
            <div class="tab-pane active" id="zgzaw">
                <div class="table-responsive">
                    <table id="tabzgzaw" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Zgłaszający</th>
                                <th>Imię</th>
                                <th>Nazwisko</th>
                                <th>Drużyna</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane" id="zgdruz">
                <div class="table-responsive">
                    <table id="tabzgdruz" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Zgłaszający</th>
                                <th>Nazwa&nbsp;drużyny</th>
                                <th>Rok&nbsp;założenia</th>
                                <th>Miasto</th>
                                <th>obiekt</th>
                                <th>Liga</th>
                                <th>Akceptuj</th>
                                <th>Odrzuć</th>
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