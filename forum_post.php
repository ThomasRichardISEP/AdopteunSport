<?php
// Connexion à la base de données
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO messages (Pseudo_membre_inscrit, Contenu, Date_message, Heure_message) VALUES(?, ?, CURDATE(), CURTIME())');
$req->execute(array($_SESSION['Pseudo'], $_POST['Contenu']));

// Redirection du visiteur vers la page du minichat
header('Location: forum.php');
?>