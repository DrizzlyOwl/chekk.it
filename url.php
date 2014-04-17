<?php require 'config.php'; require FUNCTIONS; ?>
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
<body class="preload">
<?php if ($updates > 0): $alert = 'success'; endif; ?>
<div class="alert--dropdown alert alert--<?php echo $alert; ?>">
	<div class="wrapper">
		<h1><?php echo $host; ?></h1>
		<p>Counted <?php echo $total; ?> installed plugins, skipped <?php echo $skipped; ?> and found <?php echo $updates; ?> updates.</p>
	</div>
</div>
<section class="main main--index" role="main"> 
	<div class="wrapper">
		<div class="single-plugin-tile">
			<table>
			<thead>
				<tr>
					<th colspan="2">
						Results for <?php echo $host; ?>
					</th>
				</tr>
			</thead>
				<tbody>
				<?php foreach ($merged as $slug => $data):
					$name = $data[0];
					$current_version = $data[1];
					$latest_version = $data[2];
					$download = $data[3];
				?>
					<tr>
						<td colspan="2">
							<?php echo $name; ?>
						</td>
					</tr>

					<tr>
						<td><?php echo $current_version; ?></td>
						<td><a href="<?php echo $download; ?>"><?php echo $latest_version; ?></a></td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<?php require ROOT . 'footer.php'; ?>
