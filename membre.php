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
		<title>Espace membre</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headermembre.php"); ?>

		<div class="profil">
			<div class="profilcolonne">
				<p class="profilnom info1">Bonjour <?php echo $_SESSION['Prenom'];?> <?php echo $_SESSION['Nom']; ?> </p>
				<p class="profilpseudo info1">Votre Pseudo est <?php echo $_SESSION['Pseudo']; ?>! </p>
				<p class="profilnaissance info1">Vous êtes né(e) le <?php echo $_SESSION['Date_naissance']; ?>. </p>
				<p class="profilmail info1">Votre mail est <?php echo $_SESSION['Mail']; ?>. </p>
				<p class="profiladresse info1">Vous habitez au <?php echo $_SESSION['Adresse']; ?> à <?php echo $_SESSION['Ville']; ?>. </p><br />
			</div>
			<img class="profilphoto profilcolonne" src=<?php echo $_SESSION['Photo']; ?> />
		</div>


		<div class="menumembre">
			<a href="planning.php" class="button3">Mon planning</a>
			<a href="modifmembre.php" class="button3">Modifier mes informations</a>
			<a href="messagerie.php" class="button3">Ma messagerie</a>
		</div>


		<h3 class="grouperecent">Groupes auxquels je suis inscrit :</h3>

		<?php
		try
			{
				$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	   			die('Erreur : '.$e->getMessage());
			}

		$reponse = $base->query('SELECT Titre_groupe FROM appartenance_groupe WHERE Pseudo_membre_inscrit="'.$_SESSION['Pseudo'].'"');

		while ($donnees = $reponse->fetch()){ 
			?>
			<div class="groupestrouves">
				<br/><a href="pagemutablegroupe.php?Titregroupe=<?php echo $donnees['Titre_groupe']; ?>"><?php echo $donnees['Titre_groupe'] . '<br/>'; ?></a><br/>
			</div>	
					
			<?php
			}
					
			$reponse->closeCursor();
		?>
		

		<br/><br/><h3 class="grouperecent">Groupes dont je suis le leader :</h3>

		<?php
		try
			{
				$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	   			die('Erreur : '.$e->getMessage());
			}

		$reponse = $base->query('SELECT Titre FROM groupe WHERE Pseudo_membre_createur="'.$_SESSION['Pseudo'].'"');

		while ($donnees = $reponse->fetch()){ 
			?>
			<div class="groupestrouves">
				<br/><a href="modifgroupeleader.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a><br/>
			</div>	
					
			<?php
			}
					
			$reponse->closeCursor();
		?>

		<?php include("footermembre.php"); ?>

	</body>
</html>