<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
// CONNECTION A LA DATABASE
$database = new database();
$execDatabase = $database->connectDb();

$user = new users($execDatabase);
// AUTORISER UN UTILISATEUR A SE CONNECTER ET OUVRIR SA SESSION
// On vérifie qu'on entre un login et un mdp
if (isset($_POST['login']) && isset($_POST['password'])) {
    // On récupère les valeurs des POSTS on appel à la requête SQL
    $user->login = $_POST['login']; 
    $user->password = $_POST['password'];
    $connect = $user->allowToConnect();
    if ($connect) {
        // S'il trouve l'utilisateur dans la BDD, Alors on ouvre sa session
        $_SESSION['usrId'] = $connect['id'];
        $_SESSION['usrFirstName'] = $connect['firstName'];
        $_SESSION['usrGroupsId'] = $connect['groupsId'];
    } else {
        // Sinon
        echo 'Votre login/password est incorrect';
    }
}
// DECONNECTE L'UTILISATEUR ET DETRUIT LA SESSION
if (isset($_POST['disconnect'])) {
    $_SESSION = array();
    session_destroy();
}
