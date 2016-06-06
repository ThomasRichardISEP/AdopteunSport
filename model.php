<?php 

function envoyermsg($prenom1, $nom1, $prenom2, $nom2, $message){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	   	{
	        die('Erreur : '.$e->getMessage());
	    }

	    $sql = 'INSERT INTO messagerie(Prenomauteur, Nomauteur, Prenomdestinataire, Nomdestinataire, Message) VALUES("'.$prenom1.'", "'.$nom1.'", "'.$prenom2.'", "'.$nom2.'","'.$message.'")';
	    $base->query($sql);
}


function supprimerpost($id_msg){
	try
		{
		   	$base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		$reponse = $base->prepare('DELETE FROM messages WHERE Id_message = ? ');
		$reponse->execute(array($id_msg));
		header ('Location: forumadmin.php');	
}


function supprimermembre($titre, $pseudo){
	try
		{
		    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		$reponse = $base->prepare('DELETE FROM appartenance_groupe WHERE Titre_groupe = ? AND Pseudo_membre_inscrit = ? ');
		$reponse->execute(array($titre ,$pseudo));
		header ('Location: membre.php');
}


function supprimerfaq($idquestion){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		$reponse = $base->prepare('DELETE FROM faq WHERE Id = ? ');
		$reponse->execute(array($idquestion));
		header ('Location: faqadmin.php');
}


function updatemembreadmin($login, $prenom, $nom, $mail, $adresse, $ville, $naissance, $photo){
	try
		{
		    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		if (isset($_POST['admincheckbox'])){
		   	$admin = 1;
		}
		else if (!isset($_POST['admincheckbox'])){
		  	$admin = 0;
		}

		$req = $base->prepare('UPDATE membre_inscrit SET Pseudo = ?, Prenom = ?, Nom = ?, Mail = ?, Adresse = ?, Ville = ?, Date_naissance = ?, Photo = ?, Administrateur = ? WHERE Pseudo = ? ');
		$req->execute(array($login, $prenom, $nom, $mail, $adresse, $ville, $naissance, $photo, $admin, $login));

		header ('Location: gestionmembres.php');
}


function supprimermembreadmin($login){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }

	    $reponse = $base->query('DELETE FROM membre_inscrit WHERE Pseudo = "'.$login.'"');
	    header ('Location: gestionmembres.php');
}


function updategroupeadmin($titre, $descriptif, $zonegeo, $nmpers, $photo, $nomsport, $createur, $datecreation){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }

	    $req = $base->prepare('UPDATE groupe SET Titre = ?, Descriptif = ?, Zone_geographique = ?, Nb_max_personnes = ?, Photo = ?, Nom_sport = ?, Pseudo_membre_createur = ?, Date_creation = ? WHERE Titre = ? ');
		$req->execute(array($titre, $descriptif, $zonegeo, $nmpers, $photo, $nomsport, $createur, $datecreation, $titre));

		header ('Location: gestiongroupes.php');
}


function supprimergroupeadmin($titre){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }

	    $reponse = $base->query('DELETE FROM groupe WHERE Titre = "'.$titre.'"');
	    $reponse2 = $base->query('DELETE FROM appartenance_groupe WHERE Titre_groupe = "'.$titre.'"');
	    header ('Location: gestiongroupes.php');
}


