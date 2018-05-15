<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade modalne" id="modalnerej" tabindex="-1" role="dialog" aria-labelledby="Zarejestruj" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet" style="background-color: white;">
            <div class="modal-header">
                <h3 class="modal-title">Dołącz do nas, zarejestruj się</h3>
            </div>
            <form method="post" id="formrej">                        
                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Imię:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="imie" id="imie" placeholder="Wpisz imię" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Nazwisko:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" name="nazwisko" id="nazwisko" placeholder="Wpisz nazwisko" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Login:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" id="bllogin">
                        <input class="form-control formularz" id="login" name="login" placeholder="Wpisz login" required/>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Hasło:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" id="blhaslo1">
                        <input type="password" class="form-control formularz" name="haslo1" id="haslo1" placeholder="Wpisz hasło" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Potwierdź hasło:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" id="blhaslo2">
                        <input type="password" class="form-control formularz" name="haslo2" id="haslo2" placeholder="Wpisz ponownie hasło" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Data urodzenia:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="date" name="dataur" id="dataur" placeholder="Wpisz datę urodzenia" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Miejscowość:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" id="miejscowosc" name="miejscowosc" placeholder="Wpisz miejscowosc" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">E-mail:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" id="blemail">
                        <input class="form-control formularz" type="email" name="email1" id="email1" placeholder="Wpisz email" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Telefon:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" id="bltel">
                        <input class="form-control formularz" type="tel" name="telefon" id="telefon" placeholder="Wpisz telefon"/>     
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label class="lrej">Awatar:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <input class="form-control formularz" type="file" name="zdjecie" id="zdjecie" accept="image/*" />
                        <input type="hidden" name="MAX_FILE_SIZE" value="512000"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label class="lrej"><input type="checkbox" name="regulamin" id="regulamin" required/> Wyrażam zgodę na przetwarzanie danych osobowych w celu realizacji funkcji systemu.</label>
                        </div>
                    </div>
                </div>

                <div id="recaptcha" class="g-recaptcha" 
                data-sitekey="6LdsVy8UAAAAAGbfcJDhkOhC5aRGMw5oAADFuCtf" 
                data-callback="rejestruj" 
                data-size="invisible"></div>

                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group"> 
                            <input type="submit" class="form-control btn btn-success formularz" id="wysylaj" value="ZAREJESTRUJ"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class='col-xs-12'>
                        <div class="form-group"> 
                            <button type="button" class="form-control btn btn-danger formularz" data-dismiss="modal">ANULUJ</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>