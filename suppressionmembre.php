<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<?php
	if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer le membre') {
		supprimermembre($_GET['Titregroupe'] ,$_GET['Pseudomembre']);
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Suppression Membre</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>


		<div class="suppressionmembre">
			<h3>Etes-vous sûr de vouloir supprimer <?php echo $_GET['Pseudomembre']; ?>?</h3>
			<form method="post">
				<input type="submit" name="supprimer" value="Supprimer le membre" class="button3">
			</form>
		</div>

		<?php include("footermembre.php"); ?>

	</body>	
</html>


<!--

	try
		        {
		            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		        }
		        catch(Exception $e)
		        {
		            die('Erreur : '.$e->getMessage());
		        }

		        $reponse = $base->prepare('DELETE FROM appartenance_groupe WHERE Titre_groupe = ? AND Pseudo_membre_inscrit = ? ');
		        $reponse->execute(array($_GET['Titregroupe'] ,$_GET['Pseudomembre']));
		        header ('Location: membre.php');
		        -->