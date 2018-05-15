var tabwiadodb, tabwiadwys, tabdruz, tablig;
$(document).ready(function () {

    $('#imie').fadeIn(6000);
    $('#today').fadeIn(6000);
    $('#stoper').fadeIn(6000);
    
    licznikWiad();

    $('#linkstart').click(function () {
        licznikWiad();
        $('section').hide();
        $('#start').show();
    });

    $('#linkmess').click(function () {
        $('section').hide();
        $('#wiadomosci').show();
    });

    $("#linkodb, #linkmess").click(function(){
        $("#tabwiadodb tbody").empty();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "GET",
            url: "../controller/messages.php",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(resp){
                $('#loading').remove();
                for(var i in resp){
                    var wiersz=resp[i];
                    var status;
                    if(wiersz["przeczytana"]==0)
                        status="Nieprzeczytana";
                    else
                        status="Przeczytana";

                    $("#tabwiadodb tbody").append(""+
                        '<tr id="'+wiersz["id_wiad"]+'">'+
                        '<td>'+wiersz["nick"]+'</td>'+
                        '<td>'+wiersz["email_wiad"]+'</td>'+
                        '<td>'+wiersz["data_wiad"]+'</td>'+
                        '<td>'+status+'</td>'+
                        '<td><img src="../img/nok.svg" width="25" onclick="usunWiadomosc('+wiersz["id_wiad"]+');"/></td>'+
                        '</tr>'
                        );
                }
                tabwiadodb = dataTable("#tabwiadodb");
            },
            error: function(resp){
                console.log(resp);
            }
        });
    });

    $("#linkwys").click(function(){
        $("#tabwiadwys tbody").empty();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/messages.php",
            data: {wys: "wys"},
            success: function(resp){
                $('#loading').remove();
                for(var i in resp){
                    var wiersz=resp[i];

                    $('#tabwiadwys tbody').append(''+
                        '<tr id="'+wiersz["id_wiad"]+'">'+
                        '<td>'+wiersz[3].login+'</td>'+
                        '<td>'+wiersz["data_wiad"]+'</td>'+
                        '<td><img src="../img/nok.svg" width="25" onclick="usunWiadomoscWys('+wiersz["id_wiad"]+');"/></td>'+
                        '</tr>'
                        );
                }
                tabwiadwys = dataTable("#tabwiadwys");
            }
        });
    });

    $('.powrot').click(function () {
        $('section').hide();
        $('#wiadomosci').show();
    });

    $('#nowadruz').click(function () {
        $('#tytdruz').html("Zgłoszenie drużyny");
        $('#formdruz')[0].reset();
        $('#doddruz').show();
        $('#eddruz').attr('type', 'hidden');
        $('#iddruz').remove();
        $('#modalnedruz').modal('toggle');
    });

    $('#nowyzaw').click(function () {
        $('#tytzaw').html("Zgłoszenie zawodnika");
        $('#formzaw')[0].reset();
        $('#dodzaw').attr('type', 'submit');
        $('#edzaw').attr('type', 'hidden');
        $('#idzaw').remove();
        $('#modalnezaw').modal('toggle');
    });

    $('#formedycja').validate({
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
            }
        }
    });

    $("#okedyt").click(function (e) {
        e.preventDefault();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');

        if ($('#formedycja').valid()) {
            var form = document.getElementById("formedycja");
            var fd = new FormData(form);

            $.ajax({
                type: "POST",
                url: "../controller/user.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    if(resp=="1"){
                        $('.modal-body').text("Plik awatara nie jest obrazkiem.");
                        $('#alert').modal('show');
                    }
                    
                    else{
                        $('.modal-body').text("Zmiany przebiegły pomyślnie.");
                        $('#alert').modal('show');
                        $('#loading').remove();
                        $("#modalneed").modal('hide');
                        $('#imieuzytkownika').text(fd.get('imie'));

                        var src=JSON.parse(resp);
                        $('#imguser').attr("src", src.awatar);
                    }
                },
                error: function () {
                    $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                    $('#alert').modal('show');
                }
            });
        }
    });


    $('#tabwiadodb tbody').on('click', 'tr', function () {
        var id_wiad = (this.id);
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/odczytajWiad.php",
            data: {
                id_wiad: id_wiad,
                przych: '1'
            },
            success: function (resp) {
                $('#loading').remove();
                $('#wiadomosci').hide();
                $('#wiadomosc').show();

                var wiadomosc = JSON.parse(resp);
                $('#nadawca').html("Od: " + wiadomosc.nick);
                $('#emailnad').html(wiadomosc.email_wiad);
                $('#datanad').html("Data wysłania: " + wiadomosc.data_wiad);
                $('#tresc').html(wiadomosc.wiadomosc);
                statWiad(wiadomosc.id_wiad);
            }
        });
    });

    $('#tabwiadwys tbody').on('click', 'tr', function () {
        var id_wiad = (this.id);
        var nick = (this.cells[0].innerHTML),
        email = (this.cells[1].innerHTML);
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/odczytajWiad.php",
            data: {
                id_wiad: id_wiad,
                wych: '1'
            },
            success: function (resp) {
                $('#loading').remove();
                $('#wiadomosci').hide();
                $('#wiadomoscwys').show();

                var wiadomosc = JSON.parse(resp);
                $('#odbiorca').html("Do: " + nick);
                $('#emailodb').html(email);
                $('#dataodb').html("Data wysłania: " + wiadomosc.data_wiad);
                $('#tresc2').html(wiadomosc.wiadomosc);
            }
        });
    });

    $('#nowawiad').click(function () {
        $('#modalnewiad').modal('toggle');
    });

    var dokogo;
    $('#dokogo').change(function () {
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        var login = $('#dokogo').val();
        $.ajax({
            type: "POST",
            url: "../controller/sprLogin.php",
            data: {login: login},
            success: function (resp) {
                $('#loading').remove();
                if($('#imageuserw').length!=0)
                    $('#imageuserw').remove();

                if (resp == 'Brak użytkownika o podanym loginie.') {
                    $('#bllogin2').html("<p id='bllogin' style='color: red;'>" + resp + "</p>");
                    $('#wyslij').attr('disabled', true);
                } else {
                    var uz=JSON.parse(resp);
                    dokogo = uz.login;
                    $('#wiadimg').append('<img src="'+uz.awatar+'" id="imageuserw"/>');
                    $('#bllogin').remove();
                    $('#wyslij').attr('disabled', false);
                }
            }
        });
    });

    $('#formwiad').submit(function (e) {
        e.preventDefault();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        var form = document.getElementById('formwiad');
        var fd = new FormData(form);
        fd.append('dokogo', dokogo);
        $.ajax({
            type: "POST",
            url: "../controller/wyslijWiad.php",
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {
                $('#loading').remove();
                $('.modal-body').text("Wiadomość została wysłana pomyślnie.");
                $('#alert').modal('show');
                $('#modalnewiad').modal('toggle');

                var wiadomosc = JSON.parse(resp);
                var data = wiadomosc.data_wiad;
                var id_wiad = wiadomosc.id_wiad;
                var x = '<img src="../img/nok.svg" width="25" onclick="usunWiadomoscWys(' + id_wiad + ');"/>';
                tabwiadwys.row.add([$('#dokogo').val(), data, x]).node().id = id_wiad;
                tabwiadwys.draw(false);
            }
        });
    });

    $('#formzaw').validate({
        rules: {
            imiezaw: {
                required: true,
            },
            nazwiskozaw: {
                required: true,
            },
            datazaw: {
                required: true,
                date: true
            },
            startzaw: {
                required: true,
                date: true
            },
            stopzaw: {
                required: true,
                date: true
            },
            wagazaw: {
                required: true,
                range: [1, 300]
            },
            wzrostzaw: {
                required: true,
                range: [100, 250]
            },
            pozycja: {
                required: true,
            }
        }
    });

    $('#dodmecz').click(function(){
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        var forma=document.getElementById('formmecz');
        var fd=new FormData(forma);

        var mecz=$('#nrmecz').val();
        var iddruz1=$('#iddruz1').val();
        var iddruz2=$('#iddruz2').val();
        var idlig=$('#nrligi').val();
        var wynik=$('#wynik').text();
        if(wynik!='Mecz jescze się nie odbył'){
            var w=wynik.split(":");
            fd.append('golA1', w[0]);
            fd.append('golB1', w[1]);
        }

        fd.append('upd', '1');
        fd.append('idmecz', mecz);
        fd.append('iddruz1', iddruz1);
        fd.append('iddruz2', iddruz2);
        fd.append('idligi', idlig);
        $.ajax({
            type: "POST",
            url: "../controller/match.php",
            processData: false,
            contentType: false,
            data: fd,
            success: function(resp){
                $('#loading').remove();
                $('#modalnemecz').modal('hide');
                $('.modal-body').text("Mecz został zmodyfikowany.");
                $('#alert').modal('show');

                $('#wynik').empty();
                var a=$('#goldr1').val();
                var b=$('#goldr2').val();
                $('#wynik').append(a+" : "+b);
            }
        })
    });

    $('#generujspotkania').click(function(){
        var nrligi=$('#nrligi').val();
        $('#tabmatch tbody').empty();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');

        $.ajax({
            type: "POST",
            url: "../controller/timetable.php",
            data:{
                idliga: nrligi
            },
            success: function(resp){
                $('#loading').remove();
                $('.panellig').hide();
                var dane=JSON.parse(resp);
                var j=1;
                for(var i in dane){
                    var d=dane[i];

                    $('#tabmatch tbody').append(''+
                    '<tr>'+
                    '<td>'+j+'</td>'+
                    '<td>'+d[0]+'</td>'+
                    '<td>'+d[1]+' - '+d[2]+'</td>'+
                    '</tr>');
                    j++;
                }
                $('#tabelameczow').show();
            }
        });
    });

    $('#zapiszmecz').click(function(){
        var nrligi=$('#nrligi').val();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');

        $.ajax({
            type: "POST",
            url: "../controller/timetable.php",
            data:{
                idliga: nrligi,
                zatw: '1'
            },
            success: function(resp){
                $('#loading').remove();
                $('#mecze').click();
            }
        });
    });
});

