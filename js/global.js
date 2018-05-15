var liga, lastmecz=0, mecze=[], fm, lm;

$(document).ready(function(){
    $('.dyscyplina').click(function(){
        $('#dyscypliny').hide();
        $('#panelgl').show();
        $('head').prepend('<link id="linkdt" href="../css/datatables.min.css" rel="stylesheet"/>');

        var iddys=this.id;
        var nazwadys=$(this).children(".tytuldyscyplina").text();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/discipline.php",
            data: {iddys: iddys},
            success: function(){
                $('#loading').remove();
                $('#tdys').text("Twoja dyscyplina: "+nazwadys);
            }
        });
    });

    $('#linkdisc').click(function(){
        $('#linkdt').remove();
        $('#panelgl').hide();
        $('#dyscypliny').show();
        $('#tdys').text("");
    });

    $('#backplayer').click(function () {
        $('section').hide();
        $('#zawodnicy').show();
    });

    $('#backteam').click(function () {
        $('section').hide();
        $('#druzyny').show();
    });

    $('#backleague').click(function(){
        $('section').hide();
        $('#ligi').show();
    });

    $('#tabzaw tbody').on('click', 'tr', function(){
        var idzaw=this.id;
        var druzyna=$(this).find("td").eq(2).html();
        idzaw=idzaw.replace("zw", "");
        pokazZawodnik(idzaw, druzyna);
    });

    $('#tabdruz tbody').on('click', 'tr td:first-child', function(){
        pokazDruzyne($(this).parent()[0].id);
    });

    $('#tablig tbody').on('click', 'tr td:first-child', function(){
        liga=pokazLige($(this).parent()[0].id);
    });


    $('#druzynyl').click(function(){
        $('.panellig').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('#listadruzyn ol').empty();
        $.ajax({
            type: "POST",
            url: "../controller/League.php",
            data:{
                idlig: liga,
                druzynal: '1'
            },
            success: function(resp){
                $('#loading').remove();
                var druzyny=JSON.parse(resp);
                for(var i in druzyny){
                    $("#listadruzyn ol").append('<h3><li>'+druzyny[i].nazwa_druzyna+'</li></h3>');
                }
                $('#listadruzyn').show();
            }
        });
    });

    $('#mecze').click(function(){
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('.panellig').hide();

        $.ajax({
            type: "POST",
            url: "../controller/match.php",
            data:{
                idlig: liga,
                select: '1'
            },
            success: function(resp){
                $('#loading').remove();
                mecze=JSON.parse(resp);

                if(mecze.length!=0){
                    pokazMecz(mecze[lastmecz].id_mecz);
                    fm=mecze[0].id_mecz;
                    lm=mecze[mecze.length-1].id_mecz;    
                }
                else{
                    $('#brakmeczow').show();
                }
            }
        });
    });

    $('#next').click(function(){
        lastmecz++;
        pokazMecz(mecze[lastmecz].id_mecz);
    });

    $('#prev').click(function(){
        lastmecz--;
        pokazMecz(mecze[lastmecz].id_mecz);
    })

    $('#bramki').click(function(){
        $('#tabbramki tbody').empty();
        $('.panellig').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/match.php",
            data:{
                idlig: liga,
                bram: '1'
            },
            success: function(resp){
                var wyniki=JSON.parse(resp);
                var j=1;
                for(var i in wyniki){
                    $('#tabbramki tbody').append(''+
                        '<tr>'+
                        '<td>'+j+'</<td>'+
                        '<td>'+wyniki[i].Zawodnik+'</<td>'+
                        '<td>'+wyniki[i].nazwa_druzyna+'</<td>'+
                        '<td>'+wyniki[i].bramki+'</<td>'+
                        '</tr>'
                        );

                    j++;
                }
                $('#loading').remove();
                $('#listabramek').show();
            }
        });
    });

    $('#statystyki').click(function(){
        $('#tabstat tbody').empty();
        $('.panellig').hide();
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $.ajax({
            type: "POST",
            url: "../controller/match.php",
            data:{
                idlig: liga,
                stat: '1'
            },
            success: function(resp){
                var wyniki=JSON.parse(resp);
                for(var i in wyniki){
                    $('#tabstat tbody').append(''+
                        '<tr>'+
                        '<td>'+wyniki[i].nazwa_druzyna+'</<td>'+
                        '<td>'+wyniki[i].mecze+'</<td>'+
                        '<td>'+wyniki[i].bramki_ZD+'</<td>'+
                        '<td>'+wyniki[i].bramki_ST+'</<td>'+
                        '<td>'+wyniki[i].punkty+'</<td>'+
                        '</tr>'
                        );
                }
                $('#loading').remove();
                $('#listastat').show();
            }
        });
    });


    zawodnicy1=[];
    zawodnicy2=[];

    zm1=[];
    zm2=[];

    $('#dodajmecz').click(function(){        
        zawodnicy1=[];
        zawodnicy2=[];
        $('#modalnemecz').modal('toggle');
        
        $('#meczkolejki').text($('#kolejka').text());
        $('#druzynaA').text($('#druzyna1').text());
        $('#druzynaB').text($('#druzyna2').text());

        
        var iddruz=$('#iddruz1').val();
        $.ajax({
            type: "POST",
            url: "../controller/match.php",
            data:{
                iddruz: iddruz,
            },
            success: function(resp){
                var zaw=JSON.parse(resp);
                for(var i in zaw){
                    zawodnicy1[i]=zaw[i];
                }
            }
        });

        var iddruz2=$('#iddruz2').val();
        $.ajax({
            type: "POST",
            url: "../controller/match.php",
            data:{
                iddruz: iddruz2,
            },
            success: function(resp){
                var zaw=JSON.parse(resp);
                for(var i in zaw){
                    zawodnicy2[i]=zaw[i];
                }                   
            }
        });

        var wynik=$('#wynik').text();
        if(wynik!='Mecz się jeszcze nie odbył'){

            zm1=[];
            zm2=[];
            var w=wynik.split(":");
            var idmecz=$('#nrmecz').val();
            $.ajax({
                type: "POST",
                url: "../controller/match.php",
                data:{
                    idmecz: idmecz,
                    iddruz: iddruz
                },
                success: function(resp){
                    var pl=JSON.parse(resp);
                    for(var i in pl){
                        zm1[i]=pl[i].id_zawodnik;

                        $('#goldr1').val(parseInt(w[0]));
                        $('#goldr1').change();
                    }
                }
            });

            $.ajax({
                type: "POST",
                url: "../controller/match.php",
                data:{
                    idmecz: idmecz,
                    iddruz: iddruz2
                },
                success: function(resp){
                    var pl=JSON.parse(resp);
                    for(var i in pl){
                        zm2[i]=pl[i].id_zawodnik;
                    }

                    $('#goldr2').val(parseInt(w[1]));
                    $('#goldr2').change();
                }
            });
        }
    });

    $('#goldr1').change(function(){
        $('#bramkidr1').empty();
        var br=$('#goldr1').val();
        for(var i=0; i<br; i++){
            $('#bramkidr1').append('<select id="bramone'+i+'" name="bramone'+i+'"></select>');

            for(var j=0; j<zawodnicy1.length; j++){
                $('#bramone'+i).append('<option value="'+zawodnicy1[j].id_zawodnik+'">'+zawodnicy1[j].imie+' '+zawodnicy1[j].nazwisko+'</option>');

                if(zm1.length<=br+1){
                    if(zm1[i]==zawodnicy1[j].id_zawodnik){
                        $('#bramone'+i+' option:last-child').attr('selected', 'selected');
                    }
                }
            }
            $('#bramone'+i).append('<option value="0">Gol samobójczy</option>');
            if($('#goldr1').is('readonly'))
                $('#bramone'+i).attr('disabled', 'true');
        }
    });

    $('#goldr2').change(function(){
        $('#bramkidr2').empty();
        var br=$('#goldr2').val();
        for(var i=0; i<br; i++){
            $('#bramkidr2').append('<select id="bramtwo'+i+'" name="bramtwo'+i+'"></select>');

            for(var j=0; j<zawodnicy2.length; j++){
                $('#bramtwo'+i).append('<option value="'+zawodnicy2[j].id_zawodnik+'">'+zawodnicy2[j].imie+' '+zawodnicy2[j].nazwisko+'</option>');

                if(zm2.length<=br+1){
                    if(zm2[i]==zawodnicy2[j].id_zawodnik)
                        $('#bramtwo'+i+' option:last-child').attr('selected', 'selected');
                }
            }

            $('#bramtwo'+i).append('<option value="0">Gol samobójczy</option>');
            if($('#goldr2').is('readonly'))
                $('#bramtwo'+i).attr('disabled', 'true');
        }
    });

    $('#resetMap').click(function(){
        for(var i in markery){
            markery[i].setMap(null);
            markery[i]=null;
        }
        markery=[];
    });

    $('#tabstad tbody').on('click', 'tr td:first-child', function(){
        var idstad=$(this).parent()[0].id;
        idstad=idstad.replace("st", "");
        $('body').append('<img id="loading" src="../img/loading.gif"/>');
        $('section').hide();
        $('#obiekt').show();

        $.ajax({
            type: "POST",
            url: "../controller/stadium.php",
            data:{
                idstad: idstad,
                select: '1'
            },
            success: function(resp){
                $('#loading').remove();
                var dane=JSON.parse(resp);

                $('#nazwaobiektu').text(dane.nazwa_obiekt);
                $('#rokobiektu').text("Rok powstania: "+dane.rok_powstania);
                $('#pojemnoscobiektu').text("Pojemność: "+dane.pojemnosc);
                $('#miastoobiektu').text("Miasto: "+dane.miasto_obiekt);
                var mapa=loadMap(dane.x, dane.y, 8, "mapastad", false);
                loadMarker(dane.x, dane.y, mapa);
            }
        });
    });

    $('#backstadium').click(function(){
        $('section').hide();
        $('#obiekty').show();
    });
});

