<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=app_info;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion de la question/réponse à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO faq (Question, Reponse) VALUES(?, ?)');
$req->execute(array($_POST['Question'], $_POST['Reponse']));

header('Location: faqadmin.php');
?>