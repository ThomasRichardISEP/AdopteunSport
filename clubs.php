<?php
session_start();
include_once("model.php");

if (isset($_POST['creer']) && $_POST['creer'] == 'Créer') {
	creerclub($_POST['nomclub'], $_POST['choixsport'], $_POST['choixville'], $_POST['descriptif'], $_POST['nbmembres'], $_POST['photo'], $_SESSION['Pseudo']);
}
?>

<?php include("js.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Clubs</title>
		
		<!-- Feuille de style -->
		<link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
		<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
		
	</head>
	<body>

		<?php include("headermembre.php"); ?>

		<div class="club">

			<?php
			if (!isset($_SESSION['Pseudo'])) {
				?>
				<div class="clubformulaire">
					<form action="clubs.php" method="post">
						<h3>Rechercher un club</h3>
				        <div class="apparenceformulaire">
				        	<label for="sport">Sport : </label><input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>"  onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
				        </div>
			        	<input type="submit" name="valider" value="Valider" class="button3">
			    	</form>
	    		</div>
	    	<?php
	    	}

	    	else if (isset($_SESSION['Pseudo'])) {
	    		?>
	    		<div class="clubformulaire2">
					<form action="clubs.php" method="post">
						<h3>Rechercher un club</h3>
				        <div class="apparenceformulaire">
				        	<label for="sport">Sport : </label><input type="text" name="sport" placeholder="Entrez un sport" value="<?php if (isset($_POST['sport'])) echo htmlentities(trim($_POST['sport'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez une ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
				        </div>
			        	<input type="submit" name="valider" value="Valider" class="button3">
			    	</form>
	    		</div>

	    		<div class="formulairecreerclub">
					<form action="clubs.php" method="post">
						<h3>Ajouter un club</h3>
			        	<div class="apparenceformulaire">
			        		<label for="nomclub">Nom du club : </label><input type="text" name="nomclub" placeholder="Entrez un nom" value="<?php if (isset($_POST['nomclub'])) echo htmlentities(trim($_POST['nomclub'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="choixsport">Sport : </label><input type="text" name="choixsport" placeholder="Entrez un sport" value="<?php if (isset($_POST['choixsport'])) echo htmlentities(trim($_POST['choixsport'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="choixville">Ville : </label><input type="text" name="choixville" placeholder="Entrez une ville" value="<?php if (isset($_POST['choixville'])) echo htmlentities(trim($_POST['choixville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="descriptif">Descriptif : </label><input type="text" name="descriptif" placeholder="Entrez un descriptif" value="<?php if (isset($_POST['descriptif'])) echo htmlentities(trim($_POST['descriptif'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="nbmembres">Nb de membres : </label><input type="text" name="nbmembres" placeholder="Entrez un nb de membres" value="<?php if (isset($_POST['nbmembres'])) echo htmlentities(trim($_POST['nbmembres'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        		<label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez une photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"/><br />
			        	</div>			        		
					        <input type="submit" name="creer" value="Créer" class="button3">
						
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
						<h3 class="grouperecent">Clubs trouvés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM club WHERE Zone_geographique="'.$_POST['ville'].'"');
	
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="clubville">
						<a href="pagemutableclub.php?Titreclub=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'];
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ( (isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && empty($_POST['ville'])) ) {

					?>
						<h3 class="grouperecent">Clubs trouvés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM club WHERE Sport="'.$_POST['sport'].'"');
		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="clubville">
						<a href="pagemutableclub.php?Titreclub=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'];
						?>
						</div>
					
					<?php
					}

					$reponse->closeCursor();

				}

				else if ((isset($_POST['sport']) && !empty($_POST['sport'])) && (isset($_POST['ville']) && !empty($_POST['ville'])) ) {

					?>
						<h3 class="grouperecent">Clubs trouvés</h3>
					<?php

					$reponse = $base->query('SELECT Titre, Descriptif, Zone_geographique FROM club WHERE Sport="'.$_POST['sport'].'" AND Zone_geographique="'.$_POST['ville'].'"');
		
					while ($donnees = $reponse->fetch())
					{ ?>

						<div class="clubville">
						<a href="pagemutableclub.php?Titreclub=<?php echo $donnees['Titre']; ?>"><?php echo $donnees['Titre'] . '<br/>'; ?></a>
						<?php 
						echo $donnees['Descriptif'] . '<br/>';
						echo $donnees['Zone_geographique'];
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