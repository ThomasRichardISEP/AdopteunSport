<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Football</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/stylefootball.css' rel='stylesheet' type='text/css' />
		
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
		

		<div class="corps">
			<div class="ligne1">
				<a href="football.php" class="clubfoot psg">PSG</a>
				<a href="inscription.php" class="clubfoot losc">LOSC</a>
				<a href="inscription.php" class="clubfoot asse">ASSE</a>
				<a href="inscription.php" class="clubfoot monaco">Monaco</a>
			</div><br>	


			<div class="ligne2">
				<a href="inscription.php" class="clubfoot">Tennis</a>
				<a href="inscription.php" class="clubfoot">Badminton</a>
				<a href="inscription.php" class="clubfoot">Pingpong</a>
				<a href="inscription.php" class="clubfoot">Basket</a>
			</div><br>
			

			<div class="ligne3">
				<a href="inscription.php" class="clubfoot">Cyclisme</a>
				<a href="inscription.php" class="clubfoot">Natation</a>
				<a href="inscription.php" class="clubfoot">Escalade</a>
				<a href="inscription.php" class="clubfoot">Basket</a>
			</div>


			<div class="ligne4">
				<a href="inscription.php" class="clubfoot">Curling</a>
				<a href="inscription.php" class="clubfoot">Plongeon</a>
				<a href="inscription.php" class="clubfoot">Tir à l'arc</a>
				<a href="inscription.php" class="clubfoot">Basket</a>
			</div>


			<div class="ligne5">
				<a href="inscription.php" class="clubfoot">Curling</a>
				<a href="inscription.php" class="clubfoot">Plongeon</a>
				<a href="inscription.php" class="clubfoot">Tir à l'arc</a>
				<a href="inscription.php" class="clubfoot">Basket</a>
			</div>
		</div>


		<footer>
			<div class="company bas">
				<h3>Company</h3>
				<a href="https://www.google.fr" class="lienfootercompany">A propos de nous</a>
				<a href="cgu.php" class="lienfootercompany">CGU</a><br/>
				<a href="accueilen.php" class="lienfootercompany">English version</a>
			</div>

			<div class="espace bas">
			</div>

			<div class="contact bas">
				<h3>Contact</h3>
				<a href="https://www.google.fr" class="rsociaux mail"></a>
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