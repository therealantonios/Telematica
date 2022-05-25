<?php

if(isset($_COOKIE['login']))
{
    session_start();  
    $_SESSION['idUtente']=$_COOKIE['login'];
    header("Location: libri.php");
}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>


<form action="login.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="email" placeholder="email" type="email" required/>
        </div>
        <div class="control-group">
            <input name="password" placeholder="Password" type="password" required/>
        </div>
        <br>
        <div class="control-group">
            <button type="submit" class="btn">Login</button>
        </div>
    </fieldset>
</form>


<br>
<div>
     <a href="index.html">Torna nella pagina iniziale</a> 
</div>

<div>
     <a href="registrazione.html">Se non hai un account vai a registrati</a> 
</div>

<div>
     <a href="impostaPassword.html">Password dimenticata</a> 
</div>


</body>
</html>