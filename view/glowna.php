<?php
require_once "../model/DB.php";
require_once "logowanie.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <link href="../css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../css/font-awesome.css" rel="stylesheet"/>
    <link href="../css/creative.css" rel="stylesheet"/>

    <link rel="shortcut icon" href="../img/favicon.ico"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <title>ZARS</title>
</head>
<body id="page-top">
    <div class="container" id="ciastko" hidden>
        <div id="ciastk">
            <span id="spc">&#10006</span>
            <h3 id="tytcook">Strona wykorzystuje pliki cookies.</h3>
            <p>W ramach naszej witryny stosujemy pliki cookies w celu świadczenia Państwu usług na najwyższym poziomie, w tym w sposób dostosowany do indywidualnych potrzeb. Korzystanie z witryny bez zmiany ustawień dotyczących cookies oznacza, że będą one zamieszczane w Państwa urządzeniu końcowym. Możecie Państwo dokonać w każdym czasie zmiany ustawień dotyczących cookies.</p>
        </div>
    </div>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <img src="../img/logoc.png" width="20px"/>
                </a>
                <a class="navbar-brand page-scroll" href="#page-top" id="backglowna">ZARS</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a class="page-scroll" href="#about">Dlaczego my?</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Lista kroków</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#test">Sprawdź</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Kontakt</a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a id="tdys"></a></li>
                    <li><a data-toggle="modal" data-target="#modalnerej"><span class="glyphicon glyphicon-user"></span> Zarejestruj</a></li>
                    <li><a data-toggle="modal" data-target="#modalnelog"><span class="glyphicon glyphicon-log-in"></span> Zaloguj</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="startowa">
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">System informatyczny zarządzający amatorskimi rozgrywkami sportowymi.</h1>
                    <hr>
                    <p>Zainteresowany? Zobacz, co oferujemy.</p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">Przejdź dalej</a>
                    <br/><br/>
                    <p>lub</p>
                    <a class="btn btn-primary btn-xl page-scroll linkguest">Zobacz statystyki</a>
                </div>
            </div>
        </header>

        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Mamy to, czego potrzebujesz!</h2>
                        <hr class="light center-block">
                        <p class="text-faded">
                            Chcesz zorganizować rozgrywki sportowe w swojej miejscowości,<br/>ale nie wiesz jak to zrobić?
                            Jednak może jesteś trenerem i chciałbyś wykonywać swoje czynności zdalnie?
                            Nasz system rozwiąże Twoje problemy.
                        </p>
                        <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Zaczynajmy!</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Lista kroków, które pomogą Tobie skorzystać z Systemu.</h2>
                        <hr class="primary center-block">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-wifi text-primary sr-icons"></i>
                            <h3>Zarejestruj się</h3>
                            <p class="text-muted">Rejestracja zajmie Ci tylko kilka chwil.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-soccer-ball-o text-primary sr-icons"></i>
                            <h3>Wybierz dyscyplinę</h3>
                            <p class="text-muted">Oferujemy wiele dyscyplin drużynowych.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-table text-primary sr-icons"></i>
                            <h3>Podglądaj statystyki</h3>
                            <p class="text-muted">Serwis poinformuje Cię o najnowszych osiągnięciach Twojej drużyny.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-thumbs-up text-primary sr-icons"></i>
                            <h3>Lubię to!</h3>
                            <p class="text-muted">Nasz system dostarczy Ci wiele satysfakcji.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-primary" id="test">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2>Zanim podejmiesz decyzję, sprawdź i przekonaj się</h2>
                    <a class="btn btn-default btn-xl sr-button linkguest">Przetestuj za darmo</a>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Kontakt</h2>
                        <hr class="primary center-block">
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-phone fa-3x sr-button"></i>
                        <p>123-456-6789</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-envelope-o fa-3x sr-button"></i>
                        <p><a href="mailto:8914@pwsz.wloclawek.pl">8914@pwsz.wloclawek.pl</a></p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-envelope-o fa-3x sr-button"></i>
                        <p><a href="mailto:8922@pwsz.wloclawek.pl">8922@pwsz.wloclawek.pl</a></p>
                    </div>
                </div>
            </div>
        </section>

        <div class="container-fluid text-center" id="kont">
            <div class="container">
                <div class="row">
                    <h1 id="pyt">Masz pytanie?! Zadaj je!</h1>
                </div>
                <div class="row">
                    <form method="post" id="wiadomosc">
                        <div class="col-xs-12">
                            <div class="form-vertical">
                                <div class="form-group">
                                    <input class="form-control" id="nickwiad" name="nickwiad" placeholder="Nick" required/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="email" id="emailwiad" name="emailwiad" placeholder="Email" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-vertical">
                                <textarea rows="6" class="form-control" id="wiad" name="wiad" placeholder="Treść wiadomości" required></textarea>
                            </div>    
                        </div>
                        <div class="col-xs-3"></div>
                        <div class="col-xs-6">
                            <button type="submit" class="form-control btn btn-default sr-button" id="send">Wyślij</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="stopka">
            <p id="stopkap">Copyright&copy; 2017 Hubert Rębiałkowski, Jakub Wyrwa</p>
        </div>
    </div>

    <?php
    require_once "rejestracja.php";
    require_once 'alert.php';
    require_once "../controller/js_include.php";
    ?>
    <script src="../js/customindex.js"></script>
    <script src="../js/scrollreveal.js"></script>
    <script src="../js/grafikaindex.js"></script>

    <?php require_once "gosc.php";?>
</body>
</html>