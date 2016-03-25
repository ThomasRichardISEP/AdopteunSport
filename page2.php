<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Page 2</title>

        <!-- Feuilles de style -->
        <link href='assets/css/styleheaderfooter.css' rel='stylesheet' type='text/css' />
        <link href='assets/css/style.css' rel='stylesheet' type='text/css' />
    </head>

    <body>

        <header>
            <div class="container">
                <div class="connexion"><a href="accueil.php"><img class="logosite" src="adopteunsport.png" /></a></div>
            </div>
        </header>
    
        <?php
    if (isset($_POST['username']) AND isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] ==  "thomas") // Si le mot de passe est bon
    {
    // On affiche les codes
    ?>
        <h1>Bienvenue sur le site :</h1>
        <p><strong>Vous êtes à présent connecté!</strong></p>   
        
        <p>
        Cette page est réservée au personnel de la NASA. N'oubliez pas de la visiter régulièrement car les codes d'accès sont changés toutes les semaines.<br />
        Merci pour votre visite.
        </p>
        <?php
    }
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Mot de passe incorrect</p>';
        ?><a href="accueil.php">Retour à la page d'accueil</a><br>
        <a href="https://www.google.fr">Retour sur Google!</a>
        <?php
    }
    ?>
    
        
    </body>
</html>