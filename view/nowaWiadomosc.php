<?php
if(!isset($user))
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnewiad" tabindex="-1" role="dialog" aria-labelledby="Nowa wiadomość" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet" class="modalne">
            <div class="modal-header">
                <h3 class="modal-title">Nowa wiadomość</h3>
            </div>
            <form method="post" id="formwiad">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Do:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control" name="dokogo" id="dokogo" placeholder="Wpisz login użytkownika, do którego chcesz napisać" style="margin-left: 4%; width: 70%;" required/>
                        <div id="wiadimg"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12" id="bllogin2"></div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Treść wiadomości:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea class="form-control formularz" style="margin-bottom: 2%;" rows="8" name="wiad" id="wiad" placeholder="Treść Twojej wiadomości"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group">
                            <input type="hidden" name="nickwiad" value="<?=$user->login?>"/>
                            <input type="hidden" name="emailwiad" value="<?=$user->email?>"/>
                            <input type="hidden" name="odkogo" value="<?=$user->id_uzytkownik?>"/>
                            <button type="submit" class="form-control btn btn-success formularz" id="wyslij">WYŚLIJ</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group"> 
                            <input type="button" class="form-control btn btn-danger formularz" data-dismiss="modal" value="ANULUJ"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>