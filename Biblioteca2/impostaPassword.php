<?php

	$user="root"; 
    $password=""; 
    $host="localhost"; 
    $database="biblioteca";

    $test=@mysqli_connect($host, $user, $password, $database) or die("Unable to select database");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	$email=$_POST['email'];
    	$citta=$_POST['citta'];
    	$via=$_POST['via'];
    	$civico=$_POST['civico'];
    	$password=$_POST['password'];
    	$query="SELECT * FROM utente WHERE email='$email' AND citta='$citta' AND via='$via' AND numeroCivico='$civico'";
    	$rows = $test->query($query);

        if (mysqli_num_rows($rows) < 1)
        {
        	 echo "<script type='text/javascript'>alert('Non esistono utenti con questi dati');</script>";
             header("refresh:0.1; url=impostaPassword.html");
        }
        else
        {
        	$criptato = crypt($password, "sd");
        	$update="UPDATE utente SET password='$criptato' WHERE email='$email'";
        	if($test->query($update))
        	{
        		echo "<script type='text/javascript'>alert('Password modificta con successo!!');</script>";
             	header("refresh:0.1; url=login.html");
        	}
        	else
        	{
        		echo "<script type='text/javascript'>alert('Si è verificato un errore');</script>";
             	header("refresh:0.1; url=impostaPassword.html");
        	}
        }
    }
    else
    {
        header("location:impostaPassword.html");
    }
?>