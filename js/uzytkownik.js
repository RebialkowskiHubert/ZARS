$(document).ready(function(){

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
									if(wiersz.id_druzyna==f[k])
										fav='<td><img src="../img/goldstar.png" width="25" onclick="nieUlubionaDruzyna('+wiersz.id_druzyna+', '+idu+');"/></td>';
									else
										fav='<td><img src="../img/greystar.png" width="25" onclick="ulubionaDruzyna('+wiersz.id_druzyna+', '+idu+');"/></td>';
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
				tabzaw=dataTable('#tabzaw');

			},
			error: function(resp){
				console.log(resp);
			}
		});
	});	

	$('#formdruz').submit(function(e){
		e.preventDefault();
		$('body').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');

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

				$('.modal-body').text("Drużyna została zgłoszona.");
                $('#alert').modal('show');

				$("#modalnedruz").modal('hide');
				$('#formdruz')[0].reset();
			},
			error: function () {
				alert("Wystąpił błąd, przepraszamy za utrudnienia.");
			}
		});
	});

	$('#formzaw').submit(function(e){
		e.preventDefault();
		if($('#formzaw').valid()){
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
			
			$('body').append('<img id="loading" src="../img/loading.gif" style="position:absolute; top:50%; left:50%;" width="40"/>');

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
					$('.modal-body').text("Zawodnik został zgłoszony.");
					$('#alert').modal('show');
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
});