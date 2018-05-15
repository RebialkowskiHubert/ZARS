$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "../controller/cookie.php",
        success: function(resp){
            if(resp==0)
                $('#ciastko').show();
        }
    });

    $('#spc').click(function(){
        $.ajax({
            type: "POST",
            url: "../controller/cookie.php",
            data: {ciastko: 1},
            success: function(resp){
                $('#ciastko').remove();
            }
        });
    });

    $('#wiadomosc').validate({
        rules: {
            nickwiad: "required",
            emailwiad: {
                required: true,
                email: true
            },
            wiad: "required"
        }
    });

    $('#formrej').validate({
        rules: {
            imie: "required",
            nazwisko: "required",
            login: "required",
            haslo1: {
                required: true,
                minlength: 8,
                maxlength: 20
            },
            haslo2: {
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo: "#haslo1"
            },
            dataur: "required",
            miejscowosc: "required",
            email1: {
                required: true,
                email: true
            },
            telefon: {
                number: true,
                minlength: 9
            },
            regulamin: "required"
        }
    });
    
    $('#formlogin').validate({
        rules: {
            loginn: "required",
            hasloo: "required"
        }
    });

    $('#wiadomosc').submit(function (e) {
        e.preventDefault();
        $('body').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');

        if ($('#wiadomosc').valid()) {

            var formularz = document.getElementById('wiadomosc');
            var fd = new FormData(formularz);

            $.ajax({
                type: "POST",
                url: "../controller/wyslijWiad.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#loading').remove();
                    $('.modal-body').text(resp);
                    $('#alert').modal('show');
                    $('#wiadomosc')[0].reset();
                },
                error: function (resp) {
                    $('#loading').remove();
                    alert(resp);
                    $('#wiadomosc')[0].reset();
                }
            });
        }
    });

    $('#login').change(function () {
        $('#modalnerej').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');
        var login = $('#login').val();
        $.ajax({
            type: "POST",
            url: "../controller/register.php",
            data: {login: login},
            success: function (resp) {
                $('#loading').remove();
                if (resp == "1") {
                    $('#bllogin').append("<p id='login2' style='color: red;'>Podany login jest już zajęty.</p>");
                    $('#wysylaj').attr('disabled', true);
                } else {
                    $('#login2').remove();
                    $('#wysylaj').attr('disabled', false);
                }
            }
        });
        $('#loading').remove();
    });

    $('#email1').change(function () {
        $('#modalnerej').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');
        var email1 = $('#email1').val();
        $.ajax({
            type: "POST",
            url: "../controller/register.php",
            data: {email1: email1},
            success: function (resp) {
                $('#loading').remove();
                if (resp == "2") {
                    $('#blemail').append("<p id='email2' style='color: red;'>Podany adres e-mail posiada już konto.</p>");
                    $('#wysylaj').attr('disabled', true);
                } else {
                    $('#email2').remove();
                    $('#wysylaj').attr('disabled', false);
                }
            }
        });
    });

    $('#wysylaj').click(function (e) {
        e.preventDefault();
        if ($('#formrej').validate()) {
            grecaptcha.execute();            
        }
    });

    $('#loginn').change(function(){
        $('#bllog').remove();
    })

    $('#hasloo').change(function(){
        $('#bllog').remove();
    })

    $('#wys').click(function (e) {
        e.preventDefault();
        $('#modalnelog').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');

        if ($('#formlogin').valid()) {

            var formularz = document.getElementById('formlogin');
            var fd = new FormData(formularz);

            $.ajax({
                type: "POST",
                url: "../controller/log_in.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#loading').remove();
                    if(resp=="1"){
                        $('.modal-body').text("Zalogowano pomyślnie");
                        $('#alert').modal('show');
                        window.location.href="admin.php";
                    }
                    if(resp=="0"){
                        $('.modal-body').text("Zalogowano pomyślnie");
                        $('#alert').modal('show');
                        window.location.href="uzytkownik.php";
                    }
                    if(resp=="-1"){
                        $('#blhasloo').append("<p id='bllog' style='color: red;'>Zły login lub hasło</p>");
                    }
                },
                error: function () {
                    $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                    $('#alert').modal('show');
                    $('#loading').remove();
                }
            });
        }
    });

    $('#modalnerej, #modalnelog').on('hidden.bs.modal', function(){
        if($('#gosc').is(':visible'))
            $('head').append('<link id="linkdt" href="../css/datatables.min.css" rel="stylesheet"/>');
    });

    $('a[data-target="#modalnerej"], a[data-target="#modalnelog"]').click(function(){
        $('#linkdt').remove();
    });

    $('.linkguest').click(function(){
        $('#startowa').hide();
        $('.navbar-left').hide();
        $('#goscdyscypliny').show();
        window.scrollTo(0, 0);
    });

    $('.dyscyplina').click(function(){
        $('#dyscypliny').hide();
        $('#gosc').show();
        $('#linkevent').click();
        $('head').append('<link id="linkdt" href="../css/datatables.min.css" rel="stylesheet"/>');
    });

    $('#linkdisc').click(function(){
        $('#linkdt').remove();
        $('#gosc').hide();
        $('#linkdt').remove();
        $('#dyscypliny').show();
    });

    $('#backglowna').click(function(){
        $('#linkdt').remove();
        $('#gosc').hide();
        $('#goscdyscypliny').hide();
        $('#startowa').show();
        $('#startowa section').show();
        $('.navbar-left').show();
    });


    $('#linkteams').click(function () {
        $('section').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('#druzyny').show();
        $.ajax({
            type: "POST",
            url: "../controller/team.php",
            data: {get: "get"},
            success: function(resp){
                $('#loading').remove();
                for(var i in resp){
                    var wiersz = resp[i];
                    $('#tabdruz tbody').append(''+
                        '<tr id="dr'+wiersz.id_druzyna+'">'+
                        '<td>'+wiersz.nazwa_druzyna+'</td>'+
                        '<td>'+wiersz.rok_zalozenia+'</td>'+
                        '<td>'+wiersz.miasto_druzyna+'</td>'+
                        '<td>'+wiersz.nazwa_obiekt+'</td>'+
                        '<td>'+wiersz.nazwa_liga+'</td>'+
                        '</tr>'
                        );
                }
                tabdruz=dataTable('#tabdruz');

            },
            error: function(resp){
                console.log(resp);
            }
        });
    });
    
    $('#linkstadium').click(function () {
        $('section').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('#obiekty').show();
        $.ajax({
            type: "POST",
            url: "../controller/stadium.php",
            data: {get: "get"},
            success: function(resp){
                $('#loading').remove();
                for(var i in resp){
                    var wiersz = resp[i];
                    $('#tabstad tbody').append(''+
                        '<tr id="st'+wiersz.id_obiekt+'">'+
                        '<td>'+wiersz.nazwa_obiekt+'</td>'+
                        '<td>'+wiersz.miasto_obiekt+'</td>'+
                        '<td>'+wiersz.rok_powstania+'</td>'+
                        '<td>'+wiersz.pojemnosc+'</td>'+
                        '</tr>'
                        );
                }
                tabstad=dataTable('#tabstad');

            },
            error: function(resp){
                console.log(resp);
            }
        });
    });

    $('#linkleague').click(function () {
        $('section').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('#ligi').show();
        $.ajax({
            type: "POST",
            url: "../controller/league.php",
            data: {get: "get"},
            success: function(resp){
                $('#loading').remove();
                for(var i in resp){
                    var wiersz = resp[i];
                    $('#tablig tbody').append(''+
                        '<tr id="li'+wiersz.id_liga+'">'+
                        '<td>'+wiersz.nazwa_liga+'</td>'+
                        '<td>'+wiersz.kraj+'</td>'+
                        '<td>'+wiersz.poziom+'</td>'+
                        '<td>'+wiersz.rok_rozpoczecia+' - '+wiersz.rok_zakonczenia+'</td>'+
                        '</tr>'
                        );
                }
                tablig=dataTable('#tablig');

            },
            error: function(resp){
                console.log(resp);
            }
        });
    });

    $('#linkplayer').click(function () {
        $('section').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('#zawodnicy').show();
        $.ajax({
            type: "POST",
            url: "../controller/player.php",
            data: {get: "get"},
            success: function(resp){
                $('#loading').remove();
                for(var i in resp){
                    var wiersz = resp[i];
                    $('#tabzaw tbody').append(''+
                        '<tr id="zw'+wiersz.id_zawodnik+'">'+
                        '<td>'+wiersz.imie+'</td>'+
                        '<td>'+wiersz.nazwisko+'</td>'+
                        '<td>'+wiersz.nazwa_druzyna+'</td>'+
                        '</tr>'
                        );
                }
                var tabzaw=dataTable('#tabzaw');

            },
            error: function(resp){
                console.log(resp);
            }
        });
    });

    $('#tabzaw tbody').on('click', 'tr', function(){
        var idzaw=this.id;
        var druzyna=$(this).find("td").eq(2).html();
        idzaw=idzaw.replace("zw", "");
        pokazZawodnik(idzaw, druzyna);
    });
});

function rejestruj(){
    $('#modalnerej').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');
    var form = document.getElementById('formrej');
    var fd = new FormData(form);

    $.ajax({
        type: "POST",
        url: "../controller/register.php",
        data: fd,
        processData: false,
        contentType: false,
        success: function (resp) {
            $('#loading').remove();
            if (resp == "0") {
                $('.modal-body').text("Zarejestrowano pomyślnie.");
                $('#alert').modal('show');
                $('#modalnerej').modal('toggle');
                $('#modalnelog').modal('toggle');
                $('#formrej')[0].reset();
            }
            else if(resp=="1"){
                $('.modal-body').text("Plik awatara nie jest obrazkiem.");
                $('#alert').modal('show');
            }
            
            else{
                $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                $('#alert').modal('show');
                console.log(resp);
            }
        },
        error: function (error) {
            $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
            $('#alert').modal('show');
            console.log(error);
            $('#loading').remove();
        }
    });
}