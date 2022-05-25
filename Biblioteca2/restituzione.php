
<?php

	$user="root"; 
    $password=""; 
    $host="localhost"; 
    $database="biblioteca";

    session_start();

    $test=@mysqli_connect($host, $user, $password,$database) or die("Unable to select database");

    $id=$_SESSION['idUtente'];
    $idLibro=$_SESSION['libroRestituito'];

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	$updatePrestito="UPDATE prestito SET stato='restituito' WHERE utente='$id' and libro='$idLibro'";
    	if($test->query($updatePrestito)){

    		$updateLibro="UPDATE libro SET disponibile=1 WHERE idLibro='$idLibro'";
    		if($test->query($updateLibro)){
    			echo "Il libro è stato restituito con successo!!!";
    		}
    		else {
    			echo "Si è verificato un problema nella restituzione del libro.";
    		}

    	}else{
    		echo "Si è verificato un problema nella restituzione del libro.";
    	}

    }

    $test->close();

?>


<!DOCTYPE html>
<html>
<body>
	<br><br><br><br>
	<a href="personale.php">Torna alla sezione personale</a>
	<br>
	<a href="index.html">Torna alla home</a>
</body>
</html>