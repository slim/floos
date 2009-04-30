<?php
	require "../../lib/compte.php";
	Compte::$db = new PDO('sqlite:../../floos.db');
	Compte::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

$compte = Compte::charger($_GET['compte']);
$ecritures = $compte->journal($_GET['debut'], $_GET['fin']);

$html = "<table>";
foreach ($ecritures as $e) {
	$html .= "<tr>";
	foreach ($e as $c) {
		$html .= "<td>$c</td>";
	}
	$html .= "</tr>";
}
$html .= "</table>";
if (mail($compte->id, "Journal Comptable - FLOOS", $html)) {
	echo "<b>Un email vous a été envoyé</b>";
} else {
	echo "<b>Erreur d'envoi</b>";
}
