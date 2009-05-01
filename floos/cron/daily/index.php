<?php
	$db = new PDO('sqlite:../../../floos.db');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

	$db->query("delete from journal_comptable where categorie like 'test'");
