<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion FAQ</title>
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



		<div class="faqadmindiv">
			<h3>Ajouter une question / réponse :</h3>
			<form action="faq_post.php" method="post" class="faqformulaire">
		        	<label for="Question">Question</label> :<br/>
		        	<textarea name="Question" class="contenu" placeholder="Entrez votre question"></textarea><br />
		        	<label for="Reponse">Réponse</label> :<br />
				    <textarea name="Reponse" class="contenu" placeholder="Entrez votre réponse"></textarea><br />
				    <input type="submit" value="Envoyer" class="button3" />
		    </form>
		</div>



		<div class="faq2">
			
			<?php
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}

		// Récupération des 10 derniers messages
		$reponse = $bdd->query('SELECT Question, Reponse, Id FROM faq ORDER BY Id');

		// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
		while ($donnees = $reponse->fetch())
		{ ?>

			<div class="posts">
			<div class="question case">
				<?php 
				echo $donnees['Question'] . ' ' . '(Id question : ';
				echo $donnees['Id'] . ') / ';
				?>
				<a href="suppressionfaq.php?Idquestion=<?php echo $donnees['Id'] ?>">Supprimer</a>
			</div>
			<div class="reponse case">
				<?php
				echo $donnees['Reponse'] . '<br /><br />';
				?>
				<form method="post">
				</form>
			</div>
		</div>
		
		<?php
		}

		$reponse->closeCursor();

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