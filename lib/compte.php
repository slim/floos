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
		$req = self::$db->prepare("insert into journal_comptable (compte, date, categorie, libelle, debit) values (:compte, :date, :categorie, :libelle, :montant)");

		$req->bindValue(':compte',$this->id);
		$req->bindValue(':date', date('c'));
		$req->bindValue(':categorie', $categorie);
		$req->bindValue(':libelle', $libelle);
		$req->bindValue(':montant', $montant);

		$req->execute();
	}

	function crediter($montant, $categorie, $libelle = '')
	{
		$query = "insert into journal_comptable (compte, date, categorie, libelle, credit) values ('$compte', '$date', '$categorie', '$libelle', $montant)";
		$req = self::$db->prepare("insert into journal_comptable (compte, date, categorie, libelle, credit) values (:compte, :date, :categorie, :libelle, :montant)");

		$req->bindValue(':compte',$this->id);
		$req->bindValue(':date', date('c'));
		$req->bindValue(':categorie', $categorie);
		$req->bindValue(':libelle', $libelle);
		$req->bindValue(':montant', $montant);

		$req->execute();
	}

	function journal($debut, $fin)
	{
		$compte = $this->id;
		$query = "select * from journal_comptable where compte='$compte' and date between '$debut' and '$fin'";
		return self::$db->query($query);
	}
}
