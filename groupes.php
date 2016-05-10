<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Groupes</title>
		
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
						session_start();
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


		<div class="groupe">
			<div class="groupeformulaire">
				<form action="groupes.php" method="post">
		        	<p>
		        		<label for="sport">Sport</label> : <input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>"/><br />
		        		<label for="ville">Ville</label> : <input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"/><br />
				        <input type="submit" name="valider" value="Valider" id="valider">
					</p>
		    	</form>
    		</div>


			<?php
			if (isset($_POST['valider']) && $_POST['valider'] == 'Valider') {
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				if ( (isset($_POST['ville']) && !empty($_POST['ville'])) && (isset($_POST['sport']) && empty($_POST['sport'])) ) {

					// Récupération des 10 derniers messages
					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Zone_geographique="'.$_POST['ville'].'"');

					// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ( (isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && empty($_POST['ville'])) ) {

					// Récupération des 10 derniers messages
					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Nom_sport="'.$_POST['sport'].'"');

					// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ((isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && !empty($_POST['ville'])) ) {

					// Récupération des 10 derniers messages
					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Nom_sport="'.$_POST['sport'].'" AND Zone_geographique="'.$_POST['ville'].'"');

					// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

			}	
			?>

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