<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Messagerie</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>

	<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

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


		<div class="messagerie">

			<div class="messagerieformulaire">
	            <h3>Envoyer un nouveau message :</h3>
	            <form action="messagerie.php" method="post">
	            	Prénom destinataire : <input type="text" name="prenomdestinataire" value="<?php if (isset($_POST['prenomdestinataire'])) echo htmlentities(trim($_POST['prenomdestinataire'])); ?>"><br />
	            	Nom destinataire : <input type="text" name="nomdestinataire" value="<?php if (isset($_POST['nomdestinataire'])) echo htmlentities(trim($_POST['nomdestinataire'])); ?>"><br />
	            	Message : <input type="text" name="message" value="<?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?>"><br />
	            	<input type="submit" name="envoyer" value="Envoyer" class="button2">
	       		</form>
	       	</div>

	       	<?php
			if (isset($_POST['envoyer']) && $_POST['envoyer'] == 'Envoyer') {
				if ((isset($_POST['prenomdestinataire']) && !empty($_POST['prenomdestinataire'])) && (isset($_POST['nomdestinataire']) && !empty($_POST['nomdestinataire']))) {

					 try
	        		{
	            		$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	        		}
	        		catch(Exception $e)
	        		{
	            		die('Erreur : '.$e->getMessage());
	        		}

	        		$sql = 'INSERT INTO messagerie(Prenomauteur, Nomauteur, Prenomdestinataire, Nomdestinataire, Message) VALUES("'.$_SESSION['Prenom'].'", "'.$_SESSION['Nom'].'", "'.$_POST['prenomdestinataire'].'", "'.$_POST['nomdestinataire'].'","'.$_POST['message'].'")';
	        		$base->query($sql);

	        	}
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
					$reponse = $bdd->query('SELECT Prenomauteur, Nomauteur, Message FROM messagerie WHERE Prenomdestinataire="'.$_SESSION['Prenom'].'" AND Nomdestinataire="'.$_SESSION['Nom'].'" ');

					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="postsmessagerie">
						<div class="auteur casemessagerie">
							<?php 
							echo $donnees['Prenomauteur'] . '<br/>';
							echo $donnees['Nomauteur'];
							?>
						</div>
						<div class="msg casemessagerie">
							<?php
							echo $donnees['Message'] . '<br /><br />';
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