function pokazMecz(idmecz){
    $('body').append('<img id="loading" src="../img/loading.gif"/>');
    $('#kolejka').empty();
    $('#druzyna1').empty();
    $('#druzyna2').empty();
    $('#wynik').empty();

    $.ajax({
        type: "POST",
        url: "../controller/match.php",
        data:{
            idmecz: idmecz
        },
        success: function(resp){
            var wyniki=JSON.parse(resp);
            $('#loading').remove();
            $('#kolejka').append("Kolejka: "+wyniki.kolejka);
            $('#druzyna1').append(wyniki.druzynaA);
            $('#druzyna2').append(wyniki.druzynaB);
            if(wyniki.bramki_druzyna1==null || wyniki.bramki_druzyna1==null)
                $('#wynik').append("Mecz się jeszcze nie odbył");
            else    
                $('#wynik').append(wyniki.bramki_druzyna1+" : "+wyniki.bramki_druzyna2);

            $('#nrmecz').val(idmecz);
            $('#iddruz1').val(wyniki.id1);
            $('#iddruz2').val(wyniki.id2);

            if(idmecz==mecze[0].id_mecz){
                $('#prev').css('visibility', 'hidden');
            }
            else
                $('#prev').css('visibility', 'visible');

            if(idmecz==lm){
                $('#next').css('visibility', 'hidden');
            }
            else
                $('#next').css('visibility', 'visible');

            $('#listameczow').show();


            $('#imgdruzynaA').attr('src', wyniki.logoA);
            $('#imgdruzynaB').attr('src', wyniki.logoB);
        }
    });
}

