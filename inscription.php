<?php
// on teste si le visiteur a soumis le formulaire
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription') {
    // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
    if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass'])) && (isset($_POST['pass_confirm']) && !empty($_POST['pass_confirm'])) && (isset($_POST['cgucheckbox'])) ) {
    // on teste les deux mots de passe
    if ($_POST['pass'] != $_POST['pass_confirm']) {
        $erreur = 'Attention : Les 2 mots de passe sont différents.';
    }
    else {

        try
        {
            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        // on recherche si ce login est déjà utilisé par un autre membre
        $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$_POST['login'].'"';
        $req = $base->query($sql);
        $data = $req->fetch();

        if ($data[0] == 0) {
        $sql = 'INSERT INTO membre_inscrit(Pseudo, mdp, Nom, Prenom, Date_naissance, Mail, Adresse, Ville, Photo) VALUES("'.$_POST['login'].'", "'.md5($_POST['pass']).'", "'.$_POST['nom'].'", "'.$_POST['prenom'].'","'.$_POST['naissance'].'", "'.$_POST['mail'].'", "'.$_POST['adresse'].'", "'.$_POST['ville'].'", "'.$_POST['photo'].'")';
        $base->query($sql);

        session_start();
        $_SESSION['Pseudo'] = $_POST['login'];
        $_SESSION['Nom'] = $_POST['nom'];
        $_SESSION['Prenom'] = $_POST['prenom'];
        $_SESSION['Photo'] = $_POST['photo'];
        $_SESSION['Date_naissance'] = $_POST['naissance'];
        $_SESSION['Mail'] = $_POST['mail'];
        $_SESSION['Adresse'] = $_POST['adresse'];
        $_SESSION['Ville'] = $_POST['ville'];
        header('Location: membre.php');
        exit();
        }
        else {
        $erreur = 'Attention : Un membre possède déjà ce login, veuillez en choisir en nouveau.';
        }
    }
    }
    else {
    $erreur = 'Attention : Au moins un des champs indispensables est vide.';
    }
}
?>

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
                <div class="partie colonnegauche">
                    Pseudo :<br/>
                    Mot de passe :<br/>
                    Confirmation du mdp :<br/>
                    Prénom :<br/>
                    Nom :<br/>
                    Mail :<br/>
                    Adresse :<br/>
                    Ville :<br/>
                    Date de naissance :<br/>
                    Photo :<br/>
                </div>

                <div class="partie colonnedroite">
                    <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
                    <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
                    <input type="password" name="pass_confirm" value="<?php if (isset($_POST['pass_confirm'])) echo htmlentities(trim($_POST['pass_confirm'])); ?>"><br />
                    <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>"><br />
                    <input type="text" name="nom" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>"><br />
                    <input type="text" name="mail" value="<?php if (isset($_POST['mail'])) echo htmlentities(trim($_POST['mail'])); ?>"><br />
                    <input type="text" name="adresse" value="<?php if (isset($_POST['adresse'])) echo htmlentities(trim($_POST['adresse'])); ?>"><br />
                    <input type="text" name="ville" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>"><br />
                    <input type="date" name="naissance" value="<?php if (isset($_POST['naissance'])) echo htmlentities(trim($_POST['naissance'])); ?>"><br />
                    <input type="text" name="photo" value="<?php if (isset($_POST['photo'])) echo htmlentities(trim($_POST['photo'])); ?>"><br />
                </div>
            
                Acceptez-vous les <a href="cgu.php" class="liencgu">CGU</a>? <input type="checkbox" name="cgucheckbox" value="cgucheckbox"><br />
                <input type="submit" name="inscription" value="Inscription" class="button2">
            </form>
            <?php
                if (isset($erreur)) echo '<br />',$erreur;
            ?>
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