<?php
session_start();
			if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {

			    if ((isset($_POST['nomclub']) && !empty($_POST['nomclub'])) && (isset($_POST['choixsport']) && !empty($_POST['choixsport'])) && (isset($_POST['choixville']) && !empty($_POST['choixville'])) && (isset($_POST['descriptif'])  && !empty($_POST['descriptif'])) ) {

			        try
			        {
			            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			        }
			        catch(Exception $e)
			        {
			            die('Erreur : '.$e->getMessage());
			        }

			        // on recherche si ce login est déjà utilisé par un autre membre
			        $sql = 'SELECT count(*) FROM club WHERE Titre="'.$_POST['nomclub'].'"';
			        $req = $base->query($sql);
			        $data = $req->fetch();

			        if ($data[0] == 0) {
			        $sql = 'INSERT INTO club(Titre, Sport, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Pseudo_membre_createur, Date_creation) VALUES("'.$_POST['nomclub'].'", "'.$_POST['choixsport'].'", "'.$_POST['descriptif'].'", "'.$_POST['choixville'].'","'.$_POST['nbmembres'].'", "'.$_POST['photo'].'", "'.$_SESSION['Pseudo'].'", CURDATE())';
			        $base->query($sql);
			        }

			        header('Location: clubs.php');
			        
			    }
			    
			}
		?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Clubs</title>
		
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



		<div class="club">

			<?php
			if (!isset($_SESSION['Pseudo'])) {
				?>
				<div class="clubformulaire">
					<form action="clubs.php" method="post">
						<h3>Rechercher un club</h3>
				        <div class="partie colonnegauche">
				        	Sport :<br/>
				        	Ville :
				        </div>
				        <div class="partie colonnedroite">
				        	<input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>"/><br />
			        		<input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"/><br />
				        </div>
			        	<input type="submit" name="valider" value="Valider" id="valider">
			    	</form>
	    		</div>
	    	<?php
	    	}

	    	else if (isset($_SESSION['Pseudo'])) {
	    		?>
	    		<div class="clubformulaire2">
					<form action="clubs.php" method="post">
						<h3>Rechercher un club</h3>
				        <div class="partie colonnegauche">
				        	Sport :<br/>
				        	Ville :
				        </div>
				        <div class="partie colonnedroite">
				        	<input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>"/><br />
			        		<input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"/><br />
				        </div>
			        	<input type="submit" name="valider" value="Valider" id="valider">
			    	</form>
	    		</div>

	    		<div class="formulairecreerclub">
					<form action="clubs.php" method="post">
						<h3>Ajouter un club</h3>
			        	<div class="partie colonnegauche">
			        		Nom du club :<br/>
			        		Sport :<br/>
			        		Ville :<br/>
			        		Descriptif :<br/>
			        		Nb de membres :<br/>
			        		Photo :
			        	</div>
			        	<div class="partie colonnedroite">
			        		<input type="text" name="nomclub" placeholder="Entrez un nom" value="<?php if (isset($_POST['nomclub'])) echo htmlentities(trim($_POST['nomclub'])); ?>"/><br />
			        		<input type="text" name="choixsport" placeholder="Entrez un sport" value="<?php if (isset($_POST['choixsport'])) echo htmlentities(trim($_POST['choixsport'])); ?>"/><br />
			        		<input type="text" name="choixville" placeholder="Entrez une ville" value="<?php if (isset($_POST['choixville'])) echo htmlentities(trim($_POST['choixville'])); ?>"/><br />
			        		<input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php if (isset($_POST['descriptif'])) echo htmlentities(trim($_POST['descriptif'])); ?>"/><br />
			        		<input type="text" name="nbmembres" placeholder="Entrez un nombre de membres" value="<?php if (isset($_POST['nbmembres'])) echo htmlentities(trim($_POST['nbmembres'])); ?>"/><br />
			        		<input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>"/><br />
			        	</div>			        		
					        <input type="submit" name="creer" value="Créer" id="creer">
						
			    	</form>
    			</div>

	    	<?php
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


				if ( (isset($_POST['ville']) && !empty($_POST['ville'])) && (isset($_POST['sport']) && empty($_POST['sport'])) ) {

					// Récupération des 10 derniers messages
					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM club WHERE Zone_geographique="'.$_POST['ville'].'"');

					// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="clubville">
						<a href="pagemutableclub.php?Titreclub=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'];
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ( (isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && empty($_POST['ville'])) ) {

					// Récupération des 10 derniers messages
					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM club WHERE Sport="'.$_POST['sport'].'"');

					// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="clubville">
						<a href="pagemutableclub.php?Titreclub=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'];
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ((isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && !empty($_POST['ville'])) ) {

					// Récupération des 10 derniers messages
					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM club WHERE Sport="'.$_POST['sport'].'" AND Zone_geographique="'.$_POST['ville'].'"');

					// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="clubville">
						<a href="pagemutableclub.php?Titreclub=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'];
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

			}	
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