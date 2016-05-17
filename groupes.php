<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Groupes</title>
		
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
						session_start();
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
			if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {

			    if ((isset($_POST['nomgroupe']) && !empty($_POST['nomgroupe'])) && (isset($_POST['choixsport']) && !empty($_POST['choixsport'])) && (isset($_POST['choixville']) && !empty($_POST['choixville'])) && (isset($_POST['descriptif'])  && !empty($_POST['descriptif'])) ) {

			        try
			        {
			            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			        }
			        catch(Exception $e)
			        {
			            die('Erreur : '.$e->getMessage());
			        }

			        // on recherche si ce login est déjà utilisé par un autre membre
			        $sql = 'SELECT count(*) FROM groupe WHERE Titre="'.$_POST['nomgroupe'].'"';
			        $req = $base->query($sql);
			        $data = $req->fetch();

			        if ($data[0] == 0) {
			        $sql = 'INSERT INTO groupe(Titre, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Nom_sport, Pseudo_membre_createur, Date_creation) VALUES("'.$_POST['nomgroupe'].'", "'.$_POST['descriptif'].'", "'.$_POST['choixville'].'", "'.$_POST['nbmembres'].'","'.$_POST['photo'].'", "'.$_POST['choixsport'].'", "'.$_SESSION['Pseudo'].'", CURDATE())';
			        $base->query($sql);
			        }

			        header('Location: groupes.php');
			        
			    }
			    
			}
		?>


		<div class="groupe">

    		<?php
    		if (isset($_SESSION['Pseudo'])) {
				?>
				<div class="groupeformulaire">
					<form action="groupes.php" method="post">
						<h3>Rechercher un groupe</h3>
			        	<p>
			        		<label for="sport">Sport</label> : <input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>"/><br />
			        		<label for="ville">Ville</label> : <input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"/><br />
					        <input type="submit" name="valider" value="Valider" id="valider">
						</p>
			    	</form>
    			</div>
				<div class="formulairecreergroupe">
					<form action="groupes.php" method="post">
						<h3>Créer un groupe</h3>
			        	<p>
			        		<label for="nomgroupe">Nom du groupe</label> : <input type="text" name="nomgroupe" placeholder="Entrez un nom" value="<?php if (isset($_POST['nomgroupe'])) echo htmlentities(trim($_POST['nomgroupe'])); ?>"/><br />
			        		<label for="choixsport">Sport</label> : <input type="text" name="choixsport" placeholder="Entrez un sport" value="<?php if (isset($_POST['choixsport'])) echo htmlentities(trim($_POST['choixsport'])); ?>"/><br />
			        		<label for="choixville">Ville</label> : <input type="text" name="choixville" placeholder="Entrez une ville" value="<?php if (isset($_POST['choixville'])) echo htmlentities(trim($_POST['choixville'])); ?>"/><br />
			        		<label for="descriptif">Desriptif</label> : <input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php if (isset($_POST['descriptif'])) echo htmlentities(trim($_POST['descriptif'])); ?>"/><br />
			        		<label for="nbmembres">Nombre de membres</label> : <input type="text" name="nbmembres" placeholder="Entrez un nombre de membres" value="<?php if (isset($_POST['nbmembres'])) echo htmlentities(trim($_POST['nbmembres'])); ?>"/><br />
			        		<label for="photo">Photo</label> : <input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>"/><br />
					        <input type="submit" name="creer" value="Créer" id="creer">
						</p>
			    	</form>
    			</div>
			<?php
			}

			else if (!isset($_SESSION['Pseudo'])) {
				?>
				<div class="groupeformulaire2">
					<form action="groupes.php" method="post">
						<h3>Rechercher un groupe</h3>
			        	<p>
			        		<label for="sport">Sport</label> : <input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>"/><br />
			        		<label for="ville">Ville</label> : <input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"/><br />
					        <input type="submit" name="valider" value="Valider" id="valider">
						</p>
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

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Zone_geographique="'.$_POST['ville'].'"');

					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ( (isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && empty($_POST['ville'])) ) {

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Nom_sport="'.$_POST['sport'].'"');
	
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ((isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && !empty($_POST['ville'])) ) {

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Nom_sport="'.$_POST['sport'].'" AND Zone_geographique="'.$_POST['ville'].'"');
	
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

			}

			else{

				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

					?>
					<h3 class="grouperecent">Groupes récemment ajoutés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe ORDER BY Id DESC LIMIT 0, 3');

					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="www.google.com"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();
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