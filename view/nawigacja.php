<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll">
                <img src="../img/logoc.png" width="20px"/>
            </a>
            <a class="navbar-brand page-scroll">ZARS</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li><a id="tdys"></a></li>
                <li><a href="#" data-toggle="modal" data-target="#modalneed" style="outline: 0;">
                    <div id="obrazekuzytkownika">
                        <?php
                        $zr="";
                        ($user->awatar!==null)? $zr=$user->awatar : $zr="../img/nouser.jpg";
                        ?>
                        <img src="<?=$zr;?>" class="img-responsive imageuser" id="imguser"/>
                    </div>
                    <div id="imieuzytkownika"><?=$user->imie;?></div>
                </a></li>
                <li><a href="../controller/logout.php"><span class="glyphicon glyphicon-log-out"></span> Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>