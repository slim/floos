<html>
<head><title>Recevoir un journal</title></head>
<body>
<form method="get" action="../journal/" >
<label>Votre e-mail<br />
<input type="text" name="compte" />
</label><br />
<label>Debut période<br />
<input type="text" name="debut" value="<?php print date('Y') ?>-01-01"/>
</label><br />
<label>Fin période<br />
<input type="text" name="fin" value="<?php print date('Y') ?>-12-31"/>
</label><br />
<input type="submit" />
</form>
</body>
