<?php
require_once "../model/DB.php";

if(filter_has_var(INPUT_POST, "idliga")){
	$idliga=filter_input(INPUT_POST, "idliga");

	if(filter_has_var(INPUT_POST, "zatw")){
		$dane=generuj($idliga);
		zatwierdz($dane);
	}
	else
		generuj($idliga);
}

function generuj($idliga){
	$DB=new DB();
	$matcheslist=[];
	$matcheslistStr=[];
	
	$druzyny=$DB->wybierz("druzyny", "id_druzyna", "all", ["id_liga", $idliga], null, null);
	$druzynyStr=$DB->wybierz("druzyny", "nazwa_druzyna", "all", ["id_liga", $idliga], null, null);

	$teams=count($druzyny);

	$ghost=false;
	if($teams%2===1){
		$teams++;
		$ghost=true;
	}

	$totalRounds=$teams-1;
	$matchesPerRound=$teams/2;

	$rounds;
	$roundsStr;

	for($round=0; $round<$totalRounds; $round++){

		for($match=0; $match<$matchesPerRound; $match++){

			$home=($round+$match)%($teams-1);
			$homestring=$druzynyStr[$home][0];
			$homeint=$druzyny[$home][0];
			$away=($teams-1-$match+$round)%($teams-1);
			$awayint=$druzyny[$away][0];
			$awaystring=$druzynyStr[$away][0];

			if($match===0){
				$away=$teams-1;
				if($away==count($druzyny)){
					array_push($druzyny, 0);
					array_push($druzynyStr, "Wolny los");
					$awayint=$druzyny[$away][0];
					$awaystring=$druzynyStr[$away][0];
				}
				else
					$awayint=$druzyny[$away][0];

				$awaystring=$druzynyStr[$away][0];
			}

			$rounds[$round][$match]=$homeint." v ".$awayint;
			$roundsStr[$round][$match]=$homestring." v ".$awaystring;
		}
	}


	$interleaved;
	$interleavedStr;
	$evn=0;
	$evnStr=0;
	$odd=($teams/2);
	$oddStr=($teams/2);

	for($i=0; $i<count($rounds); $i++){
		if($i%2===0){
			$interleaved[$i]=$rounds[$evn++];
			$interleavedStr[$i]=$roundsStr[$evnStr++];
		}
		else{
			$interleaved[$i]=$rounds[$odd++];
			$interleavedStr[$i]=$roundsStr[$oddStr++];
		}
	}

	$rounds=$interleaved;
	$roundsStr=$interleavedStr;

	for($round=0; $round<count($round); $round++){
		if($round%2==1){
			$rounds[$round][0]=flip($rounds[$round][0]);
			$roundsStr[$round][0]=flip($roundsStr[$round][0]);
		}
	}

	for($i=0; $i<count($rounds); $i++){
		for($j=0; $j<$matchesPerRound; $j++){
			$slowa=explode(" v ", $rounds[$i][$j]);
			$slowaStr=explode(" v ", $roundsStr[$i][$j]);

			$sd=[$idliga, $i+1, $slowa[0], null, $slowa[1], null];
			$sdStr=[$i+1, $slowaStr[0], $slowaStr[1]];

			array_push($matcheslist, $sd);
			array_push($matcheslistStr, $sdStr);
		}
	}

	for($round=0; $round<count($rounds); $round++){
		for($j=0; $j<$matchesPerRound; $j++){
			$rounds[$round][$j]=flip($rounds[$round][$j]);
			$roundsStr[$round][$j]=flip($roundsStr[$round][$j]);
		}

		for($j=0; $j<$matchesPerRound; $j++){
			$slowa=explode(" v ", $rounds[$round][$j]);
			$slowaStr=explode(" v ", $roundsStr[$round][$j]);

			$sd=[$idliga, $i+1, $slowa[0], null, $slowa[1], null];
			$sdStr=[$i+1, $slowaStr[0], $slowaStr[1]];

			array_push($matcheslist, $sd);
			array_push($matcheslistStr, $sdStr);
		}
	}

	echo json_encode($matcheslistStr);
	return $matcheslist;
}

function zatwierdz($wartosci){
	$DB=new DB();
	$kolumny=["id_liga", "kolejka", "id_druzyna1", "bramki_druzyna1", "id_druzyna2", "bramki_druzyna2"];

	for($i=0; $i<count($wartosci); $i++){
		$DB->dodaj("mecze", $kolumny, $wartosci[$i]);
	}
}

function flip($match){
	$components=explode(" v ", $match);
	return $components[1]." v ".$components[0];
}