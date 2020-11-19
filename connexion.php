<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link " href="index.php">Le Bon Barquette</a>
        </li>
    </ul>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <label for="">Login : </label>
            <input type="text" name="login" id="login" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="">Mot de passe :</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
        <a class="btn btn-dark"   role="button">Ajouter un repas</a>
        </div>
        
    </div>
</body>
</html>

<?php 
include('Utilisateur.php');
$db = new PDO("mysql:host=127.0.0.1;dbname=bonbarquette", "root", "");


//  Récupération de l'utilisateur et de son pass hashé
$req = $db->prepare('SELECT id,password FROM utilisateur WHERE login = "bob"');
$req->execute(array(
    'login' => $login));
$resultat = $req->fetch();

var_dump($req);

// Comparaison du pass envoyé via le formulaire avec la base
$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['login'] = $login;
        echo 'Vous êtes connecté !';
    }
    else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}