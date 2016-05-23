<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Groupe 6C</title>
		
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


		<div class="groupe6c">
			<h1>Adopte un Sport, créé par le Groupe 6C</h1>
			<p>Nous sommes Web’Design, une TPE créé en 2016 d’édition et de développement de logiciel web. Nous répondons à l’appel d’offre de votre 
			association concernant la réalisation d’un site web afin de pouvoir réunir et unifier les sports et les communautés de sportifs en France. 
			Nous sommes une équipe de sept étudiants ingénieurs. Cette association est à but non lucratif mais surtout à vocation pédagogique. 
			En effet, les sept responsables espèrent aujourd’hui qu’engendrer uniquement un maximum de responsabilité et d’expérience.</p><br />
			<p>Le projet consiste à créer un site internet codé en « dur » c’est à dire de A à Z par les sept étudiants très motivées, qui maîtrisent 
			tous les langages de base du développement web (HTML 5, CSS 3, php, MySQL). Le site devra permettre à ses utilisateurs de partager leur 
			passion pour un sport en formant des groupes de participants à des cours, des séances d'entrainement dans un club ou des compétitions 
			sportives. De plus, le back-office du site web devra permettre l’administration des informations du site via une interface WEB.</p>
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