function pokazDruzyne(iddruz){
    $('#tabdruzyna tbody').empty();
    $('body').append('<img id="loading" src="../img/loading.gif"/>');
    iddruz=iddruz.replace("dr", "");
    $.ajax({
        type: "POST",
        url: "../controller/team.php",
        data:{
            iddruz: iddruz,
            player: '1'
        },
        success: function(resp){
            $('#loading').remove();
            $('#druzyny').hide();
            $('#druzyna').show();
            var druzyny=JSON.parse(resp);

            for(var i in druzyny){
                var lp=i;
                lp++;
                $('#tabdruzyna tbody').append(''+
                    '<tr>'+
                    '<td>'+lp+'</td>'+
                    '<td>'+druzyny[i].imie+' '+druzyny[i].nazwisko+'</td>'+
                    '<td>'+druzyny[i].pozycja+'</td>'+
                    '<td>'+druzyny[i].poczatek_kontrakt+'</td>'+
                    '<td>'+druzyny[i].koniec_kontrakt+'</td>'+
                    '</tr>'
                    );
            }
        },
        error: function(resp){
            console.log(resp);
        }
    });
}

function pokazLige(idlig){
    $('.panellig').hide();
    $('section').hide();
    $('#liga').show();
    idlig=idlig.replace("li", "");
    $('#nrligi').val(idlig);

    return idlig;
}

