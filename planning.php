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
		<title>Mon planning</title>
		<!-- Feuilles de style -->
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


		<h3 class="grouperecent" style="margin-top:10%; display:inline-block;">Mon planning</h3>

		<?php
			try
			{
			$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			$reponse = $base->query('SELECT Titre_groupe FROM appartenance_groupe WHERE Pseudo_membre_inscrit = "'.$_SESSION['Pseudo'].'" ');

			while ($donnees = $reponse->fetch())
			{ 

				$reponse2 = $base->prepare('SELECT Nom_event, Groupe, Club, Date_event, Heure_event FROM evenement WHERE Groupe = ? ORDER BY Date_event ');
				$reponse2->execute(array($donnees['Titre_groupe']));
				while ($donnees2 = $reponse2->fetch()){
					?>
					<div class="membrestrouves">
						<br/>
						<?php 
						echo $donnees2['Nom_event']. '<br/>';
						echo $donnees2['Groupe']. '<br/>';
						echo $donnees2['Club']. '<br/>';
						echo $donnees2['Date_event']. '<br/>';
						echo $donnees2['Heure_event']. '<br/>';
						?>
						<br/>
					</div>
					<?php
				}
				$reponse2->closeCursor();
				
			}

			$reponse->closeCursor();	
		?>


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