function rejoindregroupe($pseudo, $groupe){
	try
		{
		    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		$req = $base->prepare('SELECT count(*) FROM appartenance_groupe WHERE Pseudo_membre_inscrit = ? AND Titre_groupe = ? ');
		$req->execute(array($pseudo, $groupe));
		$data = $req->fetch();

		if ($data[0] == 0) {
			$sql = 'INSERT INTO appartenance_groupe(Pseudo_membre_inscrit, Titre_groupe, Date_inscription) VALUES("'.$pseudo.'", "'.$groupe.'", CURDATE())';
			$base->query($sql);
		}
}


function quittergroupe($pseudo, $groupe){
	try
		{
		    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}

		$req = $base->prepare('DELETE FROM appartenance_groupe WHERE Pseudo_membre_inscrit = ? AND Titre_groupe = ? ');
		$req->execute(array($pseudo, $groupe));
}


function connexionadmin($login, $mdp){
	if ((isset($login) && !empty($login)) && (isset($mdp) && !empty($mdp))) {
	try
            {
                $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }

            // on teste si une entrée de la base contient ce couple login / pass
            $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$login.'" AND mdp="'.md5($mdp).'"';
            $req = $base->query($sql);
            $data = $req->fetch();

            //mysql_free_result($req);
            $req->closeCursor();

            // si on obtient une réponse, alors l'utilisateur est un membre
            if ($data[0] == 1) {
                session_start();

                $sql1 = 'SELECT Nom, Prenom, Photo, Date_naissance, Mail, Adresse, Ville, Administrateur FROM membre_inscrit WHERE Pseudo="'.$login.'"';
                $req1 = $base->query($sql1);
                $data1 = $req1->fetch();

                $_SESSION['Pseudo'] = $login;
                $_SESSION['Nom'] = $data1['Nom'];
                $_SESSION['Prenom'] = $data1['Prenom'];
                $_SESSION['Photo'] = $data1['Photo'];
                $_SESSION['Date_naissance'] = $data1['Date_naissance'];
                $_SESSION['Mail'] = $data1['Mail'];
                $_SESSION['Adresse'] = $data1['Adresse'];
                $_SESSION['Ville'] = $data1['Ville'];
                    if ($data1['Administrateur'] == 0){
                        session_unset();
                        session_destroy();
                        header('Location: pageconnection.php');
                    }
                    else if ($data1['Administrateur'] == 1){
                        header('Location: administrateur.php');
                    }
                exit();
            }
            // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
            elseif ($data[0] == 0) {
                $erreur = 'Compte non reconnu : identifiant et/ou mot de passe incorrect.';
                return $erreur;
            }
            // sinon, alors la, il y a un gros problème :)
            else {
                $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
                return $erreur;
            }
    }
    else {
        $erreur = 'Attention : Au moins un des champs est vide.';
        return $erreur;
    }
}


function connexionmembre($login, $mdp){
	if ((isset($login) && !empty($login)) && (isset($mdp) && !empty($mdp))) {
	try
            {
                $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }

            // on teste si une entrée de la base contient ce couple login / pass
            $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$login.'" AND mdp="'.md5($mdp).'"';
            $req = $base->query($sql);
            $data = $req->fetch();

            //mysql_free_result($req);
            $req->closeCursor();

            // si on obtient une réponse, alors l'utilisateur est un membre
            if ($data[0] == 1) {
                session_start();

                $sql1 = 'SELECT Nom, mdp, Prenom, Photo, Date_naissance, Mail, Adresse, Ville, Administrateur FROM membre_inscrit WHERE Pseudo="'.$login.'"';
                $req1 = $base->query($sql1);
                $data1 = $req1->fetch();

                $_SESSION['Pseudo'] = $login;
                $_SESSION['Mdp'] = $data1['mdp'];
                $_SESSION['Nom'] = $data1['Nom'];
                $_SESSION['Prenom'] = $data1['Prenom'];
                $_SESSION['Photo'] = $data1['Photo'];
                $_SESSION['Date_naissance'] = $data1['Date_naissance'];
                $_SESSION['Mail'] = $data1['Mail'];
                $_SESSION['Adresse'] = $data1['Adresse'];
                $_SESSION['Ville'] = $data1['Ville'];
                header('Location: membre.php');
                    
                exit();
            }
            // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
            elseif ($data[0] == 0) {
                $erreur = 'Compte non reconnu : identifiant et/ou mot de passe incorrect.';
                return $erreur;
            }
            // sinon, alors la, il y a un gros problème :)
            else {
                $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
                return $erreur;
            }
    }
    else {
        $erreur = 'Attention : Au moins un des champs est vide.';
        return $erreur;
    }
}


function modifmembre($login, $oldpass, $pass, $passconfirm, $prenom, $nom, $mail, $adresse, $ville, $naissance, $photo, $pseudo){
	try
		        {
		            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		        }
		        catch(Exception $e)
		        {
		            die('Erreur : '.$e->getMessage());
		        }

		        $req = $base->prepare('UPDATE membre_inscrit SET Pseudo = ?, Prenom = ?, Nom = ?, Mail = ?, Adresse = ?, Ville = ?, Date_naissance = ?, Photo = ? WHERE Pseudo = ? ');
				$req->execute(array($login, $prenom, $nom, $mail, $adresse, $ville, $naissance, $photo, $pseudo));

				$_SESSION['Pseudo'] = $login;
		        $_SESSION['Nom'] = $nom;
		        $_SESSION['Prenom'] = $prenom;
		        $_SESSION['Photo'] = $photo;
		        $_SESSION['Date_naissance'] = $naissance;
		        $_SESSION['Mail'] = $mail;
		        $_SESSION['Adresse'] = $adresse;
		        $_SESSION['Ville'] = $ville;

		        if ((isset($oldpass) && md5($oldpass) == $_SESSION['Mdp']) && (isset($pass) && !empty($pass)) && (isset($passconfirm) && !empty($passconfirm)) ) {
		        	if ($pass == $passconfirm) {

		        		$req = $base->prepare('UPDATE membre_inscrit SET mdp = ? WHERE Pseudo = ? ');
		        		$req->execute(array(md5($pass), $_SESSION['Pseudo']));

		        		$_SESSION['Mdp'] = md5($pass);
		        	}
		        }

		        header ('Location: membre.php');
}


function modifgroupeleader($titre, $descriptif, $zonegeo, $nbpers, $photo, $nomsport, $createur, $datecreation){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }

	    $req = $base->prepare('UPDATE groupe SET Titre = ?, Descriptif = ?, Zone_geographique = ?, Nb_max_personnes = ?, Photo = ?, Nom_sport = ?, Pseudo_membre_createur = ?, Date_creation = ? WHERE Titre= ? ');
		$req->execute(array($titre, $descriptif, $zonegeo, $nbpers, $photo, $nomsport, $createur, $datecreation, $titre));
        header ('Location: membre.php');
}


