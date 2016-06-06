<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<?php
if (isset($_POST['ajouter']) && $_POST['ajouter'] == 'Ajouter') {
    ajoutermembreadmin($_POST['login'], $_POST['pass'], $_POST['pass_confirm'], $_POST['nom'], $_POST['prenom'], $_POST['photo'], $_POST['naissance'], $_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['cgucheckbox']);
}
?>

<?php include("js.php"); ?>


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

		<?php include("headeradmin.php") ?>


		<div class="ajoutermembre">
            <h3>Ajouter un membre :</h3>
            <form action="gestionmembres.php" method="post">
            	
                <div class="apparenceformulaire">
                    <label for="login">Pseudo : </label><input type="text" name="login" placeholder="Entrez un pseudo" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="pass">Mot de passe : </label><input type="password" name="pass" placeholder="Entrez un mot de passe" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"  onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="pass_confirm">Confirmation du mdp : </label><input type="password" name="pass_confirm" placeholder="Confirmez le mdp" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="prenom">Prénom : </label><input type="text" name="prenom" placeholder="Entrez un prénom" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="nom">Nom : </label><input type="text" name="nom" placeholder="Entrez un nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="mail">Mail : </label><input type="text" name="mail" placeholder="Entrez un mail" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="adresse">Adresse : </label><input type="text" name="adresse" placeholder="Entrez une adresse" value="<?php if (isset($_POST['adresse'])) echo htmlentities(trim($_POST['adresse'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="naissance">Date de naissance : </label><input type="date" name="naissance" value="<?php if (isset($_POST['naissance'])) echo htmlentities(trim($_POST['naissance'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                    <label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
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

		<?php include("footeradmin.php") ?>

	</body>
</html>