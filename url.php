<?php
	require 'config.php';
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			die('Error! You do not have permission to access this file directly.');
	}
	$data = construct_Chekkit();
?>
<!DOCTYPE html>
<html>
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
<div class="wrapper">
	<table>
		<thead>
			<tr>
				<th>Plugin Name</th>
				<th>Installed Version</th>
				<th>Latest Version</th>
				<th>Download Link</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $plugin => $data): ?>
				<tr>
					<td><a href="<?php echo $data['website']; ?>"><?php echo $plugin; ?></a></td>
					<td><?php echo $data['current']; ?></td>
					<td><?php echo $data['latest']; ?></td>
					<td>
						<?php if ($data['current'] !== $data['latest']): ?>
							<a href="<?php echo $data['download']; ?>">Download</a>
						<?php else: ?>
							No update available
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
</section>
<?php require ROOT . 'footer.php'; ?>
