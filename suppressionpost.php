<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>	

<!-- Suppression d'un message sur le forum -->
<?php
	if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer le message') {
		supprimerpost($_GET['Idmessage']);
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Suppression Message</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headeradmin.php") ?>


		<div class="suppressionpost">
			<h3>Etes-vous sûr de vouloir supprimer le message <?php echo $_GET['Idmessage']; ?>?</h3>
			<form method="post">
				<input type="submit" name="supprimer" value="Supprimer le message" class="button3">
			</form>
		</div>


		<?php include("footeradmin.php") ?>

	</body>
</html>