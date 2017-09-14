<?php

class usrGroup {

    public $id;
    public $name = '';
    public $enable = 0;
    private $pdo;

    /**
     * CREATION DU CONSTRUCTEUR.
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * AFFICHER LA LISTE DES GROUPES
     * @return array le tableau des groupes.
     */
    public function getGroupList() {
        $req = $this->pdo->query('SELECT * FROM `E2N_groups`');
        $request = $req->fetchAll(PDO::FETCH_ASSOC);
        return $request;
    }

    /**
     * FONCTION POUR INSERER UN GROUPE
     * @return array la liste des groupes
     */
    public function addGroup() {
        $queryResult = $this->pdo->prepare('INSERT INTO `E2N_groups`(`name`, `enable`) VALUES(:name, :enable)');
        $queryResult->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryResult->bindValue(':enable', $this->enable, PDO::PARAM_STR);
        $queryResult->execute();
        return $queryResult;
    }

    /**
     * FONCTION POUR MODIFIER GROUP.
     * @return array la liste des groupes.
     */
    public function changeGroup() {
        $queryResult = $this->pdo->prepare('UPDATE `E2N_groups` SET `name` = :name, `enable`=:enable WHERE id = :id');
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryResult->bindValue(':enable', $this->enable, PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult;
    }

    /**
     * FONCTION POUR FAIRE APPARAITRE LE NOM DU GROUP pour le modifier
     */
    public function selectGroup() {
        $queryResult = $this->pdo->prepare('SELECT `name`, `enable` FROM `E2N_groups` WHERE id = :id');
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $request = $queryResult->fetch(PDO::FETCH_ASSOC);
        if (is_array($request)) {
            $this->name = $request['name'];
            $this->enable = $request['enable'];
            return true;
        } else {
            return false;
        }
    }
}
?>