function supprimergroupeleader($titre){
	try
	    {
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }

	    $reponse = $base->query('DELETE FROM groupe WHERE Titre = "'.$titre.'"');
	    $reponse2 = $base->query('DELETE FROM appartenance_groupe WHERE Titre_groupe = "'.$titre.'"');
		$reponse3 = $base->query('DELETE FROM evenement WHERE Groupe = "'.$titre.'"');
		header ('Location: membre.php');
}


function creerevent($nom, $groupe, $club, $daterdv, $heurerdv){
	if ((isset($nom) && !empty($nom)) && (isset($daterdv) && !empty($daterdv)) && (isset($heurerdv) && !empty($heurerdv)) && (isset($club)  && !empty($club)) ) {

		try
		    {
		        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		    }
		    catch(Exception $e)
		    {
		        die('Erreur : '.$e->getMessage());
		    }

	        $req = $base->prepare('INSERT INTO evenement(Nom_event, Groupe, Club, Date_event, Heure_event) VALUES(?, ?, ?, ?, ?)');
			$req->execute(array($nom, $groupe, $club, $daterdv, $heurerdv));		        
	}
}


function modifevent($nom, $club, $daterdv, $heurerdv){
	try
		{
		    $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		    }

		$req = $base->prepare('UPDATE evenement SET Nom_event = ?, Club = ?, Date_event = ?, Heure_event = ? WHERE Nom_event = ? ');
		$req->execute(array($nom, $club, $daterdv, $heurerdv, $nom));
		header ('Location: membre.php');
}


function supprierevent($nom){
	try
		{
	        $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
	    }
	    catch(Exception $e)
	    {
	        die('Erreur : '.$e->getMessage());
	    }

	    $reponse = $base->query('DELETE FROM evenement WHERE Nom_event = "'.$nom.'"');
	    header ('Location: membre.php');
}


