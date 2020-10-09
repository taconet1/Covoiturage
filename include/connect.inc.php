<?php
	$db = mysqli_connect (DBHOST, DBUSER , DBPASSWD) or die("Veuillez nous excuser : erreur système");
	mysqli_select_db($db,DBNAME) or die("Veuillez nous excuser : erreur système");
?>

