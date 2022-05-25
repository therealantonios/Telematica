
<?php

	$user="root"; 
    $password=""; 
    $host="localhost"; 
    $database="biblioteca";

    session_start();

    $id=$_SESSION['idUtente'];

    $test=@mysqli_connect($host, $user, $password,$database) or die("Unable to select database");

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $utenteMoroso = 0;

        $queryMoroso="SELECT * FROM utente  
                          WHERE id = '$id'";
        $risultato=$test->query($queryMoroso);
        while($row = $risultato->fetch_assoc()){
            if($row['moroso'] == 1){
                $utenteMoroso = 1;
            }
        }

        if(empty($_GET["autore"]) && empty($_GET["genere"]) && empty($_GET["titolo"])){
            header("Location: libri.php");
        }

        // validate submission
        if (empty($_GET["autore"]) && empty($_GET["genere"]))
        {

        	$titolo=$_GET['titolo'];
        	$query="SELECT * FROM libro  
        			WHERE titolo = '$titolo' OR titolo LIKE '%$titolo%' ";
        	$risultato=$test->query($query);

        	if (mysqli_num_rows($risultato) < 1)
            {
               echo "Questo libro non è presente nella biblioteca!";
            }
            else
            {
            	echo "Questo libro è presente nella biblioteca in ", mysqli_num_rows($risultato) , " copie";
            	echo "<br>";
            	while($rows = $risultato->fetch_assoc()){
                        if($rows['disponibile'] == 1 and $utenteMoroso == 0){
                            echo "<a href ='prestito.php?id=".$rows['idLibro']."'> Titolo : ".$rows['titolo']."</a>" ;
                            echo " , Data : " , $rows['pubblicazione'] , " , Casa editrice : " , $rows['casaEditrice'];
                            echo "<br>";
                        }
                        else{
                    		echo " Titolo : ", $rows['titolo'] , " , Data : " , $rows['pubblicazione'] , " , Casa editrice : " , $rows['casaEditrice'];
                    		echo "<br>";
                        }
                    }
            }
        }
        if (empty($_GET["titolo"]) && empty($_GET["autore"]))
        {

        	$genere=$_GET['genere'];
        	$query="SELECT * FROM libro JOIN genere ON libro.genere=genere.id
        			WHERE genere.id='$genere'";
        	$risultato=$test->query($query);
            echo "Listi dei libri con questo genere : ", mysqli_num_rows($risultato);
            echo "<br>";
            while($rows = $risultato->fetch_assoc()){

               if($rows['disponibile'] == 1 and $utenteMoroso == 0){
                        echo "<a href ='prestito.php?id=".$rows['idLibro']."'> Titolo : ".$rows['titolo']."</a>" ;
                        echo " , Data : " , $rows['pubblicazione'] , " , Casa editrice : " , $rows['casaEditrice'];
                        echo "<br>";
                }
                else{
                        echo " Titolo : ", $rows['titolo'] , " , Data : " , $rows['pubblicazione'] , " , Casa editrice : " , $rows['casaEditrice'];
                        echo "<br>";
                }

            }    

        }
        if (empty($_GET["titolo"]) && empty($_GET["genere"]))
        {

        	$autore=$_GET['autore'];
        	$query="SELECT * FROM libro JOIN composizione on libro.idLibro=composizione.libro
        				JOIN autore on composizione.autore=autore.id
        			WHERE autore.nome = '$autore' OR autore.nome LIKE '%$autore%'";
        	$risultato=$test->query($query);

        	if (mysqli_num_rows($risultato) < 1)
            {
               echo "Non sono presenti libri di questo autore in questa biblioteca!";
            }
            else
            {
            	echo "I libri presenti in questa biblioteca sono : ", mysqli_num_rows($risultato);
            	echo "<br>";
            	while($rows = $risultato->fetch_assoc()){
                    if($rows['disponibile'] == 1 and $utenteMoroso == 0){
                            echo "<a href ='prestito.php?id=".$rows['idLibro']."'> Titolo : ".$rows['titolo']."</a>" ;
                            echo " , Data : " , $rows['pubblicazione'] , " , Casa editrice : " , $rows['casaEditrice'];
                            echo "<br>";
                    }
                    else{
                            echo " Titolo : ", $rows['titolo'] , " , Data : " , $rows['pubblicazione'] , " , Casa editrice : " , $rows['casaEditrice'];
                            echo "<br>";
                    }

            	}
            }
        }
        
    }
    $test->close();

?>

<!DOCTYPE html>
<html>
</head>
<body>
	<br><br><br><br>
	<a href="libri.php">Torna alla pagina precedente</a>
	<br>
	<a href="index.html">Torna alla home</a>
</body>
</html>