<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>


<?php
if (isset($_POST['ajouter']) && $_POST['ajouter'] == 'Ajouter') {

    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm'])) && (isset($_POST['cgucheckbox'])) ) {

    if ($_POST['pass'] != $_POST['pass_confirm']) {
        $erreur = 'Attention : Les 2 mots de passe sont différents.';
    }
    else {

        try
        {
            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        // on recherche si ce login est déjà utilisé par un autre membre
        $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$_POST['login'].'"';
        $req = $base->query($sql);
        $data = $req->fetch();

        if ($data[0] == 0) {
        $sql = 'INSERT INTO membre_inscrit(Pseudo, mdp, Nom, Prenom, Date_naissance, Mail, Adresse, Ville, Photo) VALUES("'.$_POST['login'].'", "'.md5($_POST['pass']).'", "'.$_POST['nom'].'", "'.$_POST['prenom'].'","'.$_POST['naissance'].'", "'.$_POST['mail'].'", "'.$_POST['adresse'].'", "'.$_POST['ville'].'", "'.$_POST['photo'].'")';
        $base->query($sql);

        header('Location: gestionmembres.php');
        }
        else {
        $erreur = 'Attention : Un membre possède déjà ce login, veuillez en choisir en nouveau.';
        }
    }
    }
    else {
    $erreur = 'Attention : Au moins un des champs indispensables est vide.';
    }
}
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion membres</title>
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



		<div class="ajoutermembre">
            <h3>Ajouter un membre :</h3>
            <form action="gestionmembres.php" method="post">
                <div class="partie colonnegauche">
                    Pseudo :<br/>
                    Mot de passe :<br/>
                    Confirmation du mdp :<br/>
                    Prénom :<br/>
                    Nom :<br/>
                    Mail :<br/>
                    Adresse :<br/>
                    Ville :<br/>
                    Date de naissance :<br/>
                    Photo :<br/>
                </div>

                <div class="partie colonnedroite">
                    <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
                    <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
                    <input type="password" name="pass_confirm" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>"><br />
                    <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>"><br />
                    <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>"><br />
                    <input type="text" name="mail" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>"><br />
                    <input type="text" name="adresse" value="<?php if (isset($_POST['adresse'])) echo htmlentities(trim($_POST['adresse'])); ?>"><br />
                    <input type="text" name="ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"><br />
                    <input type="date" name="naissance" value="<?php if (isset($_POST['naissance'])) echo htmlentities(trim($_POST['naissance'])); ?>"><br />
                    <input type="text" name="photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>"><br />
                </div>
            
                Acceptez-vous les <a href="cgu.php" class="liencgu">CGU</a>? <input type="checkbox" name="cgucheckbox" value="cgucheckbox"><br />
                <input type="submit" name="ajouter" value="Ajouter" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>



        <h3 class="listemembres">Liste des membres du site</h3>
        
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

				$reponse = $base->query('SELECT Pseudo, Nom, Prenom, Mail FROM membre_inscrit ORDER BY Pseudo ');

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
					<br/><a href="pagemutablemembreadmin.php?Pseudomembre=<?php echo $donnees['Pseudo']; ?>"><?php echo $donnees['Pseudo'] . '<br/>'; ?></a>
					<?php
					echo $donnees['Nom'] . '<br/>';
					echo $donnees['Prenom']. '<br/>'. '<br/>';
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