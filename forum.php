<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Forum</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />

	</head>
	<body>

		<?php include("headermembre.php"); ?>		

		<div class="forum">

			<?php
				if (isset($_SESSION['Pseudo'])) {
				?>
					<form action="forum_post.php" method="post" class="forumformulaire">
						<h3>Poster un message :</h3>
			        	<label for="Contenu">Message</label> :<br />
			        	<textarea name="Contenu" class="contenu" placeholder="Entrez votre message"></textarea><br />
					    <input type="submit" value="Envoyer" class="button3" />
			    	</form>
	    	<?php
	    		}
	    	?>

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
			$reponse = $bdd->query('SELECT Pseudo_membre_inscrit, Contenu, Date_message, Heure_message FROM messages ORDER BY Id_message DESC ');

			// Affichage de chaque message
			while ($donnees = $reponse->fetch())
			{ ?>

				<div class="postsforum">
				<div class="auteur caseforum">
					<?php 
					echo $donnees['Pseudo_membre_inscrit'] . '<br/>' . 'le ';
					echo $donnees['Date_message'] . ' à ';
					echo $donnees['Heure_message'];
					?>
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

		<?php include("footermembre.php"); ?>

    </body>
</html>