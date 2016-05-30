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

		        $req = $base->prepare('UPDATE groupe SET Titre = ?, Descriptif = ?, Zone_geographique = ?, Nb_max_personnes = ?, Photo = ?, Nom_sport = ?, Pseudo_membre_createur = ?, Date_creation = ? WHERE Titre= ? ');
				$req->execute(array($_POST['titre'], $_POST['descriptif'], $_POST['zonegeo'], $_POST['nbpers'], $_POST['photo'], $_POST['nomsport'], $_POST['pseudocreateur'], $_POST['datecreation'], $_POST['titre']));

		        header ('Location: membre.php');
			}
		?>

<?php
			if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer le groupe') {
				try
		        {
		            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		        }
		        catch(Exception $e)
		        {
		            die('Erreur : '.$e->getMessage());
		        }

		        $reponse = $base->query('DELETE FROM groupe WHERE Titre = "'.$_POST['titre'].'"');
		        $reponse2 = $base->query('DELETE FROM appartenance_groupe WHERE Titre_groupe = "'.$_POST['titre'].'"');
		        header ('Location: membre.php');
		    }
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gestion Groupe</title>
		
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
            <h3>Modification des informations du groupe :</h3>
            <form action="modifgroupeleader.php" method="post">
            	<div class="partie colonnegauche">
            		Titre :<br/>
            		Descriptif :<br/>
            		Nom du sport :<br/>
            		Zone géographique :<br/>
            		Nb max de personnes :<br/>
            		Photo :<br/>
            		Pseudo leader :<br/>
            		Date création :<br/>
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

				$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Nom_sport, Pseudo_membre_createur, Date_creation FROM groupe WHERE Titre="'.$_GET['Titregroupe'].'" ');
				$donnees=$reponse->fetch();
				?>

            	<div class="partie colonnedroite">
            		<input type="text" name="titre" value="<?php echo $donnees['Titre'] ?>"><br />
		            <input type="text" name="descriptif" value="<?php echo $donnees['Descriptif'] ?>"><br />
		            <input type="text" name="nomsport" value="<?php echo $donnees['Nom_sport'] ?>"><br />
		            <input type="text" name="zonegeo" value="<?php echo $donnees['Zone_geographique'] ?>"><br />
		            <input type="text" name="nbpers" value="<?php echo $donnees['Nb_max_personnes'] ?>"><br />
		            <input type="text" name="photo" value="<?php echo $donnees['Photo'] ?>"><br />
		            <input type="text" name="pseudocreateur" value="<?php echo $donnees['Pseudo_membre_createur'] ?>"><br />
		            <input type="date" name="datecreation" value="<?php echo $donnees['Date_creation'] ?>"><br />
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="supprimer" value="Supprimer le groupe" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>


        <div class="liencreaevent">
        	<a href="event.php?Groupe=<?php echo $_GET['Titregroupe']; ?>&amp;Ville=<?php echo $donnees['Zone_geographique']; ?>&amp;Sport=<?php echo $donnees['Nom_sport']; ?>" class="button3">Gestion des évènements</a>
        </div>


        <h3 class="grouperecent">Membres inscrits à ce groupe :</h3>

        <?php
			try
			{
			$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			$reponse = $base->query('SELECT Pseudo_membre_inscrit FROM appartenance_groupe WHERE Titre_groupe = "'.$_GET['Titregroupe'].'" ');

			while ($donnees = $reponse->fetch())
			{ ?>
				<div class="membrestrouves">
				<br/><?php
				echo $donnees['Pseudo_membre_inscrit']. '<br/>';
				?>
				<a href="suppressionmembre.php?Titregroupe=<?php echo $_GET['Titregroupe']; ?>&amp;Pseudomembre=<?php echo $donnees['Pseudo_membre_inscrit']; ?>" class="button3">Supprimer ce membre</a>
				<br/><br/>
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




<!--
	if (isset($_POST['suppr']) && $_POST['suppr'] == 'Supprimer le membre') {
						try
				        {
				            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
				        }
				        catch(Exception $e)
				        {
				            die('Erreur : '.$e->getMessage());
				        }

				        $req = $base->prepare('DELETE FROM appartenance_groupe WHERE Titre_groupe = ? AND Pseudo_membre_inscrit = ? ');
				        $req->execute(array($_GET['Titregroupe'], $donnees['Pseudo_membre_inscrit']));
		   			}
		-->