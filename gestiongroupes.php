<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>


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

			        header('Location: gestiongroupes.php');
			    }
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


		<div class="gestiongroupesadmin">
					<form action="gestiongroupes.php" method="post">
						<h3>Créer un groupe</h3>
			        	<div class="partie colonnegauche">
			        		Nom du groupe :<br/>
			        		Sport :<br/>
			        		Ville :<br/>
			        		Descriptif :<br/>
			        		Nb de membres :<br/>
			        		Photo :
			        	</div>
			        	<div class="partie colonnedroite">
			        		<input type="text" name="nomgroupe" placeholder="Entrez un nom" value="<?php if (isset($_POST['nomgroupe'])) echo htmlentities(trim($_POST['nomgroupe'])); ?>"/><br />
			        		<input type="text" name="choixsport" placeholder="Entrez un sport" value="<?php if (isset($_POST['choixsport'])) echo htmlentities(trim($_POST['choixsport'])); ?>"/><br />
			        		<input type="text" name="choixville" placeholder="Entrez une ville" value="<?php if (isset($_POST['choixville'])) echo htmlentities(trim($_POST['choixville'])); ?>"/><br />
			        		<input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php if (isset($_POST['descriptif'])) echo htmlentities(trim($_POST['descriptif'])); ?>"/><br />
			        		<input type="text" name="nbmembres" placeholder="Entrez un nombre de membres" value="<?php if (isset($_POST['nbmembres'])) echo htmlentities(trim($_POST['nbmembres'])); ?>"/><br />
			        		<input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>"/><br />
			        	</div>			        		
					        <input type="submit" name="creer" value="Créer" class="button3">
						
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
						<br/><a href="pagemutablegroupeadmin.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php
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