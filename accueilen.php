<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Accueil</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>		

		<div class="maintenance">
			<h1>Cette partie du site est en maintenance! Revenez plus tard.</h1>
		</div>

		<?php include("footermembre.php"); ?>
		
	</body>	
</html>