<?php

class candidate {

    private $pdo;
    public $picture;
    public $id;
    public $genre;
    public $qpv;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * AFFICHAGE DES INFOS CANDIDATS
     * @return boolean
     */
    public function getCandidate() {
        $get = $this->pdo->query('SELECT * FROM `E2N_candidate`');
        $getCandidate = $get->fetchAll(PDO::FETCH_ASSOC);
        return $getCandidate;
    }

    /**
     * INSERTION PHOTO CANDIDATS
     * @param $id E2N_users, $picture E2N_candidate
     * @return boolean 
     */
    public function upDateCandidate() {
        $upD = $this->pdo->prepare('UPDATE `E2N_candidate` SET `picture` = :picture WHERE `id` = :id');
        $upD->bindValue(':id', $this->id, PDO::PARAM_INT);
        $upD->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        return $upD->execute();
    }

    /**
     * INSERTION GENRE CANDIDATS
     * @param $id E2N_users, $genre E2N_candidate
     * @return boolean
     */
    public function upDateGenre() {
        $upGenre = $this->pdo->prepare('UPDATE `E2N_candidate` SET `genre` = :genre WHERE `id` = :id');
        $upGenre->bindValue(':id', $this->id, PDO::PARAM_INT);
        $upGenre->bindValue(':genre', $this->genre, PDO::PARAM_STR);
        return $upGenre->execute();
    }

    /**
     * INSERTION QPV CANDIDATS
     * @param $id E2N_users, $qpv E2N_candidate
     * @return boolean
     */
    public function upDateQPV() {
        $upGenre = $this->pdo->prepare('UPDATE `E2N_candidate` SET `qpv` = :qpv WHERE `id` = :id');
        $upGenre->bindValue(':id', $this->id, PDO::PARAM_INT);
        $upGenre->bindValue(':qpv', $this->qpv, PDO::PARAM_STR);
        return $upGenre->execute();
    }

