<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion</title>

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


        <form action="page2.php" method="post">
			<div class="connexion2">
				Identifiant <br>
				<input type="text" name="username" placeholder="Identifiant"/><br><br>
			</div>
			<div class="connexion2">
				Mot de passe <br>
            	<input type="password" name="mot_de_passe" placeholder="Mot de passe"/><br><br>
            </div>
            <div class="connexion2">
           		<input type="submit" value="Valider" /><br><br>
           	</div> 
        </form>	



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