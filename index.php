<!DOCTYPE html>
<?php
require 'config.php';
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chekk.it</title>
	<link rel="icon" href="<?php echo HTTP; ?>assets/imgs/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo HTTP; ?>style.css">
	<script type="text/javascript" src="//use.typekit.net/lqr4clu.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>
<section class="main main--index" role="main"> 
	<div class="fullscreen fullscreen--home">
		<code>&nbsp; v0.1.0 <a href="//github.com/ashd93/chekk.it">GitHub</a></code>
		<div class="wrapper--thin">
			<div class="home-centralised">
				<img src="assets/imgs/logo-light-new.png" alt="Chekk.it" class="home-logo">
					<form class="input_form" method="post" action="<?php echo HTTP; ?>url.php">
						<div class="server-name-form clear">
							<input type="text" required placeholder="Server IP" name="host" class="server-name-form__input server_ip_input">
							<input type="text" placeholder="8080" name="port" value="8080" class="server-name-form__input server_port_input">
							<input type="text" required placeholder="MCMA Username" name="username" class="server-name-form__input server_user_input">
							<input type="password" required placeholder="MCMA Password" name="password" class="server-name-form__input server_pass_input">
							<input type="hidden" name="referral" value="<?php echo uniqid(); ?>">
							<input type="submit" value="Begin" class="server-name-form__submit">
						</div>
					</form>
					<p class="alert alert--problem alert-slidedown">Highlighted fields are required</p>

					<div>

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
			<p><strong>Chekk.it supports almost all native Bukkit plugins</strong></p>
			<p class="alert">Notice: Certain child plugins won't return a version number as they are handled by the parent plugin.<br>E.g. Essentials Chat and Essentials Protect are child plugins of Essentials.<p>
			<h3>Setup</h3>
			<p>Just make sure that you're covering these few steps and Chekk.it can start making your life easier.<p>
			<code>Must be using the latest version of McMyAdmin</code><br><br>
			<code>enable-query must be set to true in server.properties</code>
			</code>
			<p>All you need to do now is type your server IP or hostname along with your unique login details for McMyAdmin into the inputs above and Chekk.it will handle the rest.</p>
			<h4 class="scroll-up">Ready to begin?</h4>
			<p class="alert alert--problem">Disclaimer: We <strong>do not</strong> store your details on our server or database. If you are uneasy about using your regular login details, request a new account be set up specifically for chekk.it through McMyAdmin's user panel.</p>
	</div>
</section>
<?php require ROOT . 'footer.php'; ?>