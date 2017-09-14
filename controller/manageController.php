<?php

include_once $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
// CONNECTION A LA DATABASE
$database = new database();
$execDatabase = $database->connectDb();

// ON EXECUTE GETGROUPLIST POUR RECUPERER LE NOM ET L'ID DES GROUPES
$group = new usrGroup($execDatabase);
$groupList = $group->getGroupList();

$user = new users($execDatabase);
// FILTRER LES UTILISATEURS PAR GROUPE
// J'utilise le $_GET pour passer le groupsId en paramètre de l'URL
if (isset($_GET['groupsId']) && $_GET['groupsId'] >= 1) {
    $user->groupsId = $_GET['groupsId'];
    $userList = $user->getUserListByGroup();
    $groupsId = $_GET['groupsId'];
} 
else {
    $userList = $user->getUserList();
    $groupsId = 0;
}

// CHANGEMENT DE LA VALEUR ENABLE SI L'UTILISATEUR EST DANS LE GROUPE ID 2/3/4
$changeEnable = $user->changeEnable();

// CALCUL DE L'AGE
// Fonction permettant de calculer l'age d'une personne
function dateDifference($date_1, $date_2, $differenceFormat = '%Y') {
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);
}

    // Récupération de la date du jour au format anglais
$now = date('Y-m-d');
// Parcours du tableau pour sélectionner les dates de naissances
foreach ($userList as $key => $userDetail) {
    // Ajout à chaque ligne de l'index age sur lequel on calcul l'age
    $userList[$key]['age'] = dateDifference($userDetail['birthDate'], $now);
    // Passer la date du format YYYY/mm/jj à jj/mm/YYYY
    $userList[$key]['birthDate'] = date_format(DateTime::createFromFormat('Y-m-d', ($userDetail['birthDate'])), 'd/m/Y');
}
