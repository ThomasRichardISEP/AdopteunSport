<?php
session_start();
include_once("model.php");

	$grp = $_GET['Titregroupe'];

	if (isset($_POST['rejoindre']) && $_POST['rejoindre'] == 'Rejoindre') {
		rejoindregroupe($_SESSION['Pseudo'], $grp);	
	}


	if (isset($_POST['desinscription']) && $_POST['desinscription'] == 'Desinscription') {
		quittergroupe($_SESSION['Pseudo'], $grp);
	}
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Page Mutable Groupe</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		
		<div class="detailgroupe">
			<h3><?php echo $_GET['Titregroupe']; ?></h3>
			<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique, Nb_max_personnes, Pseudo_membre_createur, Date_creation FROM groupe WHERE Titre="'.$_GET['Titregroupe'].'"');

				while ($donnees = $reponse->fetch())
					{ ?>
						<p>Ce groupe est un <?php echo $donnees['Descriptif']; ?>.</p>
						<p>Ce groupe se situe à <?php echo $donnees['Zone_geographique']; ?>.</p>
						<p>Ce groupe accueille au maximum <?php echo $donnees['Nb_max_personnes']; ?> personnes.</p>
						<p>Ce groupe est dirigé par <?php echo $donnees['Pseudo_membre_createur']; ?>.</p>
						<p>Ce groupe a été créé le <?php echo $donnees['Date_creation']; ?>.</p>
					<?php
					}

					$reponse->closeCursor();
				
				if (isset($_SESSION['Pseudo'])){

					$req = $base->prepare('SELECT count(*) FROM appartenance_groupe WHERE Pseudo_membre_inscrit = ? AND Titre_groupe = ? ');
					$req->execute(array($_SESSION['Pseudo'], $grp));
					$data = $req->fetch();

					if ($data[0] == 1) {
						?><form method="post">
							<input type="submit" name="desinscription" value="Desinscription" class="button3">
							</form>
						<?php
					}
					else if ($data[0] == 0) {
						?><form method="post">
							<input type="submit" name="rejoindre" value="Rejoindre" class="button3">
						</form>
					<?php 
					}
				}
			?>
			<P><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=pagemutablegroupe.php?Titregroupe=<?php echo $_GET['Titregroupe']; ?>"><img class="lienpartage" src="Images/fbshare.png" /></a>
			<a target="_blank" href="https://twitter.com/home?status=pagemutablegroupe.php?Titregroupe=%3C?php%20echo%20$_GET%5B'Titregroupe'%5D;%20?%3E"><img class="lienpartage" src="Images/twittershare.png" /></a></p>
		</div>


		<h3 class="grouperecent">Evènements du groupe :</h3>

		<?php
			try
			{
				$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			?>
			
			<?php

				$reponse = $base->prepare('SELECT Nom_event, Club, Date_event, Heure_event FROM evenement WHERE Groupe = ? ORDER BY Date_event ');
				$reponse->execute(array($_GET['Titregroupe']));

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
					<br/><?php
					echo $donnees['Nom_event']. '<br/>';
					echo $donnees['Club']. '<br/>';
					echo $donnees['Date_event']. '<br/>';
					echo $donnees['Heure_event']. '<br/>'. '<br/>';
					?>
					</div>

				<?php
				}

				$reponse->closeCursor();	
		?>


		<?php include("footermembre.php"); ?>

	</body>	
</html>