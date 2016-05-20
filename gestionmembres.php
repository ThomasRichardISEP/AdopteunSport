<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion membres</title>
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
				<a href="gestionmembres.php" class="button2">Gestion Membres</a>
				<a href="forumadmin.php" class="button2">Gestion Forum</a>
				<a href="faqadmin.php" class="button2">Gestion FAQ</a>
			</div> 			
		</header>


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

		<div class="suppressiondiv">
            <h3>Supprimer un membre :</h3>
            <form action="gestionmembres.php" method="post">
            	Pseudo : <input type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>"><br />
            	<input type="submit" name="suppression" value="Suppression" id="creer">
            </form>
        </div>

        <h3 class="listemembres">Liste des membres du site</h3>
        

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