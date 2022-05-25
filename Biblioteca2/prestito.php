<?php

	session_start();
	$_SESSION['idLibro']=$_GET['id'];

?>

<!DOCTYPE html>
<html>
<body>

<p>Scegli la data di scadenza del prestito :</p>

<form action="confermaPrestito.php" method="GET">
  <input type="date" id="date" name="date" required><br><br>
  <input type="submit" value="Conferma">
</form>

	<br><br><br><br>
	<a href="libri.php">Torna alla pagina di ricerca</a>
	<br>
	<a href="index.html">Torna alla home</a>


<script type="text/javascript">

	var dataOggi = new Date(); 
	var anno = dataOggi.getFullYear(); 
	var mese = dataOggi.getMonth() + 1;  
	var giorno = dataOggi.getDate();     
	
	var today = anno.toString().padStart(4, 0) + "-" + mese.toString().padStart(2, 0) + "-" + giorno.toString().padStart(2, 0);
	var dataScadenza = document.getElementById("date"); 

	function impostaDataMin(data){
	    data.value = today;
	    data.setAttribute("min",today);
	}

	impostaDataMin(dataScadenza); 
	
	
</script>


</body>
</html>
