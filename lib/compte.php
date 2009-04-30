<?php

class Compte
{
	static $db;
	public $id;

	static function charger($id)
	{
		$compte = new Compte;
		$compte->id = $id;
		return $compte;
	}

	function debiter($montant, $categorie, $libelle = '')
	{
		$compte = $this->id;
		$date = date('c');
		$query = "insert into journal_comptable (compte, date, categorie, libelle, debit) values ('$compte', '$date', '$categorie', '$libelle', $montant)";
		self::$db->exec($query);
	}

	function crediter($montant, $categorie, $libelle = '')
	{
		$compte = $this->id;
		$date = date('c');
		$query = "insert into journal_comptable (compte, date, categorie, libelle, credit) values ('$compte', '$date', '$categorie', '$libelle', $montant)";
		self::$db->exec($query);
	}

	function journal($debut, $fin)
	{
		$compte = $this->id;
		$query = "select * from journal_comptable where compte='$compte' and date between '$debut' and '$fin'";
		return self::$db->query($query);
	}
}
