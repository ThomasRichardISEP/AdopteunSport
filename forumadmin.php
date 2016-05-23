<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php
			if (isset($_POST['suppression']) && $_POST['suppression'] == 'Suppression') {
				try
				{
				$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
				}
				catch(Exception $e)
				{
		        	die('Erreur : '.$e->getMessage());
				}

				$reponse = $base->query('DELETE FROM messages WHERE Id_message = "'.$_POST['Idmessage'].'"');

			}

		?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion Forum</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<header>
			<div class="container haut">
				<div class="connexion element"><img class="logosite" src="Images/adopteunsportnb.png" /></div>
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
							<a href="administrateur.php" class="lienpseudo"><?php echo($_SESSION['Pseudo']) ?></a>
							<a href="deconnexion.php" class="button">Déconnexion</a>
							<?php
						}
					?>
					
           		</div>
			</div>
			<div class="menu haut">
				<a href="administrateur.php" class="button2">Espace Administrateur</a>
				<a href="gestionmembres.php" class="button2">Gestion Membres</a>
				<a href="gestiongroupes.php" class="button2">Gestion Groupes</a>
				<a href="forumadmin.php" class="button2">Gestion Forum</a>
				<a href="faqadmin.php" class="button2">Gestion FAQ</a>
			</div> 			
		</header>


		<div class="forumadmindiv">
			<form action="forum_post_admin.php" method="post">
				<h3>Poster un message :</h3>
				<label for="Contenu">Message</label> :  <input type="text" name="Contenu" id="Contenu" placeholder="Entrez votre message" /><br />
				<input type="submit" value="Envoyer" id="valider" />
			</form>
		</div>


		<div class="forumadmindiv">
			<h3>Supprimer un message :</h3>
			<form action="forumadmin.php" method="post">
		        <label for="Id">Id du message</label> : <input type="text" name="Idmessage" id="Idmessage" placeholder="Entrez l'Id du message" /><br/>
				<input type="submit" name="suppression" value="Suppression" id="creer">
		    </form>
		</div>



		<div class="forum2">

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
			$reponse = $bdd->query('SELECT Pseudo_membre_inscrit, Contenu, Date_message, Heure_message, Id_message FROM messages ORDER BY Id_message DESC ');

			// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
			while ($donnees = $reponse->fetch())
			{ ?>

				<div class="postsforum">
				<div class="auteur caseforum">
					<?php 
					echo $donnees['Pseudo_membre_inscrit'] . ' ' . '(Id msg : ' ;
					echo $donnees['Id_message'] . ')' . '<br/>' . 'le ';
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