<script>
    var markery=[], wsp=[];
    var tabusers, tabstad, tabdruz, tablig, tabsez, tabzaw, tabzgdruz, wiersz;
    $(document).ready(function () {

        $('#liczbaus').fadeIn(6000);
        $('#nieprzeczytane').fadeIn(6000);

        tabusers=dataTable('#tab');
        $('#liczbauz').html(tabusers.rows().count());

        $('#linkuser').click(function () {
            $('section').hide();
            $('#uzytkownicy').show();
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
                            '<td><img src="../img/ed.png" width="25" onclick="edytujobiekt('+wiersz.id_obiekt+');"/></td>'+
                            '<td><img src="../img/nok.svg" width="25" onclick="usunobiekt('+wiersz.id_obiekt+');"/></td>'+
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

        $('#linkteams').click(function () {
            $('section').hide();
            $('body').append('<img id="loading" src="../img/loading.gif"/>');
            $('#druzyny').show();
            var f=[];
            var fav;
            var idu=$('#iduser').val();
            $.ajax({
                type: "POST",
                url: "../controller/team.php",
                data: {
                    get: "get",
                    idu: idu
                },
                success: function(resp){
                    for(var i in resp){
                        f[i]=resp[i].id_druzyna;
                    }

                    $.ajax({
                        type: "POST",
                        url: "../controller/team.php",
                        data: {get: "get"},
                        success: function(resp2){
                            $('#loading').remove();
                            $('#tabdruz tbody').empty();

                            for(var j in resp2){
                                var wiersz=resp2[j];

                                if(f.length===0)
                                    fav='<td><img src="../img/greystar.png" width="25" onclick="ulubionaDruzyna('+wiersz.id_druzyna+', '+idu+');"/></td>';
                                else{
                                    for(var k in f){
                                        if(wiersz.id_druzyna==f[k]){
                                            fav='<td><img src="../img/goldstar.png" width="25" onclick="nieUlubionaDruzyna('+wiersz.id_druzyna+', '+idu+');"/></td>';
                                            break;
                                        }

                                        else{
                                            fav='<td><img src="../img/greystar.png" width="25" onclick="ulubionaDruzyna('+wiersz.id_druzyna+', '+idu+');"/></td>';
                                        }
                                    }
                                }

                                $('#tabdruz tbody').append(''+
                                    '<tr id="dr'+wiersz.id_druzyna+'">'+
                                    '<td>'+wiersz.nazwa_druzyna+'</td>'+
                                    '<td>'+wiersz.rok_zalozenia+'</td>'+
                                    '<td>'+wiersz.miasto_druzyna+'</td>'+
                                    '<td>'+wiersz.nazwa_obiekt+'</td>'+
                                    '<td>'+wiersz.nazwa_liga+'</td>'+
                                    fav+
                                    '<td><img src="../img/ed.png" width="25" onclick="edytujDruzyne('+wiersz.id_druzyna+');"/></td>'+
                                    '<td><img src="../img/nok.svg" width="25" onclick="usunDruzyne('+wiersz.id_druzyna+');"/></td>'+
                                    '</tr>'
                                    );
                            }
                            tabdruz=dataTable('#tabdruz');
                        }
                    });
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
                            '<td><img src="../img/ed.png" width="25" onclick="edytujLige('+wiersz.id_liga+');"/></td>'+
                            '<td><img src="../img/nok.svg" width="25" onclick="usunLige('+wiersz.id_liga+');"/></td>'+
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

        $('#linkseason').click(function () {
            $('section').hide();
            $('body').append('<img id="loading" src="../img/loading.gif"/>');
            $('#sezony').show();
            $.ajax({
                type: "POST",
                url: "../controller/season.php",
                data: {get: "get"},
                success: function(resp){
                    $('#loading').remove();
                    for(var i in resp){
                        var wiersz = resp[i];
                        $('#tabsez tbody').append(''+
                            '<tr id="dr'+wiersz.id_sezon+'">'+
                            '<td>'+wiersz.rok_rozpoczecia+'</td>'+
                            '<td>'+wiersz.rok_zakonczenia+'</td>'+
                            '<td><img src="../img/ed.png" width="25" onclick="edytujSezon('+wiersz.id_sezon+');"/></td>'+
                            '<td><img src="../img/nok.svg" width="25" onclick="usunSezon('+wiersz.id_sezon+');"/></td>'+
                            '</tr>'
                            );
                    }
                    tabsez=dataTable('#tabsez');

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
                            '<td><img src="../img/ed.png" width="25" onclick="edytujZawodnika('+wiersz.id_zawodnik+');"/></td>'+
                            '<td><img src="../img/nok.svg" width="25" onclick="usunZawodnika('+wiersz.id_zawodnik+');"/></td>'+
                            '</tr>'
                            );
                    }
                    tabzaw=dataTable('#tabzaw');

                },
                error: function(resp){
                    console.log(resp);
                }
            });
        });

        $('#nowystad').click(function () {
            $('#tytstad').html("Dodawanie obiektu");
            $('#formstad')[0].reset();
            $('#dodstad').attr('type', 'submit');
            $('#edstad').attr('type', 'hidden');
            $('#idstad').remove();
            $('#modalnestad').modal('toggle');
            loadMap();
        });

        $('#nowalig').click(function () {
            $('#tytlig').html("Dodawanie ligi");
            $('#formlig')[0].reset();
            $('#dodlig').attr('type', 'submit');
            $('#edlig').attr('type', 'hidden');
            $('#idlig').remove();
            $('#modalnelig').modal('toggle');
        });

        $('#nowysez').click(function () {
            $('#tytsez').html("Dodawanie sezonu");
            $('#formsez')[0].reset();
            $('#dodsez').attr('type', 'submit');
            $('#edsez').attr('type', 'hidden');
            $('#idsez').remove();
            $('#modalnesez').modal('toggle');
        });

        $('#formstad').submit(function(e){
            e.preventDefault();
            $('body').append('<img id="loading" src="../img/loading.gif"');

            var form = document.getElementById("formstad");
            var fd = new FormData(form);
            fd.append('x', wsp[0]);
            fd.append('y', wsp[1]);

            $.ajax({
                type: "POST",
                url: "../controller/Stadium.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#loading').remove();
                    var obiekt=JSON.parse(resp);
                    var ed='<img src="../img/ed.png" width="25" onclick="edytujobiekt('+obiekt.id_obiekt+');"/>';
                    var us='<img src="../img/nok.svg" width="25" onclick="usunobiekt('+obiekt.id_obiekt+');"/>';
                    var daneodc=[obiekt.nazwa_obiekt, obiekt.miasto_obiekt, obiekt.rok_powstania, obiekt.pojemnosc, ed, us];

                    if($('#idstad').length===0){
                        $('.modal-body').text("obiekt został dodany.");
                        $('#alert').modal('show');
                        tabstad.row.add(daneodc).node().id="st"+obiekt.id_obiekt;
                        tabstad.draw(false);
                    }
                    else{
                        $('.modal-body').text("obiekt został zmodyfikowany.");
                        $('#alert').modal('show');
                        wiersz.data(daneodc).draw();
                    }

                    $("#modalnestad").modal('hide');
                    $('#formstad')[0].reset();
                },
                error: function () {
                    $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                    $('#alert').modal('show');
                }
            });

        });

        $('#formdruz').submit(function(e){
            e.preventDefault();
            $('body').append('<img id="loading" src="../img/loading.gif"');

            var form = document.getElementById("formdruz");
            var fd = new FormData(form);
            var ulub=$('#czyulub').val();
            var idu=$('#iduser').val();
            var identuser=$('#identuser').val();
            fd.append('identuser', identuser);

            $.ajax({
                type: "POST",
                url: "../controller/Team.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#loading').remove();
                    var druzyna=JSON.parse(resp);
                    if(ulub==null)
                        ulub='<img src="../img/greystar.png" width="25" onclick="ulubionaDruzyna('+druzyna.id_druzyna+', '+idu+');"/>';
                    var ed='<img src="../img/ed.png" width="25" onclick="edytujDruzyne('+druzyna.id_druzyna+');"/>';
                    var us='<img src="../img/nok.svg" width="25" onclick="usunDruzyne('+druzyna.id_druzyna+');"/>';
                    var daneodc=[druzyna.nazwa_druzyna, druzyna.rok_zalozenia, druzyna.miasto_druzyna, druzyna.nazwa_obiekt, druzyna.nazwa_liga, ulub, ed, us];

                    if($('#iddruz').length!=0){
                        $('.modal-body').text("Drużyna została zmodyfikowana.");
                        $('#alert').modal('show');
                        wiersz.data(daneodc).draw();
                    }
                    else{
                        $('.modal-body').text("Drużyna została zgłoszona.");
                        $('#alert').modal('show');
                    }

                    $("#modalnedruz").modal('hide');
                    $('#formdruz')[0].reset();
                },
                error: function () {
                    $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                    $('#alert').modal('show');
                }
            });

        });

        $('#formlig').submit(function(e){
            e.preventDefault();
            $('body').append('<img id="loading" src="../img/loading.gif"');

            var form = document.getElementById("formlig");
            var fd = new FormData(form);

            $.ajax({
                type: "POST",
                url: "../controller/League.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#loading').remove();
                    var liga=JSON.parse(resp);
                    var ed='<img src="../img/ed.png" width="25" onclick="edytujLige('+liga.id_liga+');"/>';
                    var us='<img src="../img/nok.svg" width="25" onclick="usunLige('+liga.id_liga+');"/>';
                    var sezonligi=liga.rok_rozpoczecia+" - "+liga.rok_zakonczenia;
                    var daneodc=[liga.nazwa_liga, liga.kraj, liga.poziom, sezonligi, ed, us];

                    if($('#idlig').length===0){
                        $('.modal-body').text("Liga została dodana.");
                        $('#alert').modal('show');
                        tablig.row.add(daneodc).node().id="li"+liga.id_liga;
                        tablig.draw(false);
                    }
                    else{
                        $('.modal-body').text("Liga została zmodyfikowana.");
                        $('#alert').modal('show');
                        wiersz.data(daneodc).draw();
                    }

                    $("#modalnelig").modal('hide');
                    $('#formlig')[0].reset();
                },
                error: function () {
                    $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                    $('#alert').modal('show');
                }
            });
        });

        $('#formsez').submit(function(e){
            e.preventDefault();
            $('body').append('<img id="loading" src="../img/loading.gif"');

            var form = document.getElementById("formsez");
            var fd = new FormData(form);

            $.ajax({
                type: "POST",
                url: "../controller/Season.php",
                data: fd,
                processData: false,
                contentType: false,
                success: function (resp) {
                    $('#loading').remove();
                    var sezon=JSON.parse(resp);
                    var ed='<img src="../img/ed.png" width="25" onclick="edytujSezon('+sezon.id_sezon+');"/>';
                    var us='<img src="../img/nok.svg" width="25" onclick="usunSezon('+sezon.id_sezon+');"/>';
                    var daneodc=[sezon.rok_rozpoczecia, sezon.rok_zakonczenia, ed, us];

                    if($('#idsez').length===0){
                        $('.modal-body').text("Sezon został dodany.");
                        $('#alert').modal('show');
                        tabsez.row.add(daneodc).node().id="se"+sezon.id_sezon;
                        tabsez.draw(false);
                    }
                    else{
                        $('.modal-body').text("Sezon został zmodyfikowany.");
                        $('#alert').modal('show');
                        wiersz.data(daneodc).draw();
                    }

                    $("#modalnesez").modal('hide');
                    $('#formsez')[0].reset();
                },
                error: function () {
                    $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                    $('#alert').modal('show');
                }
            });
        });

        $('#formzaw').submit(function(e){
            e.preventDefault();
            if($('#formzaw').valid()){
                e.preventDefault();
                var dzis=new Date();
                var urData=new Date($('#datazaw').val());
                if(urData>=dzis){
                    $('.modal-body').text("Proszę wpisać poprawną datę urodzenia zawodnika");
                    $('#alert').modal('show');
                    return;
                }

                var start=new Date($('#startzaw').val());
                var stop=new Date($('#stopzaw').val());
                if(start>=stop){
                    $('.modal-body').text("Proszę wpisać poprawne daty początku oraz zakończenia kontraktu");
                    $('#alert').modal('show');
                    return;
                }                
                
                $('body').append('<img id="loading" src="../img/loading.gif"');

                var form = document.getElementById("formzaw");
                var fd = new FormData(form);
                var identuser=$('#identuser').val();
                fd.append('identuser', identuser);

                $.ajax({
                    type: "POST",
                    url: "../controller/Player.php",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (resp) {
                        $('#loading').remove();
                        var zawodnik=JSON.parse(resp);
                        var ed='<img src="../img/ed.png" width="25" onclick="edytujZawodnika('+zawodnik.id_zawodnik+');"/>';
                        var us='<img src="../img/nok.svg" width="25" onclick="usunZawodnika('+zawodnik.id_zawodnik+');"/>';
                        var daneodc=[zawodnik.imie, zawodnik.nazwisko, zawodnik.nazwa_druzyna, ed, us];

                        if($('#idzaw').length!=0){
                            $('.modal-body').text("Zawodnik został zmodyfikowany.");
                            $('#alert').modal('show');
                            wiersz.data(daneodc).draw();
                        }
                        else{
                            $('.modal-body').text("Drużyna została zgłoszona.");
                            $('#alert').modal('show');
                        }

                        $("#modalnezaw").modal('hide');
                        $('#formzaw')[0].reset();
                    },
                    error: function () {
                        $('.modal-body').text("Wystąpił błąd, przepraszamy za utrudnienia.");
                        $('#alert').modal('show');
                    }
                });
            }
        });

        $('#linknotification').click(function(){
            $('section').hide();
            $('#zgloszenia').show();
            $('body').append('<img id="loading" src="../img/loading.gif"');

            $.ajax({
                type: "POST",
                url: "../controller/notification.php",
                data:{
                    selzaw: '1'
                },
                success: function(resp){
                    $('#tabzgzaw tbody').empty();
                    $('#loading').remove();
                    var zawodnicy=JSON.parse(resp);
                    for(var i in zawodnicy){
                        var zaw=zawodnicy[i];
                        $('#tabzgzaw tbody').append(""+
                            "<tr onclick='pokazZgloszenieZaw("+zaw.id_zgloszenia_zawodnika+", \""+zaw.login+"\");'>"+
                            "<td>"+zaw.login+"</td>"+
                            "<td>"+zaw.imie+"</td>"+
                            "<td>"+zaw.nazwisko+"</td>"+
                            "<td>"+zaw.nazwa_druzyna+"</td>"+
                            "</tr>");
                    }
                    dataTable('#tabzgzaw');
                }
            });
        });

        $('#linkdruz').click(function(){
            $('section').hide();
            $('#zgloszenia').show();
            $('body').append('<img id="loading" src="../img/loading.gif"');

            $.ajax({
                type: "POST",
                url: "../controller/notification.php",
                data:{
                    seldruz: '1'
                },
                success: function(resp){
                    $('#tabzgdruz tbody').empty();
                    $('#loading').remove();
                    var druzyny=JSON.parse(resp);
                    for(var i in druzyny){
                        var zaw=druzyny[i];
                        $('#tabzgdruz tbody').append(''+
                            '<tr>'+
                            '<td>'+zaw.login+'</td>'+
                            '<td>'+zaw.nazwa_druzyna+'</td>'+
                            '<td>'+zaw.rok_zalozenia+'</td>'+
                            '<td>'+zaw.miasto_druzyna+'</td>'+
                            '<td>'+zaw.nazwa_obiekt+'</td>'+
                            '<td>'+zaw.nazwa_liga+'</td>'+
                            '<td onclick="zaakceptujDruz('+zaw.id_zgloszenia_druzyny+');"><img src="../img/ok.png" width="25"/></td>'+
                            '<td onclick="odrzucDruz('+zaw.id_zgloszenia_druzyny+');"><img src="../img/nok.svg" width="25"/></td>'+
                            '</tr>');
                    }
                    tabzgdruz=dataTable('#tabzgdruz');
                }
            });
        });

        $('#linkchart').click(function(){
            $('section').hide();
            $('#wykres').show();
        });
    });

function zmienUprawnienia(uzytkownik) {
    var wiersz, dane;
    $('#tab tbody').on('click', 'td', function () {
        wiersz = tabusers.row(this);
        dane = tabusers.row(this).data();
    });
    if (confirm("Czy na pewno chcesz zmienić uprawnienia użytkownika?")) {
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/edytujUprawnienia.php",
            data: {uzytkownik: uzytkownik},
            success: function (resp) {
                $('#loading').remove();
                $('.modal-body').text("Zmieniono uprawnienia.");
                $('#alert').modal('show');
                if (resp == '1')
                    dane[8] = '<img src="../img/ok.png" width="25" onclick="zmienUprawnienia(' + uzytkownik + ');"/>';
                else if (resp == '0')
                    dane[8] = '<img src="../img/nok.png" width="25" onclick="zmienUprawnienia(' + uzytkownik + ');"/>';
                wiersz.data(dane).draw();
            }
        });
    }
}

