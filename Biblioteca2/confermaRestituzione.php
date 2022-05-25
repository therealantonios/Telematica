<?php

	session_start();

	$_SESSION['libroRestituito']=$_GET['id'];

?>


<!DOCTYPE html>
<html>
<body>

<p>Premi sul pulsante per restituire il libro oppure torna nella pagina precedente :</p>

<form action="restituzione.php" method="GET">
  <input type="submit" value="Conferma">
</form>

	<br><br><br><br>
	<a href="personale.php">Torna alla pagina precedente</a>
	<br>
	<a href="index.html">Torna alla home</a>

</body>
</html>