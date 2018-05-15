<?php

require_once 'config.php';

class DB {

	private $db_connection = null;
	public $messages = array();

	public function __construct() {

	}

	private function databaseConnection() {
		if ($this->db_connection != null) {
			return true;
		} 
		else {
			try {
				$this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';', DB_USER, DB_PASS);
				$this->db_connection->query('SET NAMES utf8');
				$this->db_connection->query('SET CHARACTER_SET utf8_polish_ci');
				$this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db_connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				return true;
			}
			catch (PDOException $e) {
				var_dump(MESSAGE_DATABASE_ERROR . $e->getMessage());
			}
		}
		return false;
	}

	public function wybierz($tabela, $kolumny, $typ, $warunki, $dodatki, $sortowanie){
		if(is_array($kolumny))
			$kolumny=implode(", ", $kolumny);

		if($warunki!=null){
			$filtr=$this->filtruj($warunki);
			$warunek=$filtr[0];
			$klucze=$filtr[1];
			$wartosci=$filtr[2];
		}
		else{
			$warunek="";
			$klucze=null;
			$wartosci=null;
		}

		if($dodatki==null)
			$dodatki="";			

		if($sortowanie==null){
			$sortowanie="";
		}
		else
			$sortowanie=" ORDER BY $sortowanie";

		$zapytanie="SELECT $kolumny FROM $tabela $dodatki $warunek $sortowanie";

		return $this->wykonaj($zapytanie, $klucze, $wartosci, $typ);
	}

	public function dodaj($tabela, $kolumny, $wartosci){
		$klucze=[];
		$zapytanie="INSERT INTO $tabela VALUES(NULL, ";

		foreach($kolumny as $i=>$kolumna){
			$klucze[$i]=":".$kolumna;
			if($i===count($kolumny)-1)
				$zapytanie.=":".$kolumna.");";
			else
				$zapytanie.=":".$kolumna.", ";
		}

		return $this->wykonaj($zapytanie, $klucze, $wartosci, null);
	}

	public function edytuj($tabela, $kolumny, $wartosci, $warunki){
		$klucze=[];
		$kluczew=[];
		$zapytanie="UPDATE $tabela SET ";

		foreach($kolumny as $i=>$kolumna){
			$klucze[$i]=":".$kolumna;
			if($i===count($kolumny)-1)
				$zapytanie.=$kolumna." = :".$kolumna;
			else
				$zapytanie.=$kolumna." = :".$kolumna.", ";
		}

		if($warunki!=null){
			$filtr=$this->filtruj($warunki);
			$zapytanie.=$filtr[0];
			$kluczeW=$filtr[1];
			$wartosciW=$filtr[2];
		}
		else{
			$kluczeW=null;
			$wartosciW=null;
		}

		$values=array_merge($wartosci, $wartosciW);
		$keys=array_merge($klucze, $kluczeW);

		return $this->wykonaj($zapytanie, $keys, $values, null);
	}

	public function usun($tabela, $warunki){
		$klucze=[];
		$wartosci=[];
		$zapytanie="DELETE FROM $tabela";

		if($warunki!=null){
			$filtr=$this->filtruj($warunki);
			$zapytanie.=$filtr[0];
			$klucze=$filtr[1];
			$wartosci=$filtr[2];
		}
		else{
			$klucze=null;
			$wartosci=null;
		}

		return $this->wykonaj($zapytanie, $klucze, $wartosci, null);
	}

	private function filtruj($warunki){
		$zapytanie=" WHERE ";
		$klucze=[]; $wartosci=[];
		$a=0; $b=0;

		foreach($warunki as $i=>$warunek){
			if($i%3===0){
				$klucze[$a]=$warunek;
				$a++;
				$zapytanie.=$warunek." = :".$warunek." ";
			}
			elseif($i%3===1){
				$wartosci[$b]=$warunek;
				$b++;
			}
			elseif($i%3===2){
				if($warunek=="|")
					$warunek="OR";
				elseif($warunek=="&")
					$warunek="AND";

				$zapytanie.=$warunek." ";
			}
		}
		return ([$zapytanie, $klucze, $wartosci]);
	}

	private function wykonaj($zapytanie, $keys, $values, $typ){
		if($this->databaseConnection()){
			$query=$this->db_connection->prepare($zapytanie);

			if($keys!==null && $values!==null){
				foreach($values as $key=>$value){
					if(gettype($value)=='integer')
						$query->bindValue($keys[$key], $value, PDO::PARAM_INT);
					else
						$query->bindValue($keys[$key], $value, PDO::PARAM_STR);
				}
			}

			$query->execute();
			if(isset($typ) && $typ=="obj")
				return $query->fetchObject();
			elseif(isset($typ) && $typ=="all")
				return $query->fetchAll();
			elseif(isset($typ) && $typ=="col")
				return $query->fetchColumn();
			else
				return true;
		}
		else{
			return $query->errorInfo();
		}
	}

	public function zmienUprawnienia($id) {
		if ($this->databaseConnection()) {
			$query = $this->db_connection->prepare("UPDATE uzytkownicy SET typ=CASE WHEN typ=1 THEN 0 ELSE 1 END WHERE id_uzytkownik = :id");
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			$query->execute();
			$query2 = $this->db_connection->prepare("SELECT typ FROM uzytkownicy WHERE id_uzytkownik=:id");
			$query2->bindValue(':id', $id, PDO::PARAM_INT);
			$query2->execute();
			return $query2->fetchObject();
		} else {
			$this->errors[] = "Wystąpił błąd podczas połączenia z bazą danych";
			return false;
		}
	}

	public function aktualizujMecz($id_druzyna1, $id_druzyna2, $id_liga, $goleA1, $goleA2, $goleB1, $goleB2) {
		if ($this->databaseConnection()) {
			$query = $this->db_connection->prepare("CALL aktualizujMecz(:id_druzyna1, :id_druzyna2, :id_liga, :goleA1, :goleA2, :goleB1, :goleB2);");
			$query->bindValue(':id_druzyna1', $id_druzyna1, PDO::PARAM_INT);
			$query->bindValue(':id_druzyna2', $id_druzyna2, PDO::PARAM_INT);
			$query->bindValue(':id_liga', $id_liga, PDO::PARAM_INT);
			$query->bindValue(':goleA1', $goleA1, PDO::PARAM_INT);
			$query->bindValue(':goleA2', $goleA2, PDO::PARAM_INT);
			$query->bindValue(':goleB1', $goleB1, PDO::PARAM_INT);
			$query->bindValue(':goleB2', $goleB2, PDO::PARAM_INT);
			$query->execute();

			return true;
		} else {
			$this->errors[] = "Wystąpił błąd podczas połączenia z bazą danych";
			return false;
		}
	}
}
?>