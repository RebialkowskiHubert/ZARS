<section id="liga" class="podstrona">
	<input id="nrligi" type="hidden"/>
	<div class="container-fluid">
		<img id="backleague" src="../img/back.png" width="25"/>
		<div class="row">
			<div class="col-md-8"><h1>Panel ligowy</h1></div>
		</div>

		<div class="row" style="margin-top: 5%;" id="mecze">
			<div class="col-xs-1">
				<img src="../img/plus.png" class="img-responsive"/>
			</div>
			<div class="col-xs-5">
				<h2>Mecze</h2>
			</div>
		</div>			

		<div class="row podstrona panellig" id="brakmeczow">
			<div class="row">
				<center>
					<h3>Brak spotkań</h3>
				</center>
			</div>
			<div class="row">
				<center>
					<button type="button" id="generujspotkania" class="btn btn-lg btn-primary">Generuj</button>
				</center>
			</div>
		</div>

		<div class="row podstrona panellig" id="tabelameczow">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" width="100" id="tabmatch">
					<thead>
						<tr>
							<th>L.p.</th>
							<th>Kolejka</th>
							<th>Mecz</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="col-xs-10"></div>
			<div class="col-xs-2">
				<button class="btn btn-lg btn-success" id="zapiszmecz">Zapisz</button>
			</div>
		</div>

		<div class="row podstrona panellig" id="listameczow">
			<div class="row">
				<div class="col-xs-10"></div>
				<div class="col-xs-2">
					<button id="dodajmecz" class="btn btn-lg btn-info">
						<?php
						if(isset($user))
							echo 'Edytuj';
						else
							echo 'Zobacz';
						?>
					</button>
				</div>
			</div>

			<div class="col-xs-2" id="prev">
				<img src="../img/next2.png"/>
			</div>

			<div class="col-xs-8" id="meczekontent">
				<input id="nrmecz" type="hidden"/>
				<input id="iddruz1" type="hidden"/>
				<input id="iddruz2" type="hidden"/>

				<div class="row">
					<div class="col-xs-12">
						<h3 id="kolejka" style="text-align: center;"></h3>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6">
						<h2 id="druzyna1" style="text-align: center;"></h2>
					</div>
					<div class="col-xs-6">
						<h2 id="druzyna2" style="text-align: center;"></h2>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<b><h1 id="wynik" style="text-align: center;"></h1></b>
					</div>
				</div>				
			</div>

			<div class="col-xs-2" id="next">
				<img src="../img/next.png">
			</div>
		</div>

		<div class="row" id="druzynyl">
			<div class="col-xs-1">
				<img src="../img/plus.png" class="img-responsive"/>
			</div>
			<div class="col-xs-5">
				<h2>Drużyny</h2>
			</div>
		</div>

		<div class="row podstrona panellig" id="listadruzyn">
			<div class="col-xs-3"></div>
			<div class="col-xs-9">
				<ol class="list-group" style="margin-left: 10%;">

				</ol>
			</div>
		</div>

		<div class="row" id="bramki">
			<div class="col-xs-1">
				<img src="../img/plus.png" class="img-responsive"/>
			</div>
			<div class="col-xs-5">
				<h2>Bramki</h2>
			</div>
		</div>

		<div class="row podstrona panellig" id="listabramek">
			<div class="col-xs-12">
				<div class="table-responsive">
					<table id="tabbramki" class="table table-bordered table-striped table-hover" width="100">
						<thead>
							<tr>
								<th>Lp.</th>
								<th>Imię i nazwisko</th>
								<th>Klub</th>
								<th>Zdobyte bramki</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row" id="statystyki">
			<div class="col-xs-1">
				<img src="../img/plus.png" class="img-responsive"/>
			</div>
			<div class="col-xs-5">
				<h2>Statystyki</h2>
			</div>
		</div>

		<div class="row podstrona panellig" id="listastat">
			<div class="col-xs-12">
				<div class="table-responsive">
					<table id="tabstat" class="table table-bordered table-striped table-hover" width="100">
						<thead>
							<tr>
								<th>Drużyna</th>
								<th>Mecze</th>
								<th>Bramki zdobyte</th>
								<th>Bramki stracone</th>
								<th>Punkty</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php require_once 'mecz.php';?>