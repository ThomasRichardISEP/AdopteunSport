<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<!-- Ajout d'un groupe par l'administrateur -->
<?php
	if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {
		creergroupeadmin($_POST['nomgroupe'], $_POST['choixsport'], $_POST['choixville'], $_POST['descriptif'], $_POST['nbmembres'], $_POST['photo'], $_SESSION['Pseudo']);
	}
?>

<?php include("js.php"); ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion groupes</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headeradmin.php") ?>


		<div class="gestiongroupesadmin">
					<form action="gestiongroupes.php" method="post">
						<h3>Créer un groupe</h3>

			        	<div class="apparenceformulaire">
			        		<label for="nomgroupe">Nom du groupe : </label><input type="text" name="nomgroupe" placeholder="Entrez un nom" value="<?php if (isset($_POST['nomgroupe'])) echo htmlentities(trim($_POST['nomgroupe'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="choixsport">Sport : </label><input type="text" name="choixsport" placeholder="Entrez un sport" value="<?php if (isset($_POST['choixsport'])) echo htmlentities(trim($_POST['choixsport'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="choixville">Ville : </label><input type="text" name="choixville" placeholder="Entrez une ville" value="<?php if (isset($_POST['choixville'])) echo htmlentities(trim($_POST['choixville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="descriptif">Descriptif : </label><input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php if (isset($_POST['descriptif'])) echo htmlentities(trim($_POST['descriptif'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="nbmembres">Nb de membres : </label><input type="text" name="nbmembres" placeholder="Entrez un nombre de membres" value="<?php if (isset($_POST['nbmembres'])) echo htmlentities(trim($_POST['nbmembres'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        	</div>			        		
					    <input type="submit" name="creer" value="Créer" class="button3">
			    	</form>
    			</div>


        <h3 class="listemembres">Liste des groupes du site</h3>
        

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

				$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique, Pseudo_membre_createur FROM groupe ORDER BY Titre ');

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
						<br/><a href="pagemutablegroupeadmin.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'] . '<br/>';
						echo $donnees['Pseudo_membre_createur']. '<br/>'. '<br/>';
						?>
					</div>

				<?php
				}

				$reponse->closeCursor();	
		?>

		<?php include("footeradmin.php") ?>

	</body>
</html>