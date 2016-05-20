<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Forum</title>
		
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
		

		<div class="forum">

			<?php
				if (isset($_SESSION['Pseudo'])) {
				?>
					<form action="forum_post.php" method="post" class="forumformulaire">
						<h3>Poster un message :</h3>
			        	<label for="Contenu">Message</label> :  <input type="text" name="Contenu" id="Contenu" placeholder="Entrez votre message" /><br />
					    <input type="submit" value="Envoyer" id="valider" />
			    	</form>
	    	<?php
	    		}
	    	?>

			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			// Récupération des messages
			$reponse = $bdd->query('SELECT Pseudo_membre_inscrit, Contenu, Date_message, Heure_message FROM messages ORDER BY Id_message DESC ');

			// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
			while ($donnees = $reponse->fetch())
			{ ?>

				<div class="postsforum">
				<div class="auteur caseforum">
					<?php 
					echo $donnees['Pseudo_membre_inscrit'] . '<br/>' . 'le ';
					echo $donnees['Date_message'] . ' à ';
					echo $donnees['Heure_message'];
					?>
				</div>
				<div class="msg caseforum">
					<?php
					echo $donnees['Contenu'] . '<br /><br />';
					?>
				</div>
			</div>
			
			<?php
			}

			$reponse->closeCursor();

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
				<a href="https://www.google.fr" class="rsociaux mail"></a>
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

<!--
echo $donnees['Pseudo_membre_inscrit'] . ' , le ';
		echo $donnees['Date_message'] . ' à ';
		echo $donnees['Heure_message'] . ' :' . '<br />';
		echo $donnees['Contenu'] . '<br /><br />'; -->