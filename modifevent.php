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

		        $req = $base->prepare('UPDATE evenement SET Nom_event = ?, Club = ?, Date_event = ?, Heure_event = ? WHERE Nom_event = ? ');
				$req->execute(array($_POST['nom'], $_POST['club'], $_POST['daterdv'], $_POST['heure'], $_POST['nom']));

		        header ('Location: membre.php');
			}
		?>

<?php
			if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer l\'évènement') {
				try
		        {
		            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		        }
		        catch(Exception $e)
		        {
		            die('Erreur : '.$e->getMessage());
		        }

		        $reponse = $base->query('DELETE FROM evenement WHERE Nom_event = "'.$_POST['nom'].'"');
		        header ('Location: membre.php');
		    }
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gestion Evènement</title>
		
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
            <h3>Modification des informations de l'évènement :</h3>
            <form method="post">
            	<div class="partie colonnegauche">
            		Nom de l'évènement :<br/>
            		Date :<br/>
            		Heure :<br/>
            		Club de rendez-vous :<br/>
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

				$reponse = $base->query('SELECT Nom_event, Club, Date_event, Heure_event FROM evenement WHERE Nom_event="'.$_GET['Nomevent'].'" ');
				$donnees=$reponse->fetch();
				?>

            	<div class="partie colonnedroite">
            		<input type="text" name="nom" value="<?php echo $donnees['Nom_event'] ?>"><br />
		            <input type="date" name="daterdv" value="<?php echo $donnees['Date_event'] ?>"><br />
		            <input type="time" name="heure" value="<?php echo $donnees['Heure_event'] ?>"><br />
					<select name="club">
		            	<?php
		            		try
						        {
						            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
						        }
						        catch(Exception $e)
						        {
						            die('Erreur : '.$e->getMessage());
						        }
						    $reponse = $base->prepare('SELECT Titre FROM club WHERE Zone_geographique=? AND Sport=? ');
						    $reponse->execute(array($_GET['Ville'], $_GET['Sport']));
						    while ($donnees = $reponse->fetch()) { ?>
						    	<option><?php echo $donnees['Titre']; ?></option>
						    <?php
						    }

		            	?>
		            </select><br/>
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="supprimer" value="Supprimer l'évènement" class="button3">
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