function inscription($login, $mdp, $mdpconfirm, $nom, $prenom, $photo, $naissance, $mail, $adresse, $ville, $cgu){
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
    if ((isset($login) && !empty($login)) && (isset($mdp) && !empty($mdp)) && (isset($mdpconfirm) && !empty($mdpconfirm)) && (isset($cgu)) ) {
    // on teste les deux mots de passe
    if ($mdp != $mdpconfirm) {
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
        $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$login.'"';
        $req = $base->query($sql);
        $data = $req->fetch();

        if ($data[0] == 0) {
        $sql = 'INSERT INTO membre_inscrit(Pseudo, mdp, Nom, Prenom, Date_naissance, Mail, Adresse, Ville, Photo) VALUES("'.$login.'", "'.md5($mdp).'", "'.$nom.'", "'.$prenom.'","'.$naissance.'", "'.$mail.'", "'.$adresse.'", "'.$ville.'", "'.$photo.'")';
        $base->query($sql);

        session_start();
        $_SESSION['Pseudo'] = $login;
        $_SESSION['Mdp'] = md5($mdp);
        $_SESSION['Nom'] = $nom;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Photo'] = $photo;
        $_SESSION['Date_naissance'] = $naissance;
        $_SESSION['Mail'] = $mail;
        $_SESSION['Adresse'] = $adresse;
        $_SESSION['Ville'] = $ville;
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


function creergroupe($nom, $sport, $ville, $descriptif, $nbpers, $photo, $pseudo){
	if ((isset($nom) && !empty($nom)) && (isset($sport) && !empty($sport)) && (isset($ville) && !empty($ville)) && (isset($descriptif)  && !empty($descriptif)) ) {

			        try
			        {
			            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			        }
			        catch(Exception $e)
			        {
			            die('Erreur : '.$e->getMessage());
			        }

			        // on recherche si ce login est déjà utilisé par un autre membre
			        $sql = 'SELECT count(*) FROM groupe WHERE Titre="'.$nom.'"';
			        $req = $base->query($sql);
			        $data = $req->fetch();

			        if ($data[0] == 0) {
			        $sql = 'INSERT INTO groupe(Titre, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Nom_sport, Pseudo_membre_createur, Date_creation) VALUES("'.$nom.'", "'.$descriptif.'", "'.$ville.'", "'.$nbpers.'","'.$photo.'", "'.$sport.'", "'.$pseudo.'", CURDATE())';
			        $base->query($sql);
			        }

			        header('Location: groupes.php');
			        
			    }
}


function ajoutermembreadmin($login, $mdp, $mdpconfirm, $nom, $prenom, $photo, $naissance, $mail, $adresse, $ville, $cgu){
	if ((isset($login) && !empty($login)) && (isset($mdp) && !empty($mdp)) && (isset($mdpconfirm) && !empty($mdpconfirm)) && (isset($cgu)) ) {

    if ($mdp != $mdpconfirm) {
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
        $sql = 'SELECT count(*) FROM membre_inscrit WHERE Pseudo="'.$login.'"';
        $req = $base->query($sql);
        $data = $req->fetch();

        if ($data[0] == 0) {
        $sql = 'INSERT INTO membre_inscrit(Pseudo, mdp, Nom, Prenom, Date_naissance, Mail, Adresse, Ville, Photo) VALUES("'.$login.'", "'.md5($mdp).'", "'.$nom.'", "'.$prenom.'","'.$naissance.'", "'.$mail.'", "'.$adresse.'", "'.$ville.'", "'.$photo.'")';
        $base->query($sql);

        header('Location: gestionmembres.php');
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


function creergroupeadmin($nom, $sport, $ville, $descriptif, $nbpers, $photo, $pseudo){
	if ((isset($nom) && !empty($nom)) && (isset($sport) && !empty($sport)) && (isset($ville) && !empty($ville)) && (isset($descriptif)  && !empty($descriptif)) ) {

			        try
			        {
			            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			        }
			        catch(Exception $e)
			        {
			            die('Erreur : '.$e->getMessage());
			        }

			        // on recherche si ce login est déjà utilisé par un autre membre
			        $sql = 'SELECT count(*) FROM groupe WHERE Titre="'.$nom.'"';
			        $req = $base->query($sql);
			        $data = $req->fetch();

			        if ($data[0] == 0) {
			        $sql = 'INSERT INTO groupe(Titre, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Nom_sport, Pseudo_membre_createur, Date_creation) VALUES("'.$nom.'", "'.$descriptif.'", "'.$ville.'", "'.$nbpers.'","'.$photo.'", "'.$sport.'", "'.$pseudo.'", CURDATE())';
			        $base->query($sql);
			        }

			        header('Location: gestiongroupes.php');
			    }
}


function creerclub($nom, $sport, $ville, $descriptif, $nbpers, $photo, $pseudo){
	if ((isset($nom) && !empty($nom)) && (isset($sport) && !empty($sport)) && (isset($ville) && !empty($ville)) && (isset($descriptif)  && !empty($descriptif)) ) {

			        try
			        {
			            $base = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
			        }
			        catch(Exception $e)
			        {
			            die('Erreur : '.$e->getMessage());
			        }

			        // on recherche si ce login est déjà utilisé par un autre membre
			        $sql = 'SELECT count(*) FROM club WHERE Titre="'.$nom.'"';
			        $req = $base->query($sql);
			        $data = $req->fetch();

			        if ($data[0] == 0) {
			        $sql = 'INSERT INTO club(Titre, Sport, Descriptif, Zone_geographique, Nb_max_personnes, Photo, Pseudo_membre_createur, Date_creation) VALUES("'.$nom.'", "'.$sport.'", "'.$descriptif.'", "'.$ville.'","'.$nbpers.'", "'.$photo.'", "'.$pseudo.'", CURDATE())';
			        $base->query($sql);
			        }

			        header('Location: clubs.php');
			        
			    }
}



?>