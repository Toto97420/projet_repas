<?php
session_start();  // démarrage d'une session

// on vérifie que les données du formulaire sont présentes
if (isset($_POST['login']) && isset($_POST['password'])) {
    $db = new PDO("mysql:host=127.0.0.1;dbname=expernetbdd", "root", "");
    
    // cette requête permet de récupérer l'utilisateur depuis la BD
    $requete = "SELECT * FROM utilisateur WHERE login=? AND Password=?";
    $resultat = $db->prepare($requete);
    $login = $_POST['login'];
    $password = $_POST['password'];
    $resultat->execute(array($login, $password));
    if ($resultat->rowCount() == 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
    }
}
?>