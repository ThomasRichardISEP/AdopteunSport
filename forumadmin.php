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
		<title>Gestion Forum</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headeradmin.php") ?>


		<div class="forumadmindiv">
			<form action="forum_post_admin.php" method="post">
				<h3>Poster un message :</h3>
				<label for="Contenu">Message</label> :<br />
				<textarea name="Contenu" class="contenu" placeholder="Entrez votre message"></textarea><br />
				<input type="submit" value="Envoyer" class="button3" />
			</form>
		</div>


		<div class="forum2">

			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			// Récupération des messages
			$reponse = $bdd->query('SELECT Pseudo_membre_inscrit, Contenu, Date_message, Heure_message, Id_message FROM messages ORDER BY Id_message DESC ');

			// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
			while ($donnees = $reponse->fetch())
			{ ?>

				<div class="postsforum">
				<div class="auteur caseforum">
					<?php 
					echo $donnees['Pseudo_membre_inscrit'] . ' ' . '(Id msg : ' ;
					echo $donnees['Id_message'] . ')' . '<br/>' . 'le ';
					echo $donnees['Date_message'] . ' à ';
					echo $donnees['Heure_message'];
					?>
					<br/><a href="suppressionpost.php?Idmessage=<?php echo $donnees['Id_message'] ?>">Supprimer</a>
				</div>
				<div class="msg caseforum">
					<?php
					echo $donnees['Contenu'] . '<br /><br />';
					?>
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