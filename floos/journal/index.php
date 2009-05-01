<?php
	require "../../lib/compte.php";
	Compte::$db = new PDO('sqlite:../../floos.db');
	Compte::$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

$compte = Compte::charger($_GET['compte']);
$ecritures = $compte->journal($_GET['debut'], $_GET['fin']);
$ecritures->setFetchMode(PDO::FETCH_ASSOC);

$html = <<<EOT
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Journal comptable</title>
<style type="text/css">

table, tr, td, th {
       margin: 0px;
	   padding: 5px;
       border-width: 0px;
       border-spacing: 0px;
       border-collapse: collapse;
	   font-style: fixed;
	   white-space: nowrap;
}
table tr td {border: solid 1px silver;}
table tr th {border: solid 1px grey;}
#error {
	background-color: yellow;
	border: 2px solid red;
	padding: 10px;
	margin: 10px;
}
pre {
	color: silver;
	background-color: black;
	padding: 10px;
	margin: 10px;
}
</style></head>
<body>
<table>
<thead>
<tr><th>date</th><th>catégorie</th><th>libellé</th><th>débit</th><th>crédit</th></tr>
</thead>
<tbody>
EOT;

foreach ($ecritures as $e) {
	$date      = $e['date'];
	$categorie = $e['categorie'];
	$libelle   = $e['libelle'];
	$debit     = $e['debit'];
	$credit    = $e['credit'];

	$html .= "<tr>";
	$html .= "<td>$date</td>";
	$html .= "<td>$categorie</td>";
	$html .= "<td>$libelle</td>";
	$html .= "<td>$debit</td>";
	$html .= "<td>$credit</td>";
	$html .= "</tr>";
}
$html .= "</tbody></table></body></html>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: FLOOS <floos@alixsys.com>' . "\r\n";

if (mail($compte->id, "Journal Comptable", $html, $headers)) {
	echo "<b>Un email vous a été envoyé</b>";
} else {
	echo "<b>Erreur d'envoi</b>";
}
