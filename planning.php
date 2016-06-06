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
		<title>Mon planning</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>


	<body>

		<?php include("headermembre.php"); ?>


		<h3 class="grouperecent" style="margin-top:10%; display:inline-block;">Mon planning</h3>

		<?php
			try
			{
			$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			$reponse = $base->query('SELECT Titre_groupe FROM appartenance_groupe WHERE Pseudo_membre_inscrit = "'.$_SESSION['Pseudo'].'" ');

			while ($donnees = $reponse->fetch())
			{ 

				$reponse2 = $base->prepare('SELECT Nom_event, Groupe, Club, Date_event, Heure_event FROM evenement WHERE Groupe = ? ORDER BY Date_event ');
				$reponse2->execute(array($donnees['Titre_groupe']));
				while ($donnees2 = $reponse2->fetch()){
					?>
					<div class="membrestrouves">
						<br/>
						<?php 
						echo $donnees2['Nom_event']. '<br/>';
						echo $donnees2['Groupe']. '<br/>';
						echo $donnees2['Club']. '<br/>';
						echo $donnees2['Date_event']. '<br/>';
						echo $donnees2['Heure_event']. '<br/>';
						?>
						<br/>
					</div>
					<?php
				}
				$reponse2->closeCursor();
				
			}

			$reponse->closeCursor();	
		?>

		<?php include("footermembre.php"); ?>
		
	</body>
</html>