<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?php echo $_GET['categorie'] ?></title></head>
<body>
<form method="post" action="../debit/" >
<input type="hidden" name="c" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />
<input type="hidden" name="compte" value="<?php echo $_GET['compte'] ?>" />
<input type="hidden" name="categorie" value="<?php echo $_GET['categorie'] ?>" />
<label>Débit<br />
<input type="text" name="montant" size="6"/>
</label><br />
<label>Libellé<br />
<input type="text" name="libelle" />
</label><br />
<input type="submit" />
</form>
<p>Astuce: Mettez un signet a cette page pour y revenir plus tard</p>
</p>
</body>
