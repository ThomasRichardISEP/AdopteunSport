<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

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

		        $req = $base->prepare('UPDATE membre_inscrit SET Pseudo = ?, Prenom = ?, Nom = ?, Mail = ?, Adresse = ?, Ville = ?, Date_naissance = ?, Photo = ? WHERE Pseudo = ? ');
				$req->execute(array($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['naissance'], $_POST['photo'], $_SESSION['Pseudo']));

				$_SESSION['Pseudo'] = $_POST['login'];
		        $_SESSION['Nom'] = $_POST['nom'];
		        $_SESSION['Prenom'] = $_POST['prenom'];
		        $_SESSION['Photo'] = $_POST['photo'];
		        $_SESSION['Date_naissance'] = $_POST['naissance'];
		        $_SESSION['Mail'] = $_POST['mail'];
		        $_SESSION['Adresse'] = $_POST['adresse'];
		        $_SESSION['Ville'] = $_POST['ville'];

		        if ((isset($_POST['old_pass']) && md5($_POST['old_pass']) == $_SESSION['Mdp']) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm'])) ) {
		        	if ($_POST['pass'] == $_POST['pass_confirm']) {

		        		$req = $base->prepare('UPDATE membre_inscrit SET mdp = ? WHERE Pseudo = ? ');
		        		$req->execute(array(md5($_POST['pass']), $_SESSION['Pseudo']));

		        		$_SESSION['Mdp'] = md5($_POST['pass']);
		        	}
		        }

		        header ('Location: membre.php');
			}
		?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Espace membre</title>
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

		

		<div class="modificationdiv">
            <h3>Modification de vos informations :</h3>
            <form action="modifmembre.php" method="post">
            	<div class="partie colonnegauche">
            		Pseudo :<br/>
            		Ancien mot de passe :<br/>
            		Nouveau mot de passe :<br/>
            		Confirmation du mdp :<br/>
            		Prénom :<br/>
            		Nom :<br/>
            		Mail :<br/>
            		Adresse :<br/>
            		Ville :<br/>
            		Date de naissance :<br/>
            		Photo :<br/>
            	</div>

            	<div class="partie colonnedroite">
            		<input type="text" name="login" value="<?php echo $_SESSION['Pseudo'] ?>"><br />
		            <input type="password" name="old_pass" value=""><br />
		            <input type="password" name="pass" value=""><br />
		            <input type="password" name="pass_confirm" value=""><br />
		            <input type="text" name="prenom" value="<?php echo $_SESSION['Prenom'] ?>"><br />
		            <input type="text" name="nom" value="<?php echo $_SESSION['Nom'] ?>"><br />
		            <input type="text" name="mail" value="<?php echo $_SESSION['Mail'] ?>"><br />
		            <input type="text" name="adresse" value="<?php echo $_SESSION['Adresse'] ?>"><br />
		            <input type="text" name="ville" value="<?php echo $_SESSION['Ville'] ?>"><br />
		            <input type="date" name="naissance" value="<?php echo $_SESSION['Date_naissance'] ?>"><br />
		            <input type="text" name="photo" value="<?php echo $_SESSION['Photo'] ?>"><br />
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
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