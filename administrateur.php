<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Espace administrateur</title>
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
							<?php echo($_SESSION['Pseudo']) ?>
							<a href="deconnexion.php" class="button">Déconnexion</a>
							<?php
						}
					?>
					
           		</div>
			</div>
			<div class="menu haut">
				<a href="administrateur.php" class="button2">Espace Administrateur</a>
			</div> 			
		</header>


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

				$reponse = $base->query('DELETE FROM membre_inscrit WHERE Pseudo = "'.$_POST['pseudo'].'"');

			}

		?>

		<div class="optionsadmin">
			<a href="www.google.fr" class="button2">Gestion Membres</a>
			<a href="www.google.fr" class="button2">Gestion Forum</a>
			<a href="www.google.fr" class="button2">Gestion FAQ</a>
		</div>

		<div class="faqadmindiv">
			<h3>Ajouter une FAQ</h3>
			<form action="faq_post.php" method="post" class="faqformulaire">
		        	<label for="Question">Question</label> : <input type="text" name="Question" id="Question" placeholder="Entrez votre question" /><br />
		        	<label for="Reponse">Réponse</label> :  <input type="text" name="Reponse" id="Reponse" placeholder="Entrez votre réponse" /><br />
				    <input type="submit" value="Envoyer" id="valider" />
		    </form>
		</div>


		<div class="suppressiondiv">
            <h3>Supprimer un membre :</h3>
            <form action="administrateur.php" method="post">
            	Pseudo : <input type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>"><br />
            	<input type="submit" name="suppression" value="Suppression" id="creer">
            </form>
        </div>


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
			<h3 class="listemembres">Membres du site</h3>
			<?php

				$reponse = $base->query('SELECT Pseudo, Nom, Prenom, Mail FROM membre_inscrit ORDER BY Pseudo ');

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
					<br/><?php echo $donnees['Pseudo'] . '<br/>';
					echo $donnees['Nom'] . '<br/>';
					echo $donnees['Prenom']. '<br/>'. '<br/>';
					?>
					</div>
					
				<?php
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