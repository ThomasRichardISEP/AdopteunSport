<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Gestion FAQ</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headeradmin.php") ?>

		<div class="faqadmindiv">
			<h3>Ajouter une question / réponse :</h3>
			<form action="faq_post.php" method="post" class="faqformulaire">
		        	<label for="Question">Question</label> :<br/>
		        	<textarea name="Question" class="contenu" placeholder="Entrez votre question"></textarea><br />
		        	<label for="Reponse">Réponse</label> :<br />
				    <textarea name="Reponse" class="contenu" placeholder="Entrez votre réponse"></textarea><br />
				    <input type="submit" value="Envoyer" class="button3" />
		    </form>
		</div>



		<div class="faq2">
			
			<?php
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}

		// Récupération des 10 derniers messages
		$reponse = $bdd->query('SELECT Question, Reponse, Id FROM faq ORDER BY Id');

		// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
		while ($donnees = $reponse->fetch())
		{ ?>

			<div class="posts">
			<div class="question case">
				<?php 
				echo $donnees['Question'] . ' ' . '(Id question : ';
				echo $donnees['Id'] . ') / ';
				?>
				<a href="suppressionfaq.php?Idquestion=<?php echo $donnees['Id'] ?>">Supprimer</a>
			</div>
			<div class="reponse case">
				<?php
				echo $donnees['Reponse'] . '<br /><br />';
				?>
				<form method="post">
				</form>
			</div>
		</div>
		
		<?php
		}

		$reponse->closeCursor();

		?>	

		</div>


		<?php include("footeradmin.php") ?>

	</body>
</html>