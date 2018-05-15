<link rel="stylesheet" href="../css/rejestracja.css"/>
<div class="modal fade" id="modalnemecz" tabindex="-1" role="dialog" aria-labelledby="Dodaj mecz" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title" id="tytsez">Panel meczowy</h3>
            </div>

            <form method="post" id="formmecz">
                <div class="container-fluid">
                    <div class="row">
                        <h2 style="text-align: center;" id="meczkolejki"></h2>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <img id="imgdruzynaA"/>
                        </div>

                        <div class="col-xs-6">
                            <img id="imgdruzynaB" style="float: right;"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <h3 id="druzynaA"></h3>
                        </div>

                        <div class="col-xs-6">
                            <h3 style="text-align: right;" id="druzynaB"></h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <p>Zdobyte gole</p>
                        </div>

                        <div class="col-xs-6">
                            <p style="text-align: right;">Zdobyte gole</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-2">
                            <input id="goldr1" name="goldr1" type="number" min="0" max="20" value="0" style="text-align: center;"
                            <?php  
                                if(!isset($user))
                                    echo 'readonly';
                            ?>/>
                        </div>
                        <div class="col-xs-8"></div>
                        <div class="col-xs-2">
                            <input id="goldr2" name="goldr2" type="number" min="0" max="20" value="0"  style="text-align: center;"
                            <?php  
                                if(!isset($user))
                                    echo 'readonly';
                            ?>/>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 3%;">
                        <div class="col-xs-5" id="bramkidr1"></div>
                        <div class="col-xs-1"></div>
                        <div class="col-xs-5"  id="bramkidr2"></div>
                    </div>

                    <?php if(isset($user)) echo '
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="button" class="form-control btn btn-success formularz" style="margin-top: 2%;" id="dodmecz">Zatwierdź</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group"> 
                                <input type="button" class="form-control btn btn-danger formularz" data-dismiss="modal" value="Anuluj"/>
                            </div>
                        </div>
                    </div>';?>
                </form>
            </div>
        </div>
    </div>
</div>