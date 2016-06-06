<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<?php
	if (isset($_POST['valider']) && $_POST['valider'] == 'Valider') {
		modifgroupeleader($_POST['titre'], $_POST['descriptif'], $_POST['zonegeo'], $_POST['nbpers'], $_POST['photo'], $_POST['nomsport'], $_POST['pseudocreateur'], $_POST['datecreation']);
	}
?>

<?php
	if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer le groupe') {
		supprimergroupeleader($_POST['titre']);
	}
?>

<?php include("js.php"); ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gestion Groupe</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		<div class="modificationdiv">
            <h3>Modification des informations du groupe :</h3>
            <form action="modifgroupeleader.php" method="post">

            	<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Nom_sport, Pseudo_membre_createur, Date_creation FROM groupe WHERE Titre="'.$_GET['Titregroupe'].'" ');
				$donnees=$reponse->fetch();
				?>

            	<div class="apparenceformulaire">
            		<label for="titre">Titre : </label><input type="text" name="titre" placeholder="Entrez un titre" value="<?php echo $donnees['Titre'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="descriptif">Descriptif : </label><input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php echo $donnees['Descriptif'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="nomsport">Nom du sport : </label><input type="text" name="nomsport" placeholder="Entrez un sport" value="<?php echo $donnees['Nom_sport'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="zonegeo">Zone géographique : </label><input type="text" name="zonegeo" placeholder="Entrez une ville" value="<?php echo $donnees['Zone_geographique'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="nbpers">Nb max de personnes : </label><input type="text" name="nbpers" placeholder="Entrez un nb de personnes" value="<?php echo $donnees['Nb_max_personnes'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez une photo" value="<?php echo $donnees['Photo'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="pseudocreateur">Pseudo leader : </label><input type="text" placeholder="Entrez un pseudo leader" name="pseudocreateur" value="<?php echo $donnees['Pseudo_membre_createur'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="datecreation">Date création : </label><input type="date" name="datecreation" value="<?php echo $donnees['Date_creation'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="supprimer" value="Supprimer le groupe" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>


        <div class="liencreaevent">
        	<a href="event.php?Groupe=<?php echo $_GET['Titregroupe']; ?>&amp;Ville=<?php echo $donnees['Zone_geographique']; ?>&amp;Sport=<?php echo $donnees['Nom_sport']; ?>" class="button3">Gestion des évènements</a>
        </div>


        <h3 class="grouperecent">Membres inscrits à ce groupe :</h3>

        <?php
			try
			{
			$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			$reponse = $base->query('SELECT Pseudo_membre_inscrit FROM appartenance_groupe WHERE Titre_groupe = "'.$_GET['Titregroupe'].'" ');

			while ($donnees = $reponse->fetch())
			{ ?>
				<div class="membrestrouves">
				<br/><?php
				echo $donnees['Pseudo_membre_inscrit']. '<br/>';
				?>
				<a href="suppressionmembre.php?Titregroupe=<?php echo $_GET['Titregroupe']; ?>&amp;Pseudomembre=<?php echo $donnees['Pseudo_membre_inscrit']; ?>" class="button3">Supprimer ce membre</a>
				<br/><br/>
				</div>

			<?php
			}

			$reponse->closeCursor();	
		?>

		<?php include("footermembre.php"); ?>

	</body>	
</html>