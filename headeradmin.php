<header>
	<div class="container haut">
		<div class="connexion element"><img class="logosite" src="Images/adopteunsportnb.png" />
		</div>
		
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