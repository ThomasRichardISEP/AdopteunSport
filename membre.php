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


		<div class="profil">
			<div class="profilcolonne">
				<p class="profilnom info1">Bonjour <?php echo htmlentities(trim($_SESSION['Prenom']));?> <?php echo htmlentities(trim($_SESSION['Nom'])); ?> </p>
				<p class="profilpseudo info1">Votre Pseudo est <?php echo htmlentities(trim($_SESSION['Pseudo'])); ?>! </p>
				<p class="profilnaissance info1">Vous êtes né(e) le <?php echo htmlentities(trim($_SESSION['Date_naissance'])); ?>. </p>
				<p class="profilmail info1">Votre mail est <?php echo htmlentities(trim($_SESSION['Mail'])); ?>. </p>
				<p class="profiladresse info1">Vous habitez au <?php echo htmlentities(trim($_SESSION['Adresse'])); ?>. </p><br />
				<p><a href="modifmembre.php" class="profilmodification info1">Modifier vos informations personnelles</a></p>
				<p><a href="messagerie.php" class="lienmessagerie info1">Lien vers votre messagerie Messagerie</a></p>
			</div>
			<img class="profilphoto profilcolonne" src=<?php echo htmlentities(trim($_SESSION['Photo'])); ?> />
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