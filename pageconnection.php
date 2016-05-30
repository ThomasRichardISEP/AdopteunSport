<?php
        // on teste si le visiteur a soumis le formulaire de connexion
        if (isset($_POST['connecter']) && $_POST['connecter'] == 'Connecter') {
            if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {

            try
            {
                $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }

            // on teste si une entrée de la base contient ce couple login / pass
            $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$_POST['login'].'" AND mdp="'.md5($_POST['pass']).'"';
            $req = $base->query($sql);
            $data = $req->fetch();

            //mysql_free_result($req);
            $req->closeCursor();

            // si on obtient une réponse, alors l'utilisateur est un membre
            if ($data[0] == 1) {
                session_start();

                $sql1 = 'SELECT Nom, mdp, Prenom, Photo, Date_naissance, Mail, Adresse, Ville, Administrateur FROM membre_inscrit WHERE Pseudo="'.$_POST['login'].'"';
                $req1 = $base->query($sql1);
                $data1 = $req1->fetch();

                $_SESSION['Pseudo'] = $_POST['login'];
                $_SESSION['Mdp'] = $data1['mdp'];
                $_SESSION['Nom'] = $data1['Nom'];
                $_SESSION['Prenom'] = $data1['Prenom'];
                $_SESSION['Photo'] = $data1['Photo'];
                $_SESSION['Date_naissance'] = $data1['Date_naissance'];
                $_SESSION['Mail'] = $data1['Mail'];
                $_SESSION['Adresse'] = $data1['Adresse'];
                $_SESSION['Ville'] = $data1['Ville'];
                    if ($data1['Administrateur'] == 0){
                        header('Location: membre.php');
                    }
                    else if ($data1['Administrateur'] == 1){
                        header('Location: administrateur.php');
                    }
                exit();
            }
            // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
            elseif ($data[0] == 0) {
                $erreur = 'Compte non reconnu : identifiant et/ou mot de passe incorrect.';
            }
            // sinon, alors la, il y a un gros problème :)
            else {
                $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
            }
            }
            else {
            $erreur = 'Attention : Au moins un des champs est vide.';
            }
        }
        ?>

        
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
                <!--<form action="index.php" method="post">-->
                    <div class="partie colonnegauche">
                        Pseudo :</br>
                        Mot de passe : 
                    </div>
                    <div class="partie colonnedroite">
                        <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
                        <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
                    </div>
                    <input type="submit" name="connecter" value="Connecter" class="button3"><br/><br/>
                    <a href="pageconnexionadmin.php"> -> Connexion administrateur</a>
               <!-- </form> -->

                <?php
                    if (isset($erreur)) echo '<br />',$erreur;
                ?>
            </form>
        </div>



    	<footer>
            <div class="company bas">
                <h3>Company</h3>
                <a href="groupe6c.php" class="lienfootercompany">A propos de nous</a>
                <a href="cgu.php" class="lienfootercompany">CGU</a><br/>
                <a href="accueilen.php" class="lienfootercompany">English version</a>
            </div>

            <div class="espace bas">
            </div>

            <div class="contact bas">
                <h3>Contact</h3>
                <a href="https://www.google.fr" class="rsociaux mail"></a>
                <a href="https://www.facebook.com" class="rsociaux fb"></a>
                <a href="https://www.google.fr" class="rsociaux twitter"></a>
                <a href="https://www.google.fr" class="rsociaux linkedin"></a>
            </div>

            <div class="espace bas">
            </div>

            <div class="adresse bas">
                <h3>Adresse</h3>
                <p>28 Rue Notre-Dame des Champs, Paris 75006.</p>
            </div>
        </footer>

    </body>
</html>