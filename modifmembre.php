<?php
	session_start();
	if (!isset($_SESSION['Pseudo'])) {  
		header ('Location: index.php');
		exit();
	}
	?>

<?php include_once("model.php"); ?>

<?php
	if (isset($_POST['valider']) && $_POST['valider'] == 'Valider') {
		modifmembre($_POST['login'], $_POST['old_pass'], $_POST['pass'], $_POST['pass_confirm'], $_POST['prenom'], $_POST['nom'], $_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['naissance'], $_POST['photo'], $_SESSION['Pseudo']);
	}

	if (isset($_POST['effacer']) && $_POST['effacer'] == 'Effacer mon compte') {
		supprimercompte($_SESSION['Pseudo']);
	}
?>

<?php include("js.php"); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf8' />
		<title>Espace membre</title>
		<!-- Feuilles de style -->
	    <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
    	<link href='assets/css/style.css' rel='stylesheet' type='text/css' />
	</head>



	<body>

		<?php include("headermembre.php"); ?>		

		<div class="modificationdiv">
            <h3>Modification de vos informations :</h3>
            <form action="modifmembre.php" method="post">

            	<div class="apparenceformulaire">
            		<label for="login">Pseudo : </label><input type="text" name="login" placeholder="Entrez votre Pseudo" value="<?php echo $_SESSION['Pseudo'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="old_pass">Ancien mot de passe : </label><input type="password" name="old_pass" placeholder="Entrez votre ancien mdp" value="" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="pass">Nouveau mot de passe : </label><input type="password" name="pass" placeholder="Entrez votre nouveau mdp" value="" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="pass_confirm">Confirmation du mdp : </label><input type="password" name="pass_confirm" placeholder="Confirmez votre nouveau mdp" value="" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="prenom">Prénom : </label><input type="text" name="prenom" placeholder="Entrez votre prénom" value="<?php echo $_SESSION['Prenom'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="nom">Nom : </label><input type="text" name="nom" placeholder="Entrez votre nom" value="<?php echo $_SESSION['Nom'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="mail">Mail : </label><input type="text" name="mail" placeholder="Entrez votre mail" value="<?php echo $_SESSION['Mail'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="adresse">Adresse : </label><input type="text" name="adresse" placeholder="Entrez votre adresse" value="<?php echo $_SESSION['Adresse'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez votre ville" value="<?php echo $_SESSION['Ville'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="naissance">Date de naissance : </label><input type="date" name="naissance" value="<?php echo $_SESSION['Date_naissance'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
		            <label for="photo">Photo : </label><input type="text" name="photo" placeholder="Entrez votre photo" value="<?php echo $_SESSION['Photo'] ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
            	</div>
           
            	<input type="submit" name="valider" value="Valider" class="button3">
            	<input type="submit" name="effacer" value="Effacer mon compte" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>

        <?php include("footermembre.php"); ?>
		
	</body>
</html>