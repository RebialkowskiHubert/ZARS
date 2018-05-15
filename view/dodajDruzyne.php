<?php
if(!isset($user))
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnedruz" tabindex="-1" role="dialog" aria-labelledby="Dodaj drużynę" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title" id="tytdruz">Zgłoszenie drużyny</h3>
            </div>
            <form method="post" id="formdruz">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Nazwa drużyny:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="nazwadruz" id="nazwadruz" placeholder="Wpisz nazwę drużyny" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Rok założenia:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="rokdruz" id="rokdruz" placeholder="Wpisz rok założenia drużyny" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Miasto:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="miastodruz" id="miastodruz" placeholder="Wpisz nazwę miasta drużyny" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Wybierz obiekt:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select name="obiektdruz" id="obiektdruz" class="form-control formularz">
                            <?php
                            $obiekty=$DB->wybierz("obiekty", "*", "all", null, null, "id_obiekt DESC");
                            foreach($obiekty as $obiekt){
                                echo ''.
                                '<option value="'.$obiekt["id_obiekt"].'">'.$obiekt["nazwa_obiekt"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Wybierz ligę:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select name="ligadruz" id="ligadruz" class="form-control formularz">
                            <?php
                            $ligi=$DB->wybierz("ligi", "*", "all", null, null, "id_liga DESC");
                            foreach($ligi as $liga){
                                echo ''.
                                '<option value="'.$liga["id_liga"].'">'.$liga["nazwa_liga"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Logo:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control formularz" type="file" name="logo" id="logo" accept="image/*" />
                        <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>
                    </div>
                </div>
                
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="doddruz" value="Dodaj"/>
                            <input type="hidden" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="eddruz" value="Zatwierdź"/>
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