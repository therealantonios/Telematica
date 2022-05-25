
<?php

   //require("config.php");

    $user="root"; 
    $password=""; 
    $host="localhost"; 
    $database="biblioteca";

    $test=@mysqli_connect($host, $user, $password,$database) or die("Unable to select database");
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
            // query database for user
            $query="SELECT * FROM utente WHERE email = '".$_POST['email']."' ";
            $rows = $test->query($query);

           
            if (mysqli_num_rows($rows) > 0)
            {
               $message = "esiste già un utente con questa email";
               echo "<script type='text/javascript'>alert('$message');</script>";

               header("refresh:0.1; url=registrazione.html");  
            exit;
                
            }
               else
               {
                    $email = $_POST["email"];
                    $citta = $_POST["citta"];
                    $via = $_POST["via"];
                    $numero = $_POST["numero"];
                    $password = $_POST["password"];
                    $criptato = crypt($password, "sd");

                    $createUtente = "INSERT INTO utente (id, email, password, citta, via, numeroCivico) VALUES ('', '$email', '$criptato', '$citta','$via','$numero')";
                    

                    if ($test->query($createUtente) === TRUE) {
                      echo "Registrazione completata!!!!!!";
                      echo "\n";
                      echo "Sarai reindirizzato fra 3 secondi"; 
                      header('Refresh: 3; url=login.html');  
                      

                    } 
                    else {
                        echo "Errore durante la registrazione.Si prega di riprovare";
                        echo "\n";
                        echo "Sarai reindirizzato fra 3 secondi"; 
                        header('Refresh: 3; url=registrazione.html');  
                    }

                    
               }
        
    }
    
    else
    {
        header("Location: registrazione.html");
    }


    mysqli_close($test);
?>
