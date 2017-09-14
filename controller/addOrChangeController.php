<?php

include_once $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
// CONNECTION A LA DATABASE
$database = new database();
$execDatabase = $database->connectDb();

$group = new usrGroup($execDatabase);
$groupList = $group->getGroupList();

$user = new users($execDatabase);

$loginError = false;
$passwordError = false;
$emailError = false;
$lastNameError = false;
$firstNameError = false;
$birthDateError = false;
$phoneError = false;
$groupsIdError = false;
$avatarError = false;

$id = '';
$login = '';
$password = '';
$email = '';
$lastName = '';
$firstName = '';
$birthDate = '01/01/1990';
$phone = '';
$groupsId = 0;
$avatar = '';

// MODIFIER UN UTILISATEUR
if (isset($_GET['id'])) {
    // On récupère son ID et on l'a passe à l'URL
    $id = $_GET['id'];
    $user->id = $_GET['id'];
    $user->selectUser();
    $login = $user->login;
    $email = $user->email;
    $lastName = $user->lastName;
    $firstName = $user->firstName;
    $birthDate = date_format(DateTime::createFromFormat('Y-m-d', $user->birthDate), 'd/m/Y');
    $phone = $user->phone;
    $groupsId = $user->groupsId;
    $avatar = $user->avatar;
}

// AJOUTER UN UTILISATEUR
// On vérifie qu'on appuit sur le boutton 
if (count($_POST) > 0) {
// S'il le login est présent
    if (!empty($_POST['login'])) {
// On recupère sa valeur
        $user->login = $_POST['login'];
// Sinon la variable d'erreur devient vrai
    } else {
        $loginError = true;
    }
// Si le password est rentré
    if (!empty($_POST['password'])) {
// Alors on récupère sa valeur
        $user->password = $_POST['password'];
// Sinon la variable d'erreur devient vrai
    } else {
        $passwordError = true;
    }
// Si l'email est remplis
    if (!empty($_POST['email'])) {
        $user->email = $_POST['email'];
    } else {
        $emailError = true;
    }
// Si le nom est remplis et qu'il content azAZ-
    if (!empty($_POST['lastName']) && (preg_match('/[a-z -]+/i', $_POST['lastName']))) {
        $user->lastName = $_POST['lastName'];
    } else {
        $lastNameError = true;
    }
// Si le prénom est remplis et qu'il contient azAZ-
    if (!empty($_POST['firstName']) && (preg_match('/[a-z -]+/i', $_POST['firstName']))) {
        $user->firstName = $_POST['firstName'];
    } else {
        $firstNameError = true;
    }
// Si la date est remplis et au format dd/mm/aaaa
    if (!empty($_POST['birthDate'])) {
        $date = DateTime::createFromFormat('d/m/Y', $_POST['birthDate']);
        $user->birthDate = $date->format('Y-m-d');
    } else {
        $birthDateError = true;
    }
// Si le téléphone est remplis et au format 0? + 8 chiffres
    if (!empty($_POST['phone']) && (preg_match('/0[1-9][0-9]{8}/', $_POST['phone']))) {
        $user->phone = $_POST['phone'];
    } else {
        $phoneError = true;
    }
// Si groupsId est remplis
    if (!empty($_POST['groupsId'])) {
        $user->groupsId = $_POST['groupsId'];
    } else {
        $groupsIdError = true;
    }
    if (isset($_FILES['avatar'])) {
//Taille du fichier
        $sizeMax = 100000;
        $size = $_FILES['avatar']['size'];
        if ($size > $sizeMax) {
            $error = 'Le fichier est trop gros 1Mo autorisé';
        }
//redirection des photos téléchargées
        $repository = $_SERVER['DOCUMENT_ROOT'] . 'assets/images/';
//extensions autorisées
        $extendOk = array('jpeg', 'jpg', 'png');
//récupération de l'extension du fichier
        $nameFile = $_FILES['avatar']['name'];
        $extend = pathinfo($nameFile, PATHINFO_EXTENSION);
        $renameFile = $repository . $nameFile;
//Si picture à bien été téléchargée
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $renameFile)) {
//vérification des valeurs id E2N_users et picture E2N_candidate
            $user->id = $_POST['id'];
            $user->avatar = $nameFile;
            echo "DL okay";
//contrôle d'extension de la photo
            if (!(in_array($extend, $extendOk))) {
                echo "Le fichier n'est pas un .jpeg, .jpg ou .png";
            }
        }
//echec du téléchargement
        else {
            echo "Le téléchargement a échoué";
        }
    }
// Si l'ensemble des conditions préalablement définies sont remplis
    if (!$loginError && !$passwordError && !$emailError && !$lastNameError && !$firstNameError && !$birthDateError && !$groupsIdError && !$phoneError && isset($_POST['addUser'])) {
// On execute la fonction addUsers();
        $user->addUsers();
        echo 'L\'utilisateur a bien été ajouté';
// Sinon, message d'erreur
    } else {
        echo 'Negatif';
    }
    // Si on appuit sur le bouton 'Modifier un utilisateur'
    if (isset($_POST['changeUser'])) {
        // On exécute updateUser
        $user->id = $_POST['id'];
        $user->login = $_POST['login'];
        $user->password = $_POST['password'];
        $user->email = $_POST['email'];
        $user->lastName = $_POST['lastName'];
        $user->firstName = $_POST['firstName'];
        $date = DateTime::createFromFormat('d/m/Y', $_POST['birthDate']);
        $user->birthDate = $date->format('Y-m-d');
        $user->phone = $_POST['phone'];
        $user->groupsId = $_POST['groupsId'];
        $user->avatar = $nameFile;
        $user->updateUser();
        echo 'L\'utilisateur a bien été modifié';
    } else {
        echo 'pas de modif';
    }
}  
