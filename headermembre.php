<header>
	<div class="container haut">
		<div class="connexion element"><a href="index.php"><img class="logosite" src="Images/adopteunsportnb.png" /></a>
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