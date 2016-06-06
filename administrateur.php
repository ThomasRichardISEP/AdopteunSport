<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Espace administrateur</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headeradmin.php") ?>

		<div class="profil">
			<div class="profilcolonne">
				<p class="profilnom info1">Bonjour <?php echo htmlentities(trim($_SESSION['Prenom']));?> <?php echo htmlentities(trim($_SESSION['Nom'])); ?> </p>
				<p class="profilpseudo info1">Votre Pseudo est <?php echo htmlentities(trim($_SESSION['Pseudo'])); ?>! </p>
				<p class="profilnaissance info1">Vous êtes né(e) le <?php echo htmlentities(trim($_SESSION['Date_naissance'])); ?>. </p>
				<p class="profilmail info1">Votre mail est <?php echo htmlentities(trim($_SESSION['Mail'])); ?>. </p>
				<p class="profiladresse info1">Vous habitez au <?php echo htmlentities(trim($_SESSION['Adresse'])); ?>. </p><br />
			</div>
			<img class="profilphoto profilcolonne" src=<?php echo htmlentities(trim($_SESSION['Photo'])); ?> />
		</div>

		<?php include("footeradmin.php") ?>

	</body>
</html>