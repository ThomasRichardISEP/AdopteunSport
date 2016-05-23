<?php
session_start();
	$grp = $_GET['Titregroupe'];
	if (isset($_POST['rejoindre']) && $_POST['rejoindre'] == 'Rejoindre') {

		try
			{
			    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
			    die('Erreur : '.$e->getMessage());
			}

		$sql = 'SELECT count(*) FROM appartenance_groupe WHERE Pseudo_membre_inscrit = "'.$_SESSION['Pseudo'].'" ';
		$req = $base->query($sql);
		$data = $req->fetch();

		if ($data[0] == 0) {
			$sql = 'INSERT INTO appartenance_groupe(Pseudo_membre_inscrit, Titre_groupe, Date_inscription) VALUES("'.$_SESSION['Pseudo'].'", "'.$grp.'", CURDATE())';
			$base->query($sql);
		}

		header('Location:index.php');		

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

		<header>
			<div class="container haut">
				<div class="connexion element"><a href="index.php"><img class="logosite" src="Images/adopteunsportnb.png" /></a></div>
				<div class="connexion droite element">
					<?php	
						if (!isset($_SESSION['Pseudo'])) {
							?>
							<a href="inscription.php" class="button">Inscription</a>
							<a href="pageconnection.php" class="button">Connexion</a>
							<?php
						}
						else if (isset($_SESSION['Pseudo'])) {
							?>
							<a href="membre.php" class="lienpseudo"><?php echo($_SESSION['Pseudo']) ?></a>
							<a href="deconnexion.php" class="button">Déconnexion</a>
							<?php
						}
					?>
					
           		</div>
			</div>
			<div class="menu haut">
				<a href="membre.php" class="button2">Profil</a>
				<a href="clubs.php" class="button2">Club</a>
				<a href="groupes.php" class="button2">Groupes</a>
				<a href="forum.php" class="button2">Forum</a>
				<a href="faq.php" class="button2">Aide</a>
			</div> 			
		</header>

		
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
				
				if (isset($_SESSION['Pseudo'])) {
					?><form method="post">
						<input type="submit" name="rejoindre" value="Rejoindre" class="button3">
					</form>
				<?php 
				}
			?>
			<P><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=pagemutablegroupe.php?Titregroupe=<?php echo $_GET['Titregroupe']; ?>"><img class="lienpartage" src="Images/fbshare.png" /></a></p>

		</div>



		<footer>
			<div class="company bas">
				<h3>Company</h3>
				<a href="groupe6c.php" class="lienfootercompany">A propos de nous</a>
				<a href="cgu.php" class="lienfootercompany">CGU</a><br/>
				<a href="accueilen.php" class="lienfootercompany">English version</a>
			</div>

			<div class="espace bas">
			</div>

			<div class="contact bas">
				<h3>Contact</h3>
				<a href="mailto:tho-richard@sfr.fr" class="rsociaux mail"></a>
				<a href="https://www.facebook.com" class="rsociaux fb"></a>
				<a href="https://www.google.fr" class="rsociaux twitter"></a>
				<a href="https://www.google.fr" class="rsociaux linkedin"></a>
			</div>

			<div class="espace bas">
			</div>

			<div class="adresse bas">
				<h3>Adresse</h3>
				<p>28 Rue Notre-Dame des Champs, Paris 75006.</p>
			</div>
		</footer>
	</body>	
</html>