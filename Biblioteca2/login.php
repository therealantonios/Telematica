<?php


    $user="root"; 
    $password=""; 
    $host="localhost"; 
    $database="biblioteca";

    $test=@mysqli_connect($host, $user, $password, $database) or die("Unable to select database");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        	$query="SELECT * FROM utente WHERE email = '".$_POST['email']."' ";
            $rows = $test->query($query);

            $risultato=mysqli_fetch_assoc($rows);

           
            if (mysqli_num_rows($rows) < 1)
            {
               echo('<script language="javascript"> alert("Non esiste un utente con questa mail!"); </script>');
               header("refresh:0.1; url=login.html");
               
            }
            else
            {
            	if ($risultato['password'] == crypt($_POST["password"], "sd")){
                    session_start();  
                    $_SESSION['idUtente']=$risultato['id'];
                    setcookie('login', $risultato['id'], time()+604800); 
                    header("Location: libri.php");
                    
                }
                else{
                    echo('<script language="javascript"> alert("Password errata!"); </script>');
                    header("refresh:0.1; url=login.html");
                     
                }
        }
    }
    else
    {
        header("Location: login.html");
    }

    mysqli_close($test);

?>