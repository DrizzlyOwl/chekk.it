<?php

/**********************************
 * DO EVERYTHING
 **********************************/
function construct_Chekkit(){

	$query = init_MinecraftQuery();

	$our_data = $query->getPlugins($query);

	$our_plugins = fetch_Plugins($our_data);

	$curl_urls = collab_Curl($our_plugins);

	$curl = do_Curl($curl_urls);

	$collate = tidy_Data($curl,$our_plugins);

	return $collate;
}

/**
 * Creates array of our plugins with relevant data to compare
 * @param  [obj] $our_plugins [Query object from MCMA]
 * @return [arr] 
 */
function fetch_Plugins($our_plugins){
	$our_plugins = $our_plugins->plugins;
	$plugins = array();
	foreach ($our_plugins as $plugin) {
		$name = $plugin->Name;
		$version = $plugin->Version;
		$slug = strtolower($name);
		$plugins[] = array($slug,$version,$name);
	}
	return $plugins;
}

/**
 * Performs sanitization of domain/IP that user has
 * given us
 * @param  [str] $domain [Server domain / IP]
 * @return [str]         [Sanitized domain/IP]
 */
function sanitize($domain){
	$domain = htmlspecialchars($domain);
	// in case scheme relative URI is passed, e.g., //www.server.com/
	$domain = trim($domain, '/');
	// If scheme not included, prepend it
	if (!preg_match('#^http(s)?://#', $domain)) {
	    $domain = 'http://' . $domain;
	}
	
	$urlParts = parse_url($domain);
	// Always use just the domain host
	$host = $urlParts['host'];
	// remove www
	$domain = preg_replace('/^www\./', '', $host);
	// remove whitespace
	$domain = preg_replace('/\s+/', '', $domain);
	// Sanitize domain
	$clean_domain = filter_var($domain, FILTER_SANITIZE_ENCODED);	

	return $clean_domain;
}



/**
 * Instantiates the MinecraftQuery Class
 * @return [object]        [Returns Server data as object]
 */
function init_MinecraftQuery(){
	$mcmyadmin = new McMyAdmin(USERNAME,PASSWORD,HOST,PORT);
	try{
	  $connect = $mcmyadmin->getStatus();
	  if ($connect) {
	  	$status = $connect->status;
	  	if ($status === 200) {
	  		return $mcmyadmin;
	  	}else{
	  		echo "<code>Connection Not established!</code>\n";
	  		exit();
	  	}
	  }
	}
	catch(Exception $e){
	  echo 'Error - Exception: ' . $e->getMessage( ), "\n";
	}
	return false;
}


/**
 * Collaborates all of the curl URLs we need for
 * each of the plugins
 * @param  [array] $our_plugins 
 * [An array containing all of our plugin data to search through]
 * @return [array]              [An indexed array of URLs]
 */
function collab_Curl($our_plugins){
	$host = "http://api.bukget.org/3/plugins/bukkit/";
	$curl_urls = array();
	foreach ($our_plugins as $plugin) {
		$slug = $plugin[0];
		$url = $host . $slug .
		"/latest/?fields=plugin_name,dbo_page,versions.version,versions.download";
		$curl_urls[] = $url;
	}
	return $curl_urls;
}


/**
 * Inits muti_curl using our array of URLs and prepares a
 * tidy array with decoded JSON
 * @param  [array] $data    [array of URLs to fetch from]
 * @return [obj]          [Returns Decoded object of data]
 */
function do_Curl($data) {
	$json = array();
	foreach ($data as $key => $url) {
		$response = Requests::get($url);
		$json[] = $response->body;
	}
	foreach ($json as $key => $j) {
		if (substr($j, -1) !== '"') {
			$cleanjson[] = json_decode($j);
		}
	}

	return $cleanjson;
}


/**
 * Tidies up the returned decoded data so we can
 * manipulate it on the front-end
 * @param [obj]	$their_plugins [decoded JSON object]
 * @param [arr] $our_plugins Our plugin versions
 * @return [arr] Array in it's final form! 
 */
function tidy_Data($their_plugins,$our_plugins){

	$plugin_data = array();

	foreach ($their_plugins as $plugin => $data) {
		$nicename = $data->plugin_name;
		$version_data = $data->versions;
		$latest_ver = $version_data[0]->version;
		$download = $version_data[0]->download;
		$website = $data->dbo_page;
		$latest_ver = preg_replace('/[^0-9\.]/', '', $latest_ver);

		$plugin_data[$nicename] = array(
			'latest'	=>	$latest_ver,
			'download'=>	$download,
			'website'	=>	$website
		);
	}

	$theirs = $plugin_data;

	foreach ($our_plugins as $key => $value) {
		$current = $value[1];
		$current = str_replace('"', "", $current);
		$current = str_replace("'", "", $current);
		$current = preg_replace('/[^0-9\.]/', '', $current);
		$name = $value[2];
		if (array_key_exists($name, $theirs)) {
			$theirs[$name]['current'] = $current;
		}
	}

	return $theirs;
}