function usunWiadomosc(wiadomosc) {
    var wiersz, dane;

    $('#tabwiadodb tbody tr').click(function(){
        wiersz = tabwiadodb.row(this);
        dane = tabwiadodb.row(this).data();
    });

    $('#tabwiadodb tbody tr td:last-child').on('click', function(e){
        e.stopPropagation();
    });
    if (confirm("Czy na pewno chcesz usunąć wiadomość?")) {
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/usunWiadomosc.php",
            data: {
                wiadomosc: wiadomosc,
                przych: '1'
            },
            success: function (resp) {
                $('#loading').remove();
                $('.modal-body').text(resp);
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}

function usunWiadomoscWys(wiadomosc) {
    var wiersz, dane;

    $('#tabwiadwys tbody tr').click(function(){
        wiersz = tabwiadodb.row(this);
        dane = tabwiadodb.row(this).data();
    });

    $('#tabwiadwys tbody tr td:last-child').on('click', function (e) {
        e.stopPropagation();
    });
    if (confirm("Czy na pewno chcesz usunąć wiadomość?")) {
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/usunWiadomosc.php",
            data: {
                wiadomosc: wiadomosc,
                wych: '1'
            },
            success: function (resp) {
                $('#loading').remove();
                $('.modal-body').text(resp);
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}

function statWiad(id) {
    var wiersz, dane;
    $('#tabwiadodb tbody').on('click', 'tr', function () {
        wiersz = tabwiadodb.row(this);
        dane = tabwiadodb.row(this).data();
        dane[3] = "Przeczytana";
        wiersz.data(dane).draw();
    });
    $.ajax({
        type: "POST",
        url: "../controller/statWiad.php",
        data: {id: id},
        success: function () {
            licznikWiad();
        }
    });
}

function licznikWiad() {
    $.ajax({
        type: "GET",
        url: "../controller/messages.php",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(resp){
            var licznik=0;
            for(var i in resp){
                var wiersz=resp[i];
                if(wiersz["przeczytana"]==0)
                    licznik++;
            }
            if (licznik != 0)
                $('#nieprzeczytane').html("Masz nie przeczytane " + licznik + " wiadomości.");
            else
                $('#nieprzeczytane').html("");
        }
    });
}

function ulubionaDruzyna(iddruz, iduser){
    $('body').append('<img id="loading" src="../img/loading.gif"');
    $.ajax({
        type: "POST",
        url: "../controller/team.php",
        data:{
            iddruz: iddruz,
            iduser: iduser,
            fav: "fav"
        },
        success: function(resp){
            $('#loading').remove();

            var gw=document.getElementById("dr"+iddruz).cells[5];
            $(gw).html('<img src="../img/goldstar.png" width="25" onclick="nieUlubionaDruzyna('+iddruz+', '+iduser+');"/>');
        }
    });

}

function nieUlubionaDruzyna(iddruz, iduser){
    $('body').append('<img id="loading" src="../img/loading.gif"');
    $.ajax({
        type: "POST",
        url: "../controller/team.php",
        data:{
            iddruz: iddruz,
            iduser: iduser,
            nfav: "nfav"
        },
        success: function(resp){
            $('#loading').remove();

            var gw=document.getElementById("dr"+iddruz).cells[5];
            $(gw).html('<img src="../img/greystar.png" width="25" onclick="ulubionaDruzyna('+iddruz+', '+iduser+');"/>');
        }
    });

}