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
		modifevent($_POST['nom'], $_POST['club'], $_POST['daterdv'], $_POST['heure']);
	}
?>

<?php
	if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer l\'évènement') {
		supprierevent($_POST['nom']);
	}
?>

<?php include("js.php"); ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gestion Evènement</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		<div class="modificationdiv">
            <h3>Modification des informations de l'évènement :</h3>
            <form method="post">

            	<?php
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				$reponse = $base->query('SELECT Nom_event, Club, Date_event, Heure_event FROM evenement WHERE Nom_event="'.$_GET['Nomevent'].'" ');
				$donnees=$reponse->fetch();
				?>

            	<div class="apparenceformulaire">
            		<label for="nom">Nom de l'évènement : </label><input type="text" name="nom" placeholder="Entrez un nom" value="<?php echo $donnees['Nom_event'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="daterdv">Date : </label><input type="date" name="daterdv" value="<?php echo $donnees['Date_event'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="heure">Heure : </label><input type="time" name="heure" value="<?php echo $donnees['Heure_event'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
					<label for="club">Club de rdv : </label><select name="club" class="clubrdv" onclick="colorer(this)" onblur="decolorer(this)">
		            	<?php
		            		try
						        {
						            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
						        }
						        catch(Exception $e)
						        {
						            die('Erreur : '.$e->getMessage());
						        }
						    $reponse = $base->prepare('SELECT Titre FROM club WHERE Zone_geographique=? AND Sport=? ');
						    $reponse->execute(array($_GET['Ville'], $_GET['Sport']));
						    while ($donnees = $reponse->fetch()) { ?>
						    	<option><?php echo $donnees['Titre']; ?></option>
						    <?php
						    }

		            	?>
		            </select><br/>
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="supprimer" value="Supprimer l'évènement" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>

        <?php include("footermembre.php"); ?>
        
	</body>	
</html>