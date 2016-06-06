<?php
include_once("model.php");

        // on teste si le visiteur a soumis le formulaire de connexion
        if (isset($_POST['connecter']) && $_POST['connecter'] == 'Connecter') {
            connexionmembre($_POST['login'], $_POST['pass']);
            $erreur = connexionmembre($_POST['login'], $_POST['pass']);
        }
        ?>

<?php include("js.php"); ?>

        
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion membre</title>

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



        <div class="connexiondiv">
            <form action="pageconnection.php" method="post">
    			<h3>Connexion à l'espace membre :</h3>
                    <div class="apparenceformulaire">
                        <label for="login">Pseudo : </label><input type="text" name="login" placeholder="Entrez votre Pseudo" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" onclick="colorer(this)" onblur="decolorer(this)" required><br />
                        <label for="pass">Mot de passe : </label><input type="password" name="pass" placeholder="Entrez votre mot de passe" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>" onclick="colorer(this)" onblur="decolorer(this)" required><br />
                    </div>
                    <input type="submit" name="connecter" value="Connecter" class="button3"><br/><br/>
                    <a href="pageconnexionadmin.php"> -> Connexion administrateur</a>
               <!-- </form> -->

                <?php
                    if (isset($erreur)) echo '<br />',$erreur;
                ?>
            </form>
        </div>

        <?php include("footermembre.php"); ?>

    </body>
</html>