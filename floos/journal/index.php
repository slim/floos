<?php
	require "../../lib/compte.php";
	Compte::$db = new PDO('sqlite:../../floos.db');
	Compte::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

$compte = Compte::charger($_GET['compte']);
$ecritures = $compte->journal($_GET['debut'], $_GET['fin']);
$ecritures->setFetchMode(PDO::FETCH_ASSOC);

$html = <<<EOT
<html>
<head>
<title>Journal comptable - FLOOS</title>
</head>
<body>
<table>
EOT;

foreach ($ecritures as $e) {
	$html .= "<tr>";
	foreach ($e as $c) {
		$html .= "<td style='border: 1px solid silver; padding: 10px;'>$c</td>";
	}
	$html .= "</tr>";
}
$html .= "</table></body></html>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: FLOOS <floos@alixsys.com>' . "\r\n";

if (mail($compte->id, "Journal Comptable", $html, $headers)) {
	echo "<b>Un email vous a été envoyé</b>";
} else {
	echo "<b>Erreur d'envoi</b>";
}
