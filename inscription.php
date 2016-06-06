<?php
include_once("model.php");

// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
    inscription($_POST['login'], $_POST['pass'], $_POST['pass_confirm'], $_POST['nom'], $_POST['prenom'], $_POST['photo'], $_POST['naissance'], $_POST['mail'], $_POST['adresse'], $_POST['ville'], $_POST['cgucheckbox']);
}
?>

<?php include("js.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>

        <!-- Feuilles de style -->
        <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
        <link href='assets/css/style.css' rel='stylesheet' type='text/css' />
    </head>

    <body>
    	<header>
            <div class="container">
                <div class="connexion"><a href="index.php"><img class="logosite" src="Images/adopteunsportnb.png" /></a></div>
            </div>
        </header>

        


        <div class="inscriptiondiv">
            <h3>Inscription à l'espace membre :</h3>
            <form action="inscription.php" method="post">

                <div class="apparenceformulaire">
                    <label for="login">Pseudo : </label><input type="text" name="login" placeholder="Entrez votre Pseudo" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="pass">Mot de passe : </label><input type="password" name="pass" placeholder="Entrez votre mot de passe" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="pass_confirm">Confirmation du mdp : </label><input type="password" name="pass_confirm" placeholder="Confirmez votre mdp" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="prenom">Prénom : </label><input type="text" name="prenom" placeholder="Entrez votre prénom" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="nom">Nom : </label><input type="text" name="nom" placeholder="Entrez votre nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="mail">Mail : </label><input type="text" name="mail" placeholder="Entrez votre mail" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="adresse">Adresse : </label><input type="text" name="adresse" placeholder="Entrez votre adresse" value="<?php if (isset($_POST['adresse'])) echo htmlentities(trim($_POST['adresse'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="ville">Ville : </label><input type="text" name="ville" placeholder="Entrez votre ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="naissance">Date de naisance : </label><input type="date" name="naissance" value="<?php if (isset($_POST['naissance'])) echo htmlentities(trim($_POST['naissance'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"  required><br />
                    <label for="photo">Photo : </label><input type="text" name="photo"  placeholder="Entrez votre photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>" onclick="colorer(this)" onblur="decolorer(this)"><br />
                </div>
            
                Acceptez-vous les <a href="cgu.php" class="liencgu">CGU</a>? <input type="checkbox" name="cgucheckbox" value="cgucheckbox"><br />
                <input type="submit" name="inscription" value="Inscription" class="button3">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
        </div>

        <?php include("footermembre.php"); ?>

    </body>
</html>