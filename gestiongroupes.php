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

				$reponse = $base->query('DELETE FROM groupe WHERE Titre = "'.$_POST['titre'].'"');

			}

		?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion groupes</title>
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



		<div class="suppressiondiv">
            <h3>Supprimer un groupe :</h3>
            <form action="gestionmembres.php" method="post">
            	Nom du groupe : <input type="text" name="titre" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>"><br />
            	<input type="submit" name="suppression" value="Suppression" id="creer">
            </form>
        </div>

        <h3 class="listemembres">Liste des groupes du site</h3>
        

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

				$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique, Pseudo_membre_createur FROM groupe ORDER BY Titre ');

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
					<br/><?php echo $donnees['Titre'] . '<br/>';
					echo $donnees['Descriptif'] . '<br/>';
					echo $donnees['Zone_geographique'] . '<br/>';
					echo $donnees['Pseudo_membre_createur']. '<br/>'. '<br/>';
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