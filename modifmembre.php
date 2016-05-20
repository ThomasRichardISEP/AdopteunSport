<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Espace membre</title>
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

		        $req = $bdd->prepare('UPDATE membre_inscrit SET Nom = :test WHERE Pseudo = :coucou ');
				$req->execute(array(
					'test'=> $_POST['nom'],
					'coucou'=>"ThomasRichard"
					));

			}

		?>

		<div class="modificationdiv">
            <h3>Modification de vos informations :</h3>
            <form action="modifmembre.php" method="post">
            Pseudo : <input type="text" name="login" value="<?php echo $_SESSION['Pseudo'] ?>"><br />
            Mot de passe : <input type="password" name="pass" value=""><br />
            Confirmation du mdp : <input type="password" name="pass_confirm" value=""><br />
            Prénom : <input type="text" name="prenom" value="<?php echo $_SESSION['Prenom'] ?>"><br />
            Nom : <input type="text" name="nom" value="<?php echo $_SESSION['Nom'] ?>"><br />
            Mail : <input type="text" name="mail" value="<?php echo $_SESSION['Mail'] ?>"><br />
            Adresse : <input type="text" name="adresse" value="<?php echo $_SESSION['Adresse'] ?>"><br />
            Date de naissance : <input type="date" name="naissance" value="<?php echo $_SESSION['Date_naissance'] ?>"><br />
            Photo : <input type="text" name="photo" value="<?php echo $_SESSION['Photo'] ?>"><br />
            <input type="submit" name="valider" value="Valider" class="button2">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
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