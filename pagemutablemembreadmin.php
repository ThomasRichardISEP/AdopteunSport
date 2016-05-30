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
				$req->execute(array($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['naissance'], $_POST['photo'], $_POST['login']));

		        header ('Location: gestionmembres.php');
			}
		?>

<?php
			if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer le membre') {
				try
		        {
		            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		        }
		        catch(Exception $e)
		        {
		            die('Erreur : '.$e->getMessage());
		        }

		        $reponse = $base->query('DELETE FROM membre_inscrit WHERE Pseudo = "'.$_POST['login'].'"');
		        header ('Location: gestionmembres.php');
		    }
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Page Mutable Membre Admin</title>
		
		<!-- Feuille de style -->
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


		<div class="modificationdiv">
            <h3>Modification des informations du membre :</h3>
            <form action="pagemutablemembreadmin.php" method="post">
            	<div class="partie colonnegauche">
            		Pseudo :<br/>
            		Prénom :<br/>
            		Nom :<br/>
            		Mail :<br/>
            		Adresse :<br/>
            		Ville :<br/>
            		Date de naissance :<br/>
            		Photo :<br/>
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

				$reponse = $base->query('SELECT Pseudo, Nom, Prenom, Date_naissance, Mail, Adresse, Ville, Photo FROM Membre_inscrit WHERE Pseudo="'.$_GET['Pseudomembre'].'"');
				$donnees=$reponse->fetch();
				?>

            	<div class="partie colonnedroite">
            		<input type="text" name="login" value="<?php echo $donnees['Pseudo'] ?>"><br />
		            <input type="text" name="prenom" value="<?php echo $donnees['Prenom'] ?>"><br />
		            <input type="text" name="nom" value="<?php echo $donnees['Nom'] ?>"><br />
		            <input type="text" name="mail" value="<?php echo $donnees['Mail'] ?>"><br />
		            <input type="text" name="adresse" value="<?php echo $donnees['Adresse'] ?>"><br />
		            <input type="text" name="ville" value="<?php echo $donnees['Ville'] ?>"><br />
		            <input type="date" name="naissance" value="<?php echo $donnees['Date_naissance'] ?>"><br />
		            <input type="text" name="photo" value="<?php echo $donnees['Photo'] ?>"><br />
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="supprimer" value="Supprimer le membre" class="button3">
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