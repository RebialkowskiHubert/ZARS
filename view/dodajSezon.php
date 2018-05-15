<?php
if(!isset($user) || $user->typ!=1)
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnesez" tabindex="-1" role="dialog" aria-labelledby="Dodaj sezon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title" id="tytsez">Dodawanie sezonu</h3>
            </div>
            <form method="post" id="formsez">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Rok rozpoczęcia sezonu:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="startsez" id="startsez" placeholder="Wpisz rok rozpoczęcia sezonu." required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Rok zakończenia sezonu:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="stopsez" id="stopsez" placeholder="Wpisz rok zakończenia sezonu." required/>
                    </div>
                </div>
                
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="dodsez" value="Dodaj"/>
                            <input type="hidden" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="edsez" value="Zatwierdź"/>
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