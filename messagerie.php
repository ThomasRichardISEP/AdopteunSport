<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include("messagerie-model.php"); ?>

<?php
			if (isset($_POST['envoyer']) && $_POST['envoyer'] == 'Envoyer') {
				if ((isset($_POST['prenomdestinataire']) && !empty($_POST['prenomdestinataire'])) && (isset($_POST['nomdestinataire']) && !empty($_POST['nomdestinataire']))) {

					envoyermsg($_SESSION['Prenom'], $_SESSION['Nom'], $_POST['prenomdestinataire'], $_POST['nomdestinataire'], $_POST['message']);

	        	}
	        	header ('Location: messagerie.php');
	        }
	        ?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Messagerie</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>

	

	<body>

		<?php include("headermembre.php"); ?>

		<div class="messagerie">

			<div class="messagerieformulaire">
	            <form action="messagerie.php" method="post">
	            	<h3>Envoyer un nouveau message :</h3>
	            		<div class="apparenceformulaire">
			            	<label for="prenomdestinataire">Prénom destinataire : </label><input type="text" name="prenomdestinataire" placeholder="Entrez le prénom du destinataire" value="<?php if (isset($_POST['prenomdestinataire'])) echo htmlentities(trim($_POST['prenomdestinataire'])); ?>"><br />
			            	<label for="nomdestinataire">Nom destinataire : </label><input type="text" name="nomdestinataire" placeholder="Entrez le nom du destinataire" value="<?php if (isset($_POST['nomdestinataire'])) echo htmlentities(trim($_POST['nomdestinataire'])); ?>"><br /><br />
			            	<label for="message" style="vertical-align:top;">Message : </label><textarea name="message" class="message" placeholder="Entrez votre message" value="<?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?>"></textarea><br />
	            		</div>
	            	<input type="submit" name="envoyer" value="Envoyer" class="button3">
	       		</form>
	       	</div>

	       	

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
					$reponse = $bdd->query('SELECT Prenomauteur, Nomauteur, Message FROM messagerie WHERE Prenomdestinataire="'.$_SESSION['Prenom'].'" AND Nomdestinataire="'.$_SESSION['Nom'].'" ORDER BY Id DESC ');

					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="postsmessagerie">
						<div class="auteur casemessagerie">
							<?php 
							echo $donnees['Prenomauteur'] . '<br/>';
							echo $donnees['Nomauteur'];
							?>
						</div>
						<div class="msg casemessagerie">
							<?php
							echo $donnees['Message'] . '<br /><br />';
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



<!--
try
	        		{
	            		$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	        		}
	        		catch(Exception $e)
	        		{
	            		die('Erreur : '.$e->getMessage());
	        		}

	        		$sql = 'INSERT INTO messagerie(Prenomauteur, Nomauteur, Prenomdestinataire, Nomdestinataire, Message) VALUES("'.$_SESSION['Prenom'].'", "'.$_SESSION['Nom'].'", "'.$_POST['prenomdestinataire'].'", "'.$_POST['nomdestinataire'].'","'.$_POST['message'].'")';
	        		$base->query($sql);
	        		-->