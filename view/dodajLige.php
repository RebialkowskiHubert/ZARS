<?php
if(!isset($user) || $user->typ!=1)
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnelig" tabindex="-1" role="dialog" aria-labelledby="Dodaj ligę" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title" id="tytlig">Dodawanie ligi</h3>
            </div>
            <form method="post" id="formlig">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Nazwa ligi:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="nazwalig" id="nazwalig" placeholder="Wpisz nazwę ligi" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Kraj:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="krajlig" id="krajlig" placeholder="Wpisz kraj ligi" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Poziom:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="poziomlig" id="poziomlig" placeholder="Wpisz poziom ligi" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Wybierz sezon:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select name="sezonlig" id="sezonlig" class="form-control formularz">
                            <?php
                            $sezony=$DB->wybierz("sezony", "*", "all", null, null, "id_sezon DESC");
                            foreach($sezony as $sezon){
                                echo ''.
                                '<option value="'.$sezon["id_sezon"].'">'.$sezon["rok_rozpoczecia"].' - '.$sezon["rok_zakonczenia"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="dodlig" value="Dodaj"/>
                            <input type="hidden" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="edlig" value="Zatwierdź"/>
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