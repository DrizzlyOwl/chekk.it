<!DOCTYPE html>
<?php require 'config.php'; ?>
<html data-placeholder-focus="false" data-placeholder-live="false">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chekk.it</title>
	<link rel="icon" href="<?php echo HTTP; ?>assets/images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo HTTP; ?>style.css">
	<script type="text/javascript" src="//use.typekit.net/lqr4clu.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>
<section class="main main--index" role="main"> 
	<div class="fullscreen fullscreen--home">
		<div class="wrapper--thin">
			<div class="home-centralised">
				<img src="assets/imgs/logo-light-new.png" alt="Chekk.it" class="home-logo">
					<form class="input_form" method="post" action="<?php echo HTTP; ?>url.php">
						<div class="server-name-form clear">
							<input type="text" placeholder="Server IP" name="host" class="server-name-form__input">
							<input type="hidden" name="ref" value="<?php echo rand(); ?>"> 
							<input type="submit" value="Begin" class="server-name-form__submit">
						</div>
					</form>
					<div>
					<p><strong>Type the server address above.</strong></p>
					<p class="stronger scroll-down"><strong>How does it work?</strong></p>
				</div>
			</div>
			
			<div class="home-loading">
				<h2>Loading...</h2>
			</div>
		</div>
	</div>
	<div class="about">
		<div class="wrapper--thin">
			<h2>Are your Bukkit plugins up to date?</h2> <h3>Check them all in an instant with Chekk.it</h3>
			<p>Chekk.it is a simple app to check how up to date your server plugins are compared with the latest versions located on <a href="http://dev.bukkit.org">dev.bukkit.org</a>. Chekk.it collates information from your server's plugins and compares them with the bukkit plugin database.</p>
			<p><strong>Chekk.it supports almost all native Bukkit plugins*</strong></p>
			<p class="alert">Notice: Certain child plugins won't return a version number as they are handled by the parent plugin.<br>E.g. Essentials Chat and Essentials Protect are child plugins of Essentials.<p>
			<h3>Setup</h3>
			<p>There is only one step needed before you can get started. <br>
			Just make sure that the following is set in your server.properties file:</p>
			<pre>enable-query: true</pre>
			<p>Then all you need to do is type your server IP or hostname into the input above and Chekk.it will handle the rest.</p>
			<h4 class="scroll-up">All good? Click here to begin</h4>
		</div>
	</div>
</section>
<?php require ROOT . 'footer.php'; ?>