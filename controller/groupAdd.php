<?php

//Création de l'instance de l'objet service
$pdo = new database();
$connectPdo = $pdo->connectdb();
$usrGroup = new usrGroup($connectPdo);
$nameRecov = '';
$enableRecov = 0;
$id = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usrGroup->id = $id;
    $groupRecov = $usrGroup->selectGroup();
    $nameRecov = $usrGroup->name;
}

//Appel de la méthode getGroupList de la classe groupe.
//La fonction retourne un tableau que l'on met dans $groupList
$nameError = false;
$name = '';


//Vérification que le bouton a été appuyé
//Vérification des $groupAddinformations sont correctes
if (count($_POST) > 0) {
    if (empty($_POST['name'])) {
        $nameError = true;
    } else {
        $name = htmlspecialchars($_POST['name']);
    }
    if (isset($_POST['selectGroup'])) {
        $usrGroup->id = $_POST['idGroup'];
        $usrGroup->name = $_POST['name'];
        $usrGroup->enable = $_POST['enable'];
        $usrGroup->selectGroup();
    }

    //Vérifier que la fonction addGroup existe, et que le name est rempli
    //Stockage de l'id et du nom
    //Vérification que le enable existe et que la checkbox a été cocher.
    if (isset($_POST['addGroup']) && !empty($_POST['name'])) {
        $usrGroup->id = $id;
        $usrGroup->name = $_POST['name'];
        if (isset($_POST['enable']) && $_POST['enable'] == 1) {
            $usrGroup->enable = $_POST['enable'];
        } else {
            $usrGroup->enable = 0;
        }
        $usrGroup->addGroup();
        header('location: manageGroup.php');
    }

    //Vérifier que la fonction addGroup existe, et que le name est rempli
    //Stockage des nouvelles informations stockés dans le nom
    //Vérification que le enable existe et que la checkbox a été cocher.
    if (isset($_POST['changeGroup']) && !empty($_POST['name'])) {
        $usrGroup->id = $_POST['idGroup'];
        $usrGroup->name = $_POST['name'];
        if (isset($_POST['enable']) && $_POST['enable'] == 1) {
            $usrGroup->enable = $_POST['enable'];
        } else {
            $usrGroup->enable = 0;
        }
        $usrGroup->changeGroup();
        header('location: manageGroup.php');
    }
}
?>