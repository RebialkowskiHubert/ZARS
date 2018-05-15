<div class="modal fade modalne" id="modalnelog" tabindex="-1" role="dialog" aria-labelledby="Zaloguj" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-contnet">
            <div class="modal-header">
                <h3 class="modal-title">Zaloguj do serwisu</h3>
            </div>
            <form class="form-horizontal" method="post" id="formlogin">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <center><img src="../img/login.png"/></center>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Login:</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="loginn" id="loginn" placeholder="Wpisz login" required>
                                    </div>
                                </div>
                                <div class="form-group" id="blhasloo">
                                    <label class="control-label col-sm-2">Hasło:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="hasloo" id="hasloo" placeholder="Wpisz hasło" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="wys">Zaloguj</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Anuluj</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>