function pokazZawodnik(idzaw, druzyna){
    $('body').append('<img id="loading" src="../img/loading.gif"/>');
    $.ajax({
        type: "POST",
        url: "../controller/Player.php",
        data:{
            idzaw: idzaw,
            select: '1'
        },
        success: function(resp){
            var zawodnik=JSON.parse(resp);
            $('#imiezawodnik').html(zawodnik.imie);
            $('#nazwiskozawodnik').html(zawodnik.nazwisko);
            $('#datazawodnik').html(zawodnik.data_urodzenia);
            $('#druzynazawodnik').html(druzyna);
            $('#startzawodnik').html(zawodnik.poczatek_kontrakt);
            $('#stopzawodnik').html(zawodnik.koniec_kontrakt);
            $('#wagazawodnik').html(zawodnik.waga);
            $('#wzrostzawodnik').html(zawodnik.wzrost);
            $('#pozycjazawodnik').html(zawodnik.pozycja);

            $('#loading').remove();
            $('#zawodnicy').hide();
            $('#zawodnik').show();
            $('#backplayer').show();
            $('#backplayer2').hide();
        }
    });
}

function pokazWydarzenie(idwyd){
    $('body').append('<img id="loading" src="../img/loading.gif"/>');
    $.ajax({
        type: "POST",
        url: "../controller/events.php",
        data:{
            idwyd: idwyd,
            get: "get"
        },
        success: function(resp){
            var wydarzenie=JSON.parse(resp);
            $('#nazwawydarzenia').html(wydarzenie.nazwa_wyd);
            $('#opiswydarzenia').html(wydarzenie.opis);
            $('#datawydarzenia2').html(wydarzenie.data_wyd);

            $('#loading').remove();
            $('#wydarzenia').hide();
            $('#wydarzenie').show();

            var mapka=loadMap(wydarzenie.dlugosc, wydarzenie.szerokosc, 14, "mapawyd", false);
            loadMarker(wydarzenie.dlugosc, wydarzenie.szerokosc, mapka);
        },
        error: function(resp){
            console.log(resp);
        }
    });
}

function loadMap(dl=51.9581693, szer=19.1172011, zoom=6, idmap="mapka", klik=true){
    var wspolrzedne = new google.maps.LatLng(dl, szer);
    var opcjeMapy = 
    {
      zoom: zoom,
      center: wspolrzedne,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapa = new google.maps.Map(document.getElementById(idmap), opcjeMapy);

    if(klik===true){
        google.maps.event.addListener(mapa, 'click', function(e){
            if(e.latLng){
                var marker=loadMarker(e.latLng.lat(), e.latLng.lng(), mapa);
                markery.push(marker);
                wsp=[];
                wsp.push(e.latLng.lat(), e.latLng.lng());
            }
        });
    }
    return mapa;
}

function loadMarker(dl, szer, mapa){
    var punkt = new google.maps.LatLng(dl,szer);
    var opcjeMarkera = 
    {
        position: punkt,
        map: mapa,
        title: 'Lokalizacja obiektu'
    }
    var marker = new google.maps.Marker(opcjeMarkera);
    return marker;
}