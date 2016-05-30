<?php
session_start();
	$club = $_GET['Titreclub'];
	if (isset($_POST['rejoindre']) && $_POST['rejoindre'] == 'Rejoindre') {

		try
			{
			    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
			    die('Erreur : '.$e->getMessage());
			}

		$req = $base->prepare('SELECT count(*) FROM appartenance_club WHERE Pseudo_membre_inscrit = ? AND Titre_club = ? ');
		$req->execute(array($_SESSION['Pseudo'], $club));
		$data = $req->fetch();

		if ($data[0] == 0) {
			$sql = 'INSERT INTO appartenance_club(Pseudo_membre_inscrit, Titre_club, Date_inscription) VALUES("'.$_SESSION['Pseudo'].'", "'.$club.'", CURDATE())';
			$base->query($sql);
		}
	}


	if (isset($_POST['desinscription']) && $_POST['desinscription'] == 'Desinscription') {
		try
			{
			    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
			    die('Erreur : '.$e->getMessage());
			}

		$req = $base->prepare('DELETE FROM appartenance_club WHERE Pseudo_membre_inscrit = ? AND Titre_club = ? ');
		$req->execute(array($_SESSION['Pseudo'], $club));
	}


	if (isset($_POST['envoyer']) && $_POST['envoyer'] == 'Envoyer') {
		try
			{
			    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
			    die('Erreur : '.$e->getMessage());
			}

		$req = $base->prepare('INSERT INTO avisclub(Commentaire, Note, Pseudo_membre, Club) VALUES (?, ?, ?, ?)' );
		$req->execute(array($_POST['commentaire'], $_POST['note'], $_SESSION['Pseudo'], $club));
	}
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Page Mutable Club</title>
		
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

		
		<div class="detailclub">
			<h3><?php echo $_GET['Titreclub']; ?></h3>
			<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique, Nb_max_personnes, Pseudo_membre_createur, Date_creation FROM club WHERE Titre="'.$_GET['Titreclub'].'"');

				while ($donnees = $reponse->fetch())
					{ ?>
						<p>Ce groupe est un <?php echo $donnees['Descriptif']; ?>.</p>
						<p>Ce groupe se situe à <?php echo $donnees['Zone_geographique']; ?>.</p>
						<p>Ce groupe accueille au maximum <?php echo $donnees['Nb_max_personnes']; ?> personnes.</p>
						<p>Ce groupe est dirigé par <?php echo $donnees['Pseudo_membre_createur']; ?>.</p>
						<p>Ce groupe a été créé le <?php echo $donnees['Date_creation']; ?>.</p>
					<?php
					}

					$reponse->closeCursor();
				
				if (isset($_SESSION['Pseudo'])){

					$req = $base->prepare('SELECT count(*) FROM appartenance_club WHERE Pseudo_membre_inscrit = ? AND Titre_club = ? ');
					$req->execute(array($_SESSION['Pseudo'], $club));
					$data = $req->fetch();

					if ($data[0] == 1) {
						?><form method="post">
							<input type="submit" name="desinscription" value="Desinscription" class="button3">
							</form>
						<?php
					}
					else if ($data[0] == 0) {
						?><form method="post">
							<input type="submit" name="rejoindre" value="Rejoindre" class="button3">
						</form>
					<?php 
					}

				}

			?>	
		</div>


			<?php
			if (isset($_SESSION['Pseudo'])){
				?>
				<div class="donneravisclub">
					<h4>Donnez votre avis sur le club</h4>
						<form method="post">
				        	Votre commentaire :<br/>
				        	<textarea name="commentaire" class="commentaire" placeholder="Entrez un commentaire"></textarea><br />
				        	Votre note :
				        	<select name="note" class="note">
				        		<option value="0">0</option>
				        		<option value="1">1</option>
				        		<option value="2">2</option>
				        		<option value="3">3</option>
				        		<option value="4">4</option>
				        		<option value="5">5</option>
				        	</select> / 5<br /><br/>	        		
						    <input type="submit" name="envoyer" value="Envoyer" class="button3">
				    	</form>
			    </div>
			    <?php
			}
			?>


		<div class="avisclub">

			<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->prepare('SELECT Note FROM avisclub WHERE Club = ? ');
				$reponse->execute(array($club));
				$moyenne = 0;
				$nb = 0;

				while ($donnees = $reponse->fetch()){
					$moyenne = $moyenne + $donnees['Note'];
					$nb = $nb + 1;
				}

				$moyenne = $moyenne / $nb;
				$moyenne = number_format($moyenne, 1, ',', ' ');
			?>

			<h4>Avis des membres (Note moyenne : <?php echo $moyenne; ?> / 5)</h4>


			<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->prepare('SELECT Commentaire, Note, Pseudo_membre FROM avisclub WHERE Club = ? ORDER BY Id ');
				$reponse->execute(array($club));

				while ($donnees = $reponse->fetch()){
					echo $donnees['Pseudo_membre'] . ' a donné la note de ';
					echo $donnees['Note'] . ' / 5, et a commenté : ';
					echo $donnees['Commentaire'] . '<br/>' . '<br/>';
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