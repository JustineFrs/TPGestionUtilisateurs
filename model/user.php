<?php

class users {

    /**
     * CLASSE UTILISATEUR
     */
    public $id = 0;
    public $login = '';
    public $password = '';
    public $email = '';
    public $lastName = '';
    public $firstName = '';
    public $birthDate = '1970-01-01';
    public $phone = '';
    public $enable = 0;
    public $groupsId = 0;
    public $avatar = '';
    private $pdo;

    /**
     * CREATION DU CONSTRUCTEUR
     */
    public function __construct($pdo, $id = 0) {
        $this->pdo = $pdo;
        $this->id = $id;
    }

    /**
     * AFFICHER LA LISTE DES UTILISATEURS
     * @return array
     */
    public function getUserList() {
        $req = $this->pdo->query ('SELECT `E2N_users`.*, `E2N_groups`.`name` AS `groupsName`
                                    FROM `E2N_users` 
                                    LEFT JOIN `E2N_groups` 
                                    ON `E2N_groups`.`id` = `E2N_users`.`groupsId`');
        $request = $req->fetchAll();
        return $request;
    }
    
    /**
     * AFFICHER LA LISTE DES UTILISATEURS PAR GROUPE
     * @param int $groupsId E2N_users
     * @return array
     */
    public function getUserListByGroup() {
        $listByGroup = $this->pdo->prepare('SELECT `E2N_users`.*, `E2N_groups`.`name` AS `groupsName`
                                            FROM `E2N_users` 
                                            LEFT JOIN `E2N_groups`
                                            ON `E2N_groups`.`id` = `E2N_users`.`groupsId`
                                            WHERE `E2N_groups`.`id` = :groupsId');
        $listByGroup->bindValue(':groupsId', $this->groupsId, PDO::PARAM_INT);
        if ($listByGroup->execute()) {
            return $listByGroup->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $listByGroupEmpty = array();
            return $listByGroupEmpty;
        }
    }

    /**
     * MODIFIER UN UTILISATEUR
     * @param int $id E2N_users
     * @return boolean
     */
    public function updateUser() {
        $updGroup = $this->pdo->prepare('UPDATE `E2N_users` SET `login` = :login, `password` = :password, `email` = :email, `lastName` = :lastName, `firstName` = :firstName, `birthDate` = :birthDate, `phone` = :phone, `groupsId` = :groupsId, `avatar` = :avatar WHERE `id` = :id');
        $updGroup->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updGroup->bindValue(':login', $this->login, PDO::PARAM_STR);
        $updGroup->bindValue(':password',  md5($this->password), PDO::PARAM_STR);
        $updGroup->bindValue(':email', $this->email, PDO::PARAM_STR);
        $updGroup->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $updGroup->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $updGroup->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $updGroup->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $updGroup->bindValue(':groupsId', $this->groupsId, PDO::PARAM_INT);
        $updGroup->bindValue(':avatar', $this->avatar, PDO::PARAM_STR);
        return $updGroup->execute();
    }

    /**
     * MODIFIER LE ENABLE SI L'UTILISATEUR A UN GROUPID = 1,2 OU 3
     * @return boolean
     */
    public function changeEnable() {
        $changeEnable = $this->pdo->query('UPDATE `E2N_users` SET `enable` = 1 WHERE `groupsId` IN (1,2,3)');
        return $changeEnable->execute();
    }

    /**
     * AUTORISER LA CONNEXION A UN UTILISATEUR
     * @param str $login E2N_users
     * @param str $password E2N_users
     * @return boolean
     */
    public function allowToConnect() {
        $connect = $this->pdo->prepare('SELECT * FROM `E2N_users` WHERE `login` = :login AND `password` = :password AND `enable` = 1;');
        $connect->bindValue(':login', $this->login, PDO::PARAM_STR);
        $connect->bindValue(':password', md5($this->password), PDO::PARAM_STR);
        $connect->execute();
        return $connect->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * AJOUTER UN UTILISATEUR
     * @return array
     */
    public function addUsers() {
        $request = $this->pdo->prepare('INSERT INTO `E2N_users` (`login`, `password`, `email`, `lastName`, `firstName`, `birthDate`, `phone`, `groupsId`, `avatar`) VALUES (:login, :password, :email, :lastName, :firstName, :birthDate, :phone, :groupsId, :avatar)');
        $request->bindValue(':login', $this->login, PDO::PARAM_STR);
        $request->bindValue(':password',  md5($this->password), PDO::PARAM_STR);
        $request->bindValue(':email', $this->email, PDO::PARAM_STR);
        $request->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $request->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $request->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $request->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $request->bindValue(':groupsId', $this->groupsId, PDO::PARAM_STR);
        $request->bindValue(':avatar', $this->avatar, PDO::PARAM_STR);
        $request->execute();
        return $request;
    }

    /**
     * SELECTIONNER UN UTILISATEUR
     * @return boolean
     */
    public function selectUser() {
        $req = $this->pdo->prepare('SELECT * FROM `E2N_users` WHERE `id` = :id');
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if (is_array($result)) {
            $this->login = $result['login'];
            $this->password = md5($result['password']);
            $this->email = $result['email'];
            $this->lastName = $result['lastName'];
            $this->firstName = $result['firstName'];
            $this->birthDate = $result['birthDate'];
            $this->phone = $result['phone'];
            $this->enable = $result['enable'];
            $this->groupsId = $result['groupsId'];
            $this->avatar = $result['avatar'];
            return true;
        } else {
            return false;
        }
    }

}
