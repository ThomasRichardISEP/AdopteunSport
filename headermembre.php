<header>
	<div class="block">
		
		<div class="sousblock1">
			<a href="index.php"><img class="imagesite" src="Images/adopteunsportnb.png" /></a>
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
					<a href="membre.php" class="lienpseudo"><?php echo($_SESSION['Pseudo']) ?></a>
					<a href="deconnexion.php" class="clic1">Déconnexion</a>
					<?php
				}
			?>
			</div>
		</div>

		<div class="sousblock2">
			<a href="membre.php" class="clic2">Profil</a>
			<a href="clubs.php" class="clic2">Club</a>
			<a href="groupes.php" class="clic2">Groupes</a>
			<a href="forum.php" class="clic2">Forum</a>
			<a href="faq.php" class="clic2">Aide</a>
		</div>

	</div>
</header>