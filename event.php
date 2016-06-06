<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<!-- Création évènement par le leader -->
<?php
	if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {
		creerevent($_POST['nom'], $_GET['Groupe'], $_POST['club'], $_POST['daterdv'], $_POST['heure']);			    
	}
?>

<?php include("js.php"); ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Evènements</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		<div class="creationevent">
			<h3>Créer un évènement pour <?php echo $_GET['Groupe']; ?> :</h3>
			<form method="post">

            	<div class="apparenceformulaire">
            		<label for="nom">Nom de l'évènement : </label><input type="text" name="nom" placeholder="Entrez un nom" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="daterdv">Date : </label><input type="date" name="daterdv" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="heure">Heure : </label><input type="time" name="heure" onclick="colorer(this)" onblur="decolorer(this)"><br />
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

            	<input type="submit" name="creer" value="Créer" class="button3">
			</form>
		</div>


		<h3 class="grouperecent">Evènements du groupe :</h3>

		<?php
			try
			{
				$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
	        	die('Erreur : '.$e->getMessage());
			}

			?>
			
			<?php

				$reponse = $base->prepare('SELECT Nom_event, Club, Date_event, Heure_event FROM evenement WHERE Groupe = ? ORDER BY Date_event ');
				$reponse->execute(array($_GET['Groupe']));

				while ($donnees = $reponse->fetch())
				{ ?>

					<div class="membrestrouves">
					<br/>
					<a href="modifevent.php?Nomevent=<?php echo $donnees['Nom_event']; ?>&amp;Ville=<?php echo $_GET['Ville']; ?>&amp;Sport=<?php echo $_GET['Sport']; ?> "><?php echo $donnees['Nom_event']; ?></a><br/>
					<?php
					echo $donnees['Club']. '<br/>';
					echo $donnees['Date_event']. '<br/>';
					echo $donnees['Heure_event']. '<br/>';
					?>
					<br/>
					</div>

				<?php
				}

				$reponse->closeCursor();	
		?>

		<?php include("footermembre.php"); ?>

	</body>	
</html>