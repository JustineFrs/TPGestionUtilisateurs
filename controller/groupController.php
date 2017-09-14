<?php
include_once $_SERVER['DOCUMENT_ROOT'] .'model/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] .'model/group.php';
?>
<?php
//Création de l'instance de l'objet service
$pdo = new database();
$connectPdo = $pdo->connectdb();
$usrGroup = new usrGroup($connectPdo);
//Appel de la méthode getGroupList de la classe groupe.
//La fonction retourne un tableau que l'on met dans $userList
$groupList = $usrGroup->getGroupList($usrGroup);
?>
