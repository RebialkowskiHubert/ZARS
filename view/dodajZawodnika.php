<?php
if(!isset($user))
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnezaw" tabindex="-1" role="dialog" aria-labelledby="Dodaj zawodnika" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title" id="tytzaw">Zgłoszenie zawodnika</h3>
            </div>
            <form method="post" id="formzaw">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Imię:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="imiezaw" id="imiezaw" placeholder="Wpisz imię" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Nazwisko:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="nazwiskozaw" id="nazwiskozaw" placeholder="Wpisz nazwisko" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Data&nbsp;urodzenia:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="date" name="datazaw" id="datazaw" placeholder="Wpisz datę urodzenia" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Wybierz drużynę:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <select name="druzynazaw" id="druzynazaw" class="form-control formularz">
                            <?php
                            $druzyny=$DB->wybierz("druzyny", "*", "all", null, null, "id_druzyna DESC");
                            foreach($druzyny as $druzyna){
                                echo ''.
                                '<option value="'.$druzyna["id_druzyna"].'">'.$druzyna["nazwa_druzyna"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Początek&nbsp;kontraktu:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="date" name="startzaw" id="startzaw" placeholder="Wpisz datę początku kontraktu" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Koniec&nbsp;kontraktu:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="date" name="stopzaw" id="stopzaw" placeholder="Wpisz datę zakończenia kontraktu" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Waga:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="number" name="wagazaw" id="wagazaw" placeholder="Wpisz wagę zawodnika" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Wzrost:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="wzrostzaw" id="wzrostzaw" placeholder="Wpisz wzrost zawodnika" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Pozycja:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="pozycjazaw" id="pozycjazaw" placeholder="Wpisz pozycję zawodnika" required/>
                    </div>
                </div>

                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="dodzaw" value="Dodaj"/>
                            <input type="hidden" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="edzaw" value="Zatwierdź"/>
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