<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<!-- Validation de la modification des infos d'un membre par l'administrateur -->
<?php
	if (isset($_POST['valider']) && $_POST['valider'] == 'Valider') {
		updatemembreadmin($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['naissance'], $_POST['photo']);
	}
?>

<!-- Suppression d'un membre du site -->
<?php
	if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer le membre') {
		supprimermembreadmin($_POST['login']);
	}
?>

<?php include("js.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Page Mutable Membre Admin</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headeradmin.php") ?>


		<div class="modificationdiv">
            <h3>Modification des informations du membre :</h3>
            <form action="pagemutablemembreadmin.php" method="post">
            	
            	<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->query('SELECT Pseudo, Nom, Prenom, Date_naissance, Mail, Adresse, Ville, Photo, Administrateur FROM Membre_inscrit WHERE Pseudo="'.$_GET['Pseudomembre'].'"');
				$donnees=$reponse->fetch();
				?>

            	<div class="apparenceformulaire">
            		<label for="login">Pseudo : </label><input type="text" name="login" placeholder="Entrez un Pseudo" value="<?php echo $donnees['Pseudo'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="prenom">Prénom : </label><input type="text" name="prenom" placeholder="Entrez un prénom" value="<?php echo $donnees['Prenom'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="nom">Nom : </label><input type="text" name="nom" placeholder="Entrez un nom" value="<?php echo $donnees['Nom'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="mail">Mail : </label><input type="text" name="mail" placeholder="Entrez un mail" value="<?php echo $donnees['Mail'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="adresse">Adresse : </label><input type="text" name="adresse" placeholder="Entrez une adresse" value="<?php echo $donnees['Adresse'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez une ville" value="<?php echo $donnees['Ville'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="naissance">Date de naissance : </label><input type="date" name="naissance" value="<?php echo $donnees['Date_naissance'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez une photo" value="<?php echo $donnees['Photo'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br/>
            	</div>

            	<?php
		            	if ($donnees['Administrateur']==0){
		            		?>
		            			<label for="admincheckbox">Administrateur : </label><input type="checkbox" name="admincheckbox" value="admincheckbox">
		            		<?php
		            	}
		            	else if ($donnees['Administrateur']==1){
		            		?>
		            			<label for="admincheckbox">Administrateur : </label><input type="checkbox" name="admincheckbox" value="admincheckbox" checked>
		            		<?php
		            	}
		            ?><br/>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="supprimer" value="Supprimer le membre" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>


		<?php include("footeradmin.php") ?>

	</body>	
</html>