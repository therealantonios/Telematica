<!DOCTYPE html>
<html>
<head>
	<title>Libri</title>
    <style>
    #link {
      background-color: #f44336;
      color: white;
      padding: 14px 25px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }

    #link{
      background-color: red;
    }
</style>
</head>
<body>

    <a id="link" href="personale.php" style="position:absolute; top:18px; left:1100px">Vai nella tua sezione personale</a>

	<h1>Cerca per titolo:</h1>
	<form action="cercaLibro.php" method="get">
    <fieldset>
        <div class="control-group">
            <input autofocus name="titolo" placeholder="titolo" type="text"/>
        </div>
        <br>
        <div class="control-group">
            <button type="submit" class="btn">Cerca</button>
        </div>
    </fieldset>
	</form>

	<hr>

	<h1>Cerca per genere:</h1>
	<form action="cercaLibro.php" method="get">
    <fieldset>
        <div class="control-group">
            <select name = "genere">
			<?php
	      $user="root"; 
				$password=""; 
				$host="localhost"; 
				$database="biblioteca";

        session_start();

				$test=@mysqli_connect($host, $user, $password,$database) or die("Unable to select database");

	        	$query="SELECT * FROM genere ";
		        $rows = $test->query($query);

	            while($risultato = $rows->fetch_assoc()){
            ?>
            <option value="<?= $risultato['id'];?>"><?= $risultato['nome'] ?></option> 
        <?php } ?>
			</select>
        </div>
        <br>
        <div class="control-group">
            <button type="submit" class="btn1">Cerca</button>
        </div>
    </fieldset>
	</form>

	<hr>

	<h1>Cerca per autore:</h1>
	<form action="cercaLibro.php" method="get">
    <fieldset>
        <div class="control-group">
            <input autofocus name="autore" placeholder="autore" type="text"/>
        </div>
        <br>
        <div class="control-group">
            <button type="submit" class="btn2">Cerca</button>
        </div>
    </fieldset>
	</form>

     <br>
     <br>
     <a href="index.html">Torna alla pagina principale</a>


</body>
</html>