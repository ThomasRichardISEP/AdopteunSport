<header>
	<div class="block">
		
		<div class="sousblock1">
			<img class="imagesite" src="Images/adopteunsportnb.png" />
			<div class="element">
				<?php
				if (!isset($_SESSION['Pseudo'])) {
					?>
					<a href="inscription.php" class="clic1">Inscription</a>
					<a href="pageconnection.php" class="clic1">Connexion</a>
					<?php
				}
				else if (isset($_SESSION['Pseudo'])) {
					?>
					<a href="administrateur.php" class="lienpseudo"><?php echo($_SESSION['Pseudo']) ?></a>
					<a href="deconnexion.php" class="clic1">Déconnexion</a>
					<?php
				}
			?>
			</div>
		</div>

		<div class="sousblock2">
			<a href="administrateur.php" class="clic2">Espace Administrateur</a>
			<a href="gestionmembres.php" class="clic2">Gestion Membres</a>
			<a href="gestiongroupes.php" class="clic2">Gestion Groupes</a>
			<a href="forumadmin.php" class="clic2">Gestion Forum</a>
			<a href="faqadmin.php" class="clic2">Gestion FAQ</a>
		</div>

	</div>
</header>