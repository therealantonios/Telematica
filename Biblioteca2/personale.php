<?php

	$user="root"; 
    $password=""; 
    $host="localhost"; 
    $database="biblioteca";

    session_start();

    $test=@mysqli_connect($host, $user, $password,$database) or die("Unable to select database");

    $id=$_SESSION['idUtente'];

   
	$utente="SELECT *
    		 FROM utente
    	     WHERE utente.id='$id' ";

    $risultatoUtente=$test->query($utente);


    while($rows = $risultatoUtente->fetch_assoc()){

	 	echo '<h2>Benvenuto '.$rows['email'].'</h2>';
		echo "<br>"; echo "<br>";
	}

    $prestitiAttuali="SELECT *
    				 FROM prestito JOIN libro ON prestito.libro=libro.idLibro
    				 	  JOIN utente ON prestito.utente=utente.id
    				 WHERE utente.id='$id' and prestito.stato='in corso' ";

    $risultato=$test->query($prestitiAttuali);

    echo '<h2>Libri con prestito in corso : premi sui libri per restituire il libro</h2>';

    if (mysqli_num_rows($risultato) < 1)
    {
        echo "Attualmente non hai dei prestiti in corso";
    }
    else
    {
        while($rows = $risultato->fetch_assoc()){
        	
            $date = date('Y-m-d');
            $secOggi = strtotime($date);
            $secLibro = strtotime($rows['dataFine']);

            if($secOggi > $secLibro){
                $libro=$rows['libro'];
                $updateStato= "UPDATE prestito SET stato='non restituito' WHERE libro='$libro' AND utente='$id'";
                $aggiornamento=$test->query($updateStato);
            }
            else{
                echo "<a href ='confermaRestituzione.php?id=".$rows['idLibro']."'> Titolo : ".$rows['titolo']." , Fine prestito : ".$rows['dataFine']."</a>" ;
                echo "<br>"; 
            }

        }
    }


    echo "<br>";echo "<br>";echo "<hr>";echo "<br>";echo "<br>";



    $prestitiVecchi="SELECT *
    				 FROM prestito JOIN libro ON prestito.libro=libro.idLibro
    				 	  JOIN utente ON prestito.utente=utente.id
    				 WHERE utente.id='$id' and prestito.stato='restituito' ";

    $risultato=$test->query($prestitiVecchi);

    echo '<h2>Libri già restituiti : </h2>';

    if (mysqli_num_rows($risultato) < 1)
    {
        echo "Non hai dei prestiti precedenti";
    }
    else
    {
        while($rows = $risultato->fetch_assoc()){
        	echo "Titolo : " , $rows['titolo'] , " , Fine prestito : " , $rows['dataFine'];
            echo "<br>"; 
        }
    }


    echo "<br>";echo "<br>";echo "<hr>";echo "<br>";echo "<br>";


    $prestitiNonRestituiti="SELECT *
    				 FROM prestito JOIN libro ON prestito.libro=libro.idLibro
    				 	  JOIN utente ON prestito.utente=utente.id
    				 WHERE utente.id='$id' and prestito.stato='non restituito' ";

    $risultato=$test->query($prestitiNonRestituiti);

    echo '<h2>Libri non restituiti : premi sui libri per restituire il libro</h2>';

    if (mysqli_num_rows($risultato) < 1)
    {
        echo "Non hai dei libri da restituire";
        $updateMorosoFalse = "UPDATE utente SET moroso=0 WHERE id='$id'";
        $aggiornamentoFalse=$test->query($updateMorosoFalse);
    }
    else
    {
        $updateMorosoTrue = "UPDATE utente SET moroso=1 WHERE id='$id'";
        $aggiornamentoTrue=$test->query($updateMorosoTrue);

        echo('<script language="javascript"> alert("Per noleggiare un nuovo libro devi restituire tutti i libri !!!"); </script>');
        while($rows = $risultato->fetch_assoc()){
        	echo "<a href ='confermaRestituzione.php?id=".$rows['idLibro']."'> Titolo : ".$rows['titolo']." , Fine prestito : ".$rows['dataFine']."</a>" ;
            echo "<br>"; 
        }
    }

    $test->close();
?>


<!DOCTYPE html>
<html>
<body>
	<br><br><br>
	<a href="index.html">Torna alla home</a>
    <br>
    <a href="libri.php">Torna alla pagina precedente</a>
</body>
</html>