
<?php

	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {

	    $user="root"; 
	    $password=""; 
	    $host="localhost"; 
	    $database="biblioteca";

	    $test=@mysqli_connect($host, $user, $password,$database) or die("Unable to select database");

		$idLibro = $_SESSION['idLibro'];
	    $idUtente=$_SESSION['idUtente'];
	    $data=$_GET['date'];

	    $insert="INSERT INTO prestito(libro,utente,dataFine,stato) VALUES ('$idLibro' , '$idUtente', '$data', 'in corso')";
	    $risultato = $test->query($insert);

	    $aggiornamentoLibro= "UPDATE libro
	    					  SET disponibile=0 
	    					  WHERE idLibro='$idLibro'";
	    
	    if($test->query($aggiornamentoLibro)){
	    	echo "prestito effettuato!!!!!!";
	    }
	    else{
	    	echo "si è verificato un errore";
	    }

	    $test->close();
	}

?>

<!DOCTYPE html>
<html>
<body>

	<br><br><br><br>
	<a href="libri.php">Torna alla pagina di ricerca</a>
	<br>
	<a href="index.html">Torna alla home</a>

</body>
</html>
