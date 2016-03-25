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
                <div class="connexion"><a href="accueil.php"><img class="logosite" src="Images/adopteunsportnb.png" /></a></div>
            </div>
        </header>

        <div class="formulaire">
        <div class="coordonnees">
        	<lable for="prénom">Prénom :</label><br><br>
			<lable for="nom">Nom :</label><br><br>
			<lable for="username">Identifiant :</label><br><br>
            <lable for="mot_de_passe">Mot de pase :</label><br><br>
            <lable for="ville">Ville :</label><br><br>
            <lable for="age">Âge :</label><br><br>
            
        </div>

        <div class="barretexte">
            <input type="text" id="prenom" placeholder="Ex: Thomas"/><br><br>
            <input type="text" id="nom" placeholder="Ex: Richard"/><br><br>
            <input type="text" id="username" placeholder="Ex: Thomasrichard"/><br><br>
            <input type="text" id="mot_de_passe" placeholder="Mot de passe"/><br><br>
            <input type="text" id="ville" placeholder="Ex: Paris"/><br><br>
            <select id="age"></select><br><br>
        </div>
        </div>

        <footer>
            <div class="company bas">
                <h3>Company</h3>
                <a href="https://www.google.fr" class="lienfootercompany">A propos de nous</a>
                <a href="cgu.php" class="lienfootercompany">CGU</a>
            </div>

            <div class="espace bas">
            </div>

            <div class="contact bas">
                <h3>Contact</h3>
                <a href="https://www.google.fr" class="lienfootercontact">Google</a>
                <a href="https://www.facebook.com/Adopte-Un-Sport-1536807743279320/" class="lienfootercontact">Facebook</a>
                <a href="https://www.google.fr" class="lienfootercontact">Twitter</a>
                <a href="https://www.google.fr" class="lienfootercontact">Linked In</a>
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