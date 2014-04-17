<?php
	define("ROOT", __DIR__ ."/"); 
	define("HTTP", ($_SERVER["HTTP_HOST"] == "localhost")
	   ? "http://localhost/chekkit/"
	   : "http://chekk.it/"
	); 
	define("FUNCTIONS", ROOT . "lib/functions.php");

	// Add MC Query Class
	require ROOT . 'assets/classes/MinecraftQuery.class.php';
?>