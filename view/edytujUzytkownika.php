<?php
if(!isset($user))
    exit();
?>
<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalneed" tabindex="-1" role="dialog" aria-labelledby="Edytuj" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet" style="background-color: white;">
            <div class="modal-header">
                <h3 class="modal-title" style="color: black;">Edytuj dane</h3>
            </div>
            <form method="post" id="formedycja">
                <input type="hidden" name="id" id="iduser" value="<?php echo $user->id_uzytkownik;?>"/>
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Imię:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="imie" id="imie" placeholder="Wpisz imię" value="<?php
                        echo $user->imie;
                        ?>" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Nazwisko:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="nazwisko" id="nazwisko" placeholder="Wpisz nazwisko" value="<?php
                               echo $user->nazwisko;
                        ?>" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Hasło:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="password" class="form-control formularz" id="haslo1" name="haslo1" placeholder="Wpisz hasło" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Potwierdź hasło:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="password" class="form-control formularz" id="haslo2" name="haslo2" placeholder="Wpisz ponownie hasło" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Data urodzenia:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="date" name="data" id="dataur" placeholder="Wpisz datę urodzenia" value="<?php
                        echo $user->data;
                        ?>" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Miejscowość:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" id="miejscowosc" name="miejscowosc" placeholder="Wpisz miejscowosc" value="<?php
                        echo $user->miejscowosc;
                        ?>" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">E-mail:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="email" name="email" id="email" placeholder="Wpisz email" value="<?php
                        echo $user->email;
                        ?>" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Telefon:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="tel" name="telefon" id="telefon" placeholder="Wpisz telefon" value="<?php
                        echo $user->telefon;
                        ?>"/>                            
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Awatar:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="file" name="zdjecie" id="zdjecie"/>
                        <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>
                    </div>
                </div>

                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group"> 
                            <button type="submit" class="form-control btn btn-success formularz" id="okedyt">ZATWIERDŹ</button>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group"> 
                            <button type="button" data-dismiss="modal" class="form-control btn btn-danger formularz">ANULUJ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>