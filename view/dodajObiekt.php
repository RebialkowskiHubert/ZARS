<?php
if(!isset($user) || $user->typ!=1)
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnestad" tabindex="-1" role="dialog" aria-labelledby="Dodaj obiekt" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title" id="tytstad">Dodawanie obiektu</h3>
            </div>
            <form method="post" id="formstad">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Nazwa obiektu:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="nazwastad" id="nazwastad" placeholder="Wpisz nazwę obiektu" required/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Miasto:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="miastostad" id="miastostad" placeholder="Wpisz nazwę miasta, w którym się znajduje" required/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Rok powstania:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="rokstad" id="rokstad" placeholder="Wpisz rok powstania obiektu" required/>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Pojemność:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="pojstad" id="pojstad" placeholder="Wpisz pojemność" required/>
                    </div>
                </div>

                <div class="row">
                        <div class="col-xs-12">
                            <label class="lrej">Lokalizacja:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="mapka" class="form-control formularz maps"></div>
                        </div>
                    </div>

                    <div class="row">
                        <center>
                            <button type="button" class="btn btn-warning" id="resetMap">Kliknij, aby zresetować mapkę</button>
                        </center>
                    </div>
                
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="dodstad" value="Dodaj"/>
                            <input type="hidden" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="edstad" value="Zatwierdź"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group"> 
                            <input type="button" class="form-control btn btn-danger formularz" data-dismiss="modal" value="Anuluj"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>