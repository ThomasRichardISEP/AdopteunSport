<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<?php
	if (isset($_POST['supprimer']) && $_POST['supprimer'] == 'Supprimer la question') {
		supprimerfaq($_GET['Idquestion']);
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Suppression FAQ</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headeradmin.php") ?>


		<div class="suppressionpost">
			<h3>Etes-vous sûr de vouloir supprimer la question <?php echo $_GET['Idquestion']; ?>?</h3>
			<form method="post">
				<input type="submit" name="supprimer" value="Supprimer la question" class="button3">
			</form>
		</div>

		<?php include("footeradmin.php") ?>

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

		        $reponse = $base->prepare('DELETE FROM faq WHERE Id = ? ');
		        $reponse->execute(array($_GET['Idquestion']));
		        header ('Location: faqadmin.php');
		        -->