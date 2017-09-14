<?php

include_once $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
// CONNECTION A LA DATABASE
$database = new database();
$execDatabase = $database->connectDb();

$user = new users($execDatabase);

// RECUPÈRE L'ID DE LA SESSION ET EXECUTE LA METHODE SELECTUSER
$user->id = $_SESSION['usrId'];
$user->selectUser();
$birthDate = date_format(DateTime::createFromFormat('Y-m-d', $user->birthDate), 'd/m/Y');




