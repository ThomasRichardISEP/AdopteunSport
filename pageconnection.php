<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion</title>
        <link href='assets/css/style.css' rel='stylesheet' type='text/css' />
    </head>


    <body>

    	<header>
            <div class="container">
                <div class="connexion"><a href="accueil.php"><img class="logosite" src="adopteunsport.png" /></a></div>
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
			<a href="https://www.google.fr">Google</a>
			<a href="https://www.google.fr">Facebook</a>
			<a href="https://www.google.fr">Twitter</a>
			<a href="https://www.google.fr">Linked In</a>
		</footer>

    </body>
</html>