<?php
/**
 * This document holds all of our functions n stuff
 */
$debug = false;

if ($debug) {
	$_POST['host'] = 'mc.shadysands.co.uk';
	$_POST['ref'] = 0000;
}

if (isset($_POST['host']) && isset($_POST['ref'])) {

	$host = $_POST['host'];
	unset($_POST);

	function sanitize($host){
		$host = preg_replace('/\s\s+/', ' ', $host);
		$host = htmlspecialchars($host);
		$host = trim($host, '/');
		if (!preg_match('#^http(s)?://#', $host)) {
		    $host = 'http://' . $host;
		}

		$urlParts = parse_url($host);
		$host = $urlParts['host'];
		$host = preg_replace('/^www\./', '', $host);
		$host = preg_replace('/\s+/', '', $host);
		$clean_domain = filter_var($host, FILTER_SANITIZE_ENCODED);	

		return $clean_domain;
	}

	$host = sanitize($host);

	$server = new MinecraftQuery();

	try {
		$server->connect($host,25565,3);
		$info = $server->GetInfo();
		$plugins = $info['Plugins'];
	} catch (MinecraftQueryException $e) {
		echo '<pre>'; print_r($e->getMessage()); echo '</pre>';
		exit();
	}

	$temp_array = array();
	$query_str = 'http://api.bukget.org/3/updates?slugs=';

	foreach ($plugins as $key => $value) {
		$temp = explode(" ", $value);
		$name = $temp[0];
		$slug = strtolower($temp[0]);
		$version = $temp[1];
		$temp_array[$slug] = array($name,$version);
		$query_str .= $slug.',';
	}

	$query_str = rtrim($query_str, ',');

	$ch = curl_init();
	 
	// 1. set the options, including the url
	curl_setopt($ch, CURLOPT_URL,	   $query_str);
	curl_setopt($ch, CURLOPT_HEADER, 			0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 		1);

	// 2. execute and fetch the resulting HTML output
	try {
		$output = curl_exec($ch);
		if ($output === FALSE) {
			throw new Exception("Error Processing cURL Request curl_error($ch);", 1);
			$status = 404;
		}else{
			$status = 200;
		}
		// 3. free up the curl handle
		curl_close($ch);
	} catch (Exception $e) {
		echo '<pre>'; print_r($e->getMessage()); echo '</pre>';
		curl_close($ch);
		exit();
	}

	switch ($status) {
		case 404:
			echo '<pre>Error '; print_r($status); echo ', unable to find cURL URL</pre>';
			exit();
			break;
		
		default:
			$output = json_decode($output);
			break;
	}

	$bukget = array();
	foreach ($output as $key => $object) {
		$slug = $object->slug;
		$versions = $object->versions;
		$latest = $versions->latest;
		$v = $latest->version;
		$download = $latest->download;

		$bukget[$slug] = array($v,$download);
	}

	$plugins = $temp_array;

	$merged = array();

	$total = count($plugins);
	$scanned = count($bukget);
	$skipped = $total - $scanned;
	$updates = 0;

	foreach ($bukget as $key => $value) {
		if (array_key_exists($key, $plugins)) {
			$current_plugin = $plugins[$key];

			$plugin_name = $current_plugin[0];
			$current_version = $current_plugin[1];
			$current_version = preg_replace("/[^0-9.]/","",$current_version);

			$latest_version = $value[0];
			$latest_version = preg_replace("/[^0-9.]/","",$latest_version);
			$latest_download = $value[1];
			
			$merged[$key] = array(
				$plugin_name,
				$current_version,
				$latest_version,
				$latest_download
			);

			if ($latest_version > $current_version) {
				$updates++;
			}
		}
	}

}else{
	header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden");
	$status = 403;
	echo '<pre>Error '; print_r($status); echo ', direct access to this file is prohibited.</pre>';
	echo '<pre><a href="'.HTTP.'">Go Back</a></pre>';
	exit();
}