    /**
     * RECHERCHE TERMES CANDIDATS
     * @return boolean
     */
    public function getCandidateBySearchBar($paramBar) {
        $getByBar = $this->pdo->prepare('SELECT `E2N_candidate`.*, `E2N_users`.*, `E2N_codecademy`.`badge`, 
                                        `E2N_englishLevel`.`name` AS `englishLevelName`, `E2N_grade`.`name` AS `gradeName`
                                        FROM `E2N_candidate` 
                                        LEFT JOIN `E2N_users` ON `E2N_candidate`.`id` = `E2N_users`.`id` 
                                        LEFT JOIN `E2N_codecademy` ON `E2N_candidate`.`codecademyId` = `E2N_codecademy`.`id` 
                                        LEFT JOIN `E2N_englishLevel` ON `E2N_candidate`.`englishLevelId` = `E2N_englishLevel`.`id` 
                                        LEFT JOIN `E2N_grade` ON `E2N_candidate`.`gradeId` = `E2N_grade`.`id` 
                                        WHERE `firstName` LIKE :word OR `lastName` LIKE :word OR `hacks` LIKE :word OR `superHero` LIKE :word');
        $getByBar->bindValue(':word', '%' . $paramBar . '%', PDO::PARAM_STR);
        $getByBar->execute();
        $getBySearchBar = $getByBar->fetchAll(PDO::FETCH_ASSOC);
        return $getBySearchBar;
    }

    /**
     * JOINTURE DES TABLES E2N_candidate - E2N_users - E2N_codecademy - E2N_gradeId - E2N_englishLevel
     * @return boolean
     */
    public function joinCandidateByUsers() {
        $joinUsers = $this->pdo->query('SELECT `E2N_candidate`.*, `E2N_users`.*, `E2N_codecademy`.`badge`, 
                                        `E2N_englishLevel`.`name` AS `englishLevelName`, `E2N_grade`.`name` AS `gradeName`
                                        FROM `E2N_candidate` 
                                        LEFT JOIN `E2N_users` ON `E2N_candidate`.`id` = `E2N_users`.`id` 
                                        LEFT JOIN `E2N_codecademy` ON `E2N_candidate`.`codecademyId` = `E2N_codecademy`.`id` 
                                        LEFT JOIN `E2N_englishLevel` ON `E2N_candidate`.`englishLevelId` = `E2N_englishLevel`.`id` 
                                        LEFT JOIN `E2N_grade` ON `E2N_candidate`.`gradeId` = `E2N_grade`.`id` ');
        $usersCandidate = $joinUsers->fetchAll(PDO::FETCH_ASSOC);
        return $usersCandidate;
    }

    /**
     * ODERBY ASC JOIN E2N_candidate - E2N_users
     * @return boolean 
     */
    public function orderByAZ() {
        $orderAsc = $this->pdo->query('SELECT `E2N_candidate`.*, `E2N_users`.*, `E2N_codecademy`.`badge`, 
                                       `E2N_englishLevel`.`name` AS `englishLevelName`, `E2N_grade`.`name` AS `gradeName`
                                       FROM `E2N_candidate` 
                                       LEFT JOIN `E2N_users` ON `E2N_candidate`.`id` = `E2N_users`.`id` 
                                       LEFT JOIN `E2N_codecademy` ON `E2N_candidate`.`codecademyId` = `E2N_codecademy`.`id` 
                                       LEFT JOIN `E2N_englishLevel` ON `E2N_candidate`.`englishLevelId` = `E2N_englishLevel`.`id` 
                                       LEFT JOIN `E2N_grade` ON `E2N_candidate`.`gradeId` = `E2N_grade`.`id` 
                                       ORDER BY `lastName` ASC');
        $orderByAsc = $orderAsc->fetchAll(PDO::FETCH_ASSOC);
        return $orderByAsc;
    }

    /**
     * ODERBY DESC
     * @return boolean JOIN E2N_candidate - E2N_users
     */
    public function orderByZA() {
        $orderDesc = $this->pdo->query('SELECT `E2N_candidate`.*, `E2N_users`.*, `E2N_codecademy`.`badge`, 
                                        `E2N_englishLevel`.`name` AS `englishLevelName`, `E2N_grade`.`name` AS `gradeName`
                                        FROM `E2N_candidate` 
                                        LEFT JOIN `E2N_users` ON `E2N_candidate`.`id` = `E2N_users`.`id` 
                                        LEFT JOIN `E2N_codecademy` ON `E2N_candidate`.`codecademyId` = `E2N_codecademy`.`id` 
                                        LEFT JOIN `E2N_englishLevel` ON `E2N_candidate`.`englishLevelId` = `E2N_englishLevel`.`id` 
                                        LEFT JOIN `E2N_grade` ON `E2N_candidate`.`gradeId` = `E2N_grade`.`id` 
                                        ORDER BY `lastName` DESC');
        $orderByDesc = $orderDesc->fetchAll(PDO::FETCH_ASSOC);
        return $orderByDesc;
    }

    /**
     * ODERBY Nombre de badges Codecademy
     * @return boolean JOIN E2N_candidate - E2N_codecademy
     */
    public function orderByLessBadge() {
        $orderLess = $this->pdo->query('SELECT `E2N_candidate`.*, `E2N_users`.*, `E2N_codecademy`.`badge`, 
                                        `E2N_englishLevel`.`name` AS `englishLevelName`, `E2N_grade`.`name` AS `gradeName`
                                        FROM `E2N_candidate` 
                                        LEFT JOIN `E2N_users` ON `E2N_candidate`.`id` = `E2N_users`.`id` 
                                        LEFT JOIN `E2N_codecademy` ON `E2N_candidate`.`codecademyId` = `E2N_codecademy`.`id` 
                                        LEFT JOIN `E2N_englishLevel` ON `E2N_candidate`.`englishLevelId` = `E2N_englishLevel`.`id` 
                                        LEFT JOIN `E2N_grade` ON `E2N_candidate`.`gradeId` = `E2N_grade`.`id` 
                                        WHERE `badge` <= 24 ');
        $orderByLessBadge = $orderLess->fetchAll(PDO::FETCH_ASSOC);
        return $orderByLessBadge;
    }

    /**
     * ODERBY Nombre de badges Codecademy
     * @return boolean JOIN E2N_candidate - E2N_codecademy
     */
    public function orderByMoreBadge() {
        $orderMore = $this->pdo->query('SELECT `E2N_candidate`.*, `E2N_users`.*, `E2N_codecademy`.`badge`, 
                                        `E2N_englishLevel`.`name` AS `englishLevelName`, `E2N_grade`.`name` AS `gradeName`
                                        FROM `E2N_candidate` 
                                        LEFT JOIN `E2N_users` ON `E2N_candidate`.`id` = `E2N_users`.`id` 
                                        LEFT JOIN `E2N_codecademy` ON `E2N_candidate`.`codecademyId` = `E2N_codecademy`.`id` 
                                        LEFT JOIN `E2N_englishLevel` ON `E2N_candidate`.`englishLevelId` = `E2N_englishLevel`.`id` 
                                        LEFT JOIN `E2N_grade` ON `E2N_candidate`.`gradeId` = `E2N_grade`.`id` 
                                        WHERE `badge` >= 25 ');
        $orderByMoreBadge = $orderMore->fetchAll(PDO::FETCH_ASSOC);
        return $orderByMoreBadge;
    }

}

?>
