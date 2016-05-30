<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>


<?php
			if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {

			    if ((isset($_POST['nom']) && !empty($_POST['nom'])) && (isset($_POST['daterdv']) && !empty($_POST['daterdv'])) && (isset($_POST['heure']) && !empty($_POST['heure'])) && (isset($_POST['club'])  && !empty($_POST['club'])) ) {

			        try
			        {
			            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			        }
			        catch(Exception $e)
			        {
			            die('Erreur : '.$e->getMessage());
			        }

			        $req = $base->prepare('INSERT INTO evenement(Nom_event, Groupe, Club, Date_event, Heure_event) VALUES(?, ?, ?, ?, ?)');
					$req->execute(array($_POST['nom'], $_GET['Groupe'], $_POST['club'], $_POST['daterdv'], $_POST['heure']));
			        
			    }
			    
			}
		?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Evènements</title>
		
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


		<div class="creationevent">
			<h3>Créer un évènement pour <?php echo $_GET['Groupe']; ?> :</h3>
			<form method="post">
				<div class="partie colonnegauche">
            		Nom de l'évènement :<br/>
            		Date :<br/>
            		Heure :<br/>
            		Club de rendez-vous :<br/>
            	</div>

            	<div class="partie colonnedroite">
            		<input type="text" name="nom"><br />
		            <input type="date" name="daterdv"><br />
		            <input type="time" name="heure"><br />
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

            	<input type="submit" name="creer" value="Créer" class="button3">
			</form>
		</div>


		<h3 class="grouperecent">Evènements du groupe :</h3>

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

				$reponse = $base->prepare('SELECT Nom_event, Club, Date_event, Heure_event FROM evenement WHERE Groupe = ? ORDER BY Date_event ');
				$reponse->execute(array($_GET['Groupe']));

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
					<br/>
					<a href="modifevent.php?Nomevent=<?php echo $donnees['Nom_event']; ?>&amp;Ville=<?php echo $_GET['Ville']; ?>&amp;Sport=<?php echo $_GET['Sport']; ?> "><?php echo $donnees['Nom_event']; ?></a><br/>
					<?php
					echo $donnees['Club']. '<br/>';
					echo $donnees['Date_event']. '<br/>';
					echo $donnees['Heure_event']. '<br/>';
					?>
					<br/>
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
	<input type="text" name="club"><br />
	-->