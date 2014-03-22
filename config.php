<?php
	error_reporting(E_ALL);
	ini_set('display_errors', True);

	define("ROOT", dirname(__FILE__) ."/"); 
	define("HTTP", ($_SERVER["HTTP_HOST"] == "localhost")
	   ? "http://localhost/chekkit/"
	   : "http://chekk.it/"
	); 
	define("LIBRARY", ROOT . "lib/functions.php");

	// Require Functions
	require ROOT . 'classes/mcmyadmin.class.php';
	require ROOT . 'classes/Requests.php';
	Requests::register_autoloader();
	require LIBRARY;


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		define("USERNAME", htmlspecialchars($_POST['username']));
		define("PASSWORD", strval($_POST['password']));
		define("HOST", sanitize($_POST['host']));
		if (!$_POST['port']) {
			define("PORT", intval(8080));
		}else{
			define("PORT", intval($_POST['port']));
		}

	}

?>