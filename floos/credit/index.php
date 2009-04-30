<?php
	require "../../lib/compte.php";
	Compte::$db = new PDO('sqlite:../../floos.db');
	Compte::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

$compte = Compte::charger($_POST['compte']);
$compte->crediter($_POST['montant'], $_POST['categorie'], $_POST['libelle']);

header("Location: ". $_POST['c'], TRUE, 303 );
