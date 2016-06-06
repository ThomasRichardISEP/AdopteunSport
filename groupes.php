<?php
session_start();
include_once("model.php");

if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {
	creergroupe($_POST['nomgroupe'], $_POST['choixsport'], $_POST['choixville'], $_POST['descriptif'], $_POST['nbmembres'], $_POST['phoyo'], $_SESSION['Pseudo']);			    
}
?>

<?php include("js.php"); ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Groupes</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		<div class="groupe">

    		<?php
    		if (isset($_SESSION['Pseudo'])) {
				?>
				<div class="groupeformulaire">
					<form action="groupes.php" method="post">
						<h3>Rechercher un groupe</h3>
			        	<div class="apparenceformulaire">
			        		<label for="sport">Sport : </label><input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        	</div>
					    <input type="submit" name="valider" value="Valider" class="button3">
			    	</form>
    			</div>

				<div class="formulairecreergroupe">
					<form action="groupes.php" method="post">
						<h3>Créer un groupe</h3>
			        	<div class="apparenceformulaire">
			        		<label for="nomgroupe">Nom du groupe : </label><input type="text" name="nomgroupe" placeholder="Entrez un nom" value="<?php if (isset($_POST['nomgroupe'])) echo htmlentities(trim($_POST['nomgroupe'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="choixsport">Sport : </label><input type="text" name="choixsport" placeholder="Entrez un sport" value="<?php if (isset($_POST['choixsport'])) echo htmlentities(trim($_POST['choixsport'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="choixville">Ville : </label><input type="text" name="choixville" placeholder="Entrez une ville" value="<?php if (isset($_POST['choixville'])) echo htmlentities(trim($_POST['choixville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="descriptif">Descriptif : </label><input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php if (isset($_POST['descriptif'])) echo htmlentities(trim($_POST['descriptif'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="nbmembres">Nb de membres : </label><input type="text" name="nbmembres" placeholder="Entrez un nombre de membres" value="<?php if (isset($_POST['nbmembres'])) echo htmlentities(trim($_POST['nbmembres'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        	</div>			        		
					        <input type="submit" name="creer" value="Créer" class="button3">
						
			    	</form>
    			</div>

			<?php
			}

			else if (!isset($_SESSION['Pseudo'])) {
				?>
				<div class="groupeformulaire2">
					<form action="groupes.php" method="post">
						<h3>Rechercher un groupe</h3>
			        	<div class="apparenceformulaire">
			        		<label for="sport">Sport : </label><input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        	</div>
					    <input type="submit" name="valider" value="Valider" class="button3">
			    	</form>
    			</div>
    		<?php
    		}
			?>


			<?php
			if (isset($_POST['valider']) && $_POST['valider'] == 'Valider') {
				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}

				if ( (isset($_POST['ville']) && !empty($_POST['ville'])) && (isset($_POST['sport']) && empty($_POST['sport'])) ) {

					?>
						<h3 class="grouperecent">Groupes trouvés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Zone_geographique="'.$_POST['ville'].'"');

					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="pagemutablegroupe.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>' . '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ( (isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && empty($_POST['ville'])) ) {

					?>
						<h3 class="grouperecent">Groupes trouvés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Nom_sport="'.$_POST['sport'].'"');
	
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="pagemutablegroupe.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>' . '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ((isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && !empty($_POST['ville'])) ) {

					?>
						<h3 class="grouperecent">Groupes trouvés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Nom_sport="'.$_POST['sport'].'" AND Zone_geographique="'.$_POST['ville'].'"');
	
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="groupestrouves">
						<br/><a href="pagemutablegroupe.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique']. '<br/>' . '<br/>';
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

			}

			else{

				try
					{
						$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
					}
					catch(Exception $e)
					{
	        			die('Erreur : '.$e->getMessage());
					}


						if (isset($_SESSION['Pseudo'])) {

							?>
							<h3 class="grouperecent">Groupes récemment ajoutés dans votre ville</h3>
							<?php

							$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe WHERE Zone_geographique = "'.$_SESSION['Ville'].'" ORDER BY Id DESC LIMIT 0, 3');

							while ($donnees = $reponse->fetch())
							{ ?>

								<div class="groupestrouves">
								<br/><a href="pagemutablegroupe.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
								<?php 
								echo $donnees['Descriptif'] . '<br/>';
								echo $donnees['Zone_geographique']. '<br/>' . '<br/>';
								?>
								</div>
							
							<?php
							}

							$reponse->closeCursor();
						}

						else if (!isset($_SESSION['Pseudo'])) {

							?>
							<h3 class="grouperecent">Groupes récemment ajoutés</h3>
							<?php

							$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM groupe ORDER BY Id DESC LIMIT 0, 3');

							while ($donnees = $reponse->fetch())
							{ ?>

								<div class="groupestrouves">
								<br/><a href="pagemutablegroupe.php?Titregroupe=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
								<?php 
								echo $donnees['Descriptif'] . '<br/>';
								echo $donnees['Zone_geographique']. '<br/>'. '<br/>';
								?>
								</div>
							
							<?php
							}

							$reponse->closeCursor();
						}

			}	
			?>

		</div>

		<?php include("footermembre.php"); ?>
		
	</body>	
</html>