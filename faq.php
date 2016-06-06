<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aide</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		<div class="faq">
			
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
		$reponse = $bdd->query('SELECT Question, Reponse FROM faq ORDER BY Id');

		// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
		while ($donnees = $reponse->fetch())
		{ ?>

			<div class="posts" onclick="affiche_div()">
			<div class="question case">
				<?php 
				echo $donnees['Question'];
				?>
			</div>
			<div class="reponse case" style="display: none;">
				<?php
				echo $donnees['Reponse'] . '<br /><br />';
				?>
			</div>
		</div>
		
		<?php
		}

		$reponse->closeCursor();

		?>	

		</div>


		<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js">	// permet d'avoir une action quand on clique sur une question
		</script>
		<script type="text/javascript">
			$(document).ready(function(){ //quand la page est chargé
				$('.question').click(function(){
					$(this).next().slideToggle(); //slideToggle pour passer à la question d'en dessous
				})
			})
		</script> 

		<?php include("footermembre.php"); ?>
		
	</body>
</html>