function usunUzytkownika(uzytkownik) {
    var wiersz, dane;
    $('#tab tbody').on('click', 'td', function () {
        wiersz = tabusers.row(this);
        dane = tabusers.row(this).data();
    });
    if (confirm("Czy na pewno chcesz usunąć konto użytkownika?")) {
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/user.php",
            data: {uzytkownik: uzytkownik},
            success: function (resp) {
                $('#loading').remove();
                $('.modal-body').text(resp);
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}

function edytujobiekt(idstad){
    $('#dodstad').attr('type', 'hidden');
    $('#edstad').attr('type', 'submit');
    $('#tytstad').html("Edycja obiektu");
    $('#idstad').remove();
    $('#modalnestad').modal('toggle');
    $('body').append('<img id="loading" src="../img/loading.gif"');

    $('#tabstad tbody').on('click', 'tr', function () {
        wiersz = tabstad.row(this);
    });

    $.ajax({
        type: "POST",
        url: "../controller/Stadium.php",
        data: {
            idstad: idstad,
            select: '1'
        },
        success: function (resp) {
            $('#loading').remove();
            var obiekt=JSON.parse(resp);

            $('#nazwastad').val(obiekt.nazwa_obiekt);
            $('#miastostad').val(obiekt.miasto_obiekt);
            $('#rokstad').val(obiekt.rok_powstania);
            $('#pojstad').val(obiekt.pojemnosc);
            $('#formstad').append('<input type="hidden" name="idstad" id="idstad" value="'+obiekt.id_obiekt+'"/>');
            
            loadMap(obiekt.x, obiekt.y, 8, "mapka", true);
        }
    });
}

function usunobiekt(idstad){
    $('#tabstad tbody tr').on('click', 'td', function () {
        wiersz = tabstad.row(this);
    });

    if(confirm("Czy na pewno chcesz usunąć obiekt?")){
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/Stadium.php",
            data: {idstad: idstad},
            success: function () {
                $('#loading').remove();
                $('.modal-body').text("obiekt został usunięty");
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}


function edytujDruzyne(iddruz){
    $('#doddruz').hide();
    $('#eddruz').attr('type', 'submit');
    $('#tytdruz').html("Edycja drużyny");
    $('#iddruz').remove();
    $('#czyulub').remove();
    $('#modalnedruz').modal('toggle');
    $('body').append('<img id="loading" src="../img/loading.gif"');

    $('#tabdruz tbody').on('click', 'tr', function () {
        wiersz = tabdruz.row(this);
    });

    $.ajax({
        type: "POST",
        url: "../controller/Team.php",
        data: {
            iddruz: iddruz,
            select: '1'
        },
        success: function (resp) {
            $('#loading').remove();
            var druzyna=JSON.parse(resp);

            $('#nazwadruz').val(druzyna.nazwa_druzyna);
            $('#miastodruz').val(druzyna.miasto_druzyna);
            $('#rokdruz').val(druzyna.rok_zalozenia);
            $('#obiektdruz').val(druzyna.id_obiekt);
            $('#ligadruz').val(druzyna.id_liga);
            $('#formdruz').append('<input type="hidden" name="iddruz" id="iddruz" value="'+druzyna.id_druzyna+'"/>');

            var idrow="#dr"+druzyna.id_druzyna+" td:last";
            var ulub=$(idrow).prev().prev().html();
            var sc="<input value='"+ulub+"' type='hidden' id='czyulub'/>";
            $('#formdruz').append(sc);
        },
        error: function(resp){
            console.log(resp);
        }
    });
}

function usunDruzyne(iddruz){
    $('#tabdruz tbody tr').on('click', 'td', function () {
        wiersz = tabdruz.row(this);
    });

    if(confirm("Czy na pewno chcesz usunąć druzynę?")){
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/Team.php",
            data: {iddruz: iddruz},
            success: function () {
                $('#loading').remove();
                $('.modal-body').text("Drużyna została usunięta");
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}

function edytujLige(idlig){
    $('#dodlig').attr('type', 'hidden');
    $('#edlig').attr('type', 'submit');
    $('#tytlig').html("Edycja ligi");
    $('#idlig').remove();
    $('#modalnelig').modal('toggle');
    $('body').append('<img id="loading" src="../img/loading.gif"');

    $('#tablig tbody').on('click', 'tr', function () {
        wiersz = tablig.row(this);
    });

    $.ajax({
        type: "POST",
        url: "../controller/League.php",
        data: {
            idlig: idlig,
            select: '1'
        },
        success: function (resp) {
            $('#loading').remove();
            var liga=JSON.parse(resp);

            $('#nazwalig').val(liga.nazwa_liga);
            $('#krajlig').val(liga.kraj);
            $('#poziomlig').val(liga.poziom);
            $('#sezonlig').val(liga.id_sezon);
            $('#formlig').append('<input type="hidden" name="idlig" id="idlig" value="'+liga.id_liga+'"/>');
        }
    });
}

function usunLige(idlig){
    $('#tablig tbody tr').on('click', 'td', function () {
        wiersz = tablig.row(this);
    });

    if(confirm("Czy na pewno chcesz usunąć ligę?")){
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/League.php",
            data: {idlig: idlig},
            success: function () {
                $('#loading').remove();
                $('.modal-body').text("Liga została usunięta.");
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}

function edytujSezon(idsez){
    $('#dodsez').attr('type', 'hidden');
    $('#edsez').attr('type', 'submit');
    $('#tytsez').html("Edycja sezonu");
    $('#idsez').remove();
    $('#modalnesez').modal('toggle');
    $('body').append('<img id="loading" src="../img/loading.gif"');

    $('#tabsez tbody').on('click', 'tr', function () {
        wiersz = tabsez.row(this);
    });

    $.ajax({
        type: "POST",
        url: "../controller/Season.php",
        data: {
            idsez: idsez,
            select: 1
        },
        success: function (resp) {
            $('#loading').remove();
            var sezon=JSON.parse(resp);

            $('#startsez').val(sezon.rok_rozpoczecia);
            $('#stopsez').val(sezon.rok_zakonczenia);
            $('#formsez').append('<input type="hidden" name="idsez" id="idsez" value="'+sezon.id_sezon+'"/>');
        }
    });
}

function usunSezon(idsez){
    $('#tabsez tbody tr').on('click', 'td', function () {
        wiersz = tabsez.row(this);
    });

    if(confirm("Czy na pewno chcesz usunąć sezon?")){
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/Season.php",
            data: {idsez: idsez},
            success: function () {
                $('#loading').remove();
                $('.modal-body').text("Sezon został usunięty.");
                $('#alert').modal('show');
                wiersz.remove().draw();
            }
        });
    }
}

function edytujZawodnika(idzaw){
    $('#dodzaw').attr('type', 'hidden');
    $('#edzaw').attr('type', 'submit');
    $('#tytzaw').html("Edycja zawodnika");
    $('#idzaw').remove();
    $('#modalnezaw').modal('toggle');
    $('body').append('<img id="loading" src="../img/loading.gif"');

    $('#tabzaw tbody tr td:last').prev('td').on('click', function (e) {
        wiersz = tabzaw.row(this);
        e.stopPropagation();
    });

    $.ajax({
        type: "POST",
        url: "../controller/Player.php",
        data: {
            idzaw: idzaw,
            select: 1
        },
        success: function (resp) {
            $('#loading').remove();
            var zawodnik=JSON.parse(resp);

            $('#imiezaw').val(zawodnik.imie);
            $('#nazwiskozaw').val(zawodnik.nazwisko);
            $('#datazaw').val(zawodnik.data_urodzenia);
            $('#druzynazaw').val(zawodnik.id_druzyna);
            $('#startzaw').val(zawodnik.poczatek_kontrakt);
            $('#stopzaw').val(zawodnik.koniec_kontrakt);
            $('#wagazaw').val(zawodnik.waga);
            $('#wzrostzaw').val(zawodnik.wzrost);
            $('#pozycjazaw').val(zawodnik.pozycja);
            $('#formzaw').append('<input type="hidden" name="idzaw" id="idzaw" value="'+zawodnik.id_zawodnik+'"/>');
        }
    });
}

function usunZawodnika(idzaw){
    $('#tabzaw tbody tr').on('click', 'td', function () {
        wiersz = tabzaw.row(this);
    });

    $('#tabzaw tbody tr td:last-child').on('click', function (e) {
        e.stopPropagation();
    });

    if(confirm("Czy na pewno chcesz usunąć zawodnika?")){
        $('body').append('<img id="loading" src="../img/loading.gif"');
        $.ajax({
            type: "POST",
            url: "../controller/Player.php",
            data: {idzaw: idzaw},
            success: function () {
                $('#loading').remove();
                $('.modal-body').text("Zawodnik został usunięty.");
                $('#alert').modal('show');
                wiersz.remove().draw(false);
            }
        });
    }
}

function pokazZgloszenieZaw(idzaw, iduser){
    $('body').append('<img id="loading" src="../img/loading.gif"');
    $.ajax({
        type: "POST",
        url: "../controller/notification.php",
        data:{
            show: '1',
            idzaw: idzaw
        },
        success: function(resp){
            $('#loading').remove();
            $('section').hide();
            $('#zawodnik').show();
            $('#backplayer').hide();
            $('#backplayer2').show();
            var dane=JSON.parse(resp);

            $('#imiezawodnik').text(dane.imie);
            $('#nazwiskozawodnik').text(dane.nazwisko);
            $('#datazawodnik').text(dane.data_urodzenia);
            $('#druzynazawodnik').text(dane.nazwa_druzyna);
            $('#startzawodnik').text(dane.poczatek_kontrakt);
            $('#stopzawodnik').text(dane.koniec_kontrakt);
            $('#wagazawodnik').text(dane.waga);
            $('#wzrostzawodnik').text(dane.wzrost);
            $('#pozycjazawodnik').text(dane.pozycja);
            $('#zawodnik div.container-fluid:last-child').append(''+
                '<div class="row" id="dodus">'+
                '<div class="col-xs-3 col-xs-offset-4">'+
                '<button class="btn btn-success btn-lg" onclick="akceptujZawodnik('+dane.id_zgloszenia_zawodnika+');">Akceptuj</button>'+
                '</div>'+
                '<div class="col-xs-3">'+
                '<button class="btn btn-danger btn-lg" onclick="odrzucZawodnik('+dane.id_zgloszenia_zawodnika+', '+iduser+');">Odrzuć</button>'+
                '</div></div>');

            $('#backplayer2').click(function(){
                $('section').hide();
                $('#linknotification').click();
                $('#dodus').remove();
            });
        }
    });
}

function akceptujZawodnik(idzaw){
    if(confirm("Czy na pewno chcesz zaakceptować zawodnika?")){
        $.ajax({
            type: "POST",
            url: "../controller/notification.php",
            data:{
                accept: '1',
                idzaw: idzaw
            },
            success: function(resp){
                $('.modal-body').text("Zawodnik został zaakceptowany.");
                $('#alert').modal('show');
                $('section').hide();
                $('#linknotification').click();
                $('#dodus').remove();
            }
        });
    }
}

function odrzucZawodnik(idzaw, iduser){
    if(confirm("Czy na pewno chcesz odrzucić zawodnika?")){
        $.ajax({
            type: "POST",
            url: "../controller/notification.php",
            data:{
                delete: '1',
                idzaw: idzaw
            },
            success: function(resp){
                $('.modal-body').text("Zawodnik został usunięty.");
                $('#alert').modal('show');
                $('section').hide();
                $('#linknotification').click();
                $('#dodus').remove();

                $('#modalnewiad').modal('show');
                $('#dokogo').val(iduser);
            }
        });
    }
}

function zaakceptujDruz(iddruz){
    $('#tabzgdruz tbody tr').on('click', 'td', function () {
        wiersz = tabzgdruz.row(this);
    });

    if(confirm("Czy na pewno chcesz zaakceptować drużynę?")){
        $.ajax({
            type: "POST",
            url: "../controller/notification.php",
            data:{
                accept: '1',
                iddruz: iddruz
            },
            success: function(resp){
                $('.modal-body').text("Drużyna została zaakceptowana.");
                $('#alert').modal('show');
                $('section').hide();
                wiersz.remove().draw(false);
                $('#linkdruz').click();
            }
        });
    }
}

function odrzucDruz(iddruz){
    var login;
    $('#tabzgdruz tbody tr').on('click', 'td', function () {
        wiersz = tabzgdruz.row(this);
        login = $(this).parent().children('td:first-child').text();
    });

    if(confirm("Czy na pewno chcesz odrzucić drużynę?")){
        $.ajax({
            type: "POST",
            url: "../controller/notification.php",
            data:{
                delete: '1',
                iddruz: iddruz
            },
            success: function(resp){
                $('#modalnewiad').modal('show');
                $('#dokogo').val(login);

                wiersz.remove().draw(false);
            }
        });
    }
}
</script>