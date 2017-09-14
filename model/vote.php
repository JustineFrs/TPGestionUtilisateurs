<?php

class usrVote {

    /**
     * @var pdo objet de connexion à la base de donnée
     * @var  int id d'un utilisateur
     */
    private $pdo;
    private $userId;

    /**
     * @param objet PDO $pdo instance de connexion à la base de donnée
     * @param int id de l'utilisateur connecté
     */
    public function __construct($pdo, $userId) {
        $this->pdo = $pdo;
        $this->userId = $userId;
    }

    /**
     * // AJOUTE UN VOTE A LA BDD
     * @param int $candidate_Id id d'un candidat
     * @param str $vote ('oui','non','en attente');
     * @param int $refusalReason_id id d'une raison de refus
     * @return bool succes de l'insertion d'un vote
     */
    public function addVote($candidate_Id, $vote, $refusalReason_id) {
        $sendVote = $this->pdo->prepare('INSERT INTO E2N_votes (`userId`,`candidate_Id`,`vote`,`refusalReason_id`) VALUES (:userId,:candidate_Id,:vote,:refusalReason_id)');
        $sendVote->bindValue('userId', $this->userId, PDO::PARAM_INT);
        $sendVote->bindValue('candidate_Id', $candidate_Id, PDO::PARAM_INT);
        $sendVote->bindValue('vote', $vote, PDO::PARAM_INT);
        $sendVote->bindValue('refusalReason_id', $refusalReason_id, PDO::PARAM_INT);
        return $sendVote->execute();
    }

    /**
     * // MODIFIER LE VOTE POUR UN CANDIDAT
     * @param int id du candidat
     * @param str choix du vote de l'utilisateur
     * @param int id d'une raison de refus
     * @return bool succes de l'update du vote
     */
    public function updateVote($candidate_Id, $vote, $refusalReason_id) {
        $updVote = $this->pdo->prepare(' UPDATE `E2N_votes` SET `vote`=:vote, `refusalReason_id`=:refusalReason_id WHERE `userId`=:userId AND `candidate_Id`=:candidate_Id');
        $updVote->bindValue('userId', $this->userId, PDO::PARAM_INT);
        $updVote->bindValue('candidate_Id', $candidate_Id, PDO::PARAM_INT);
        $updVote->bindValue('vote', $vote, PDO::PARAM_BOOL);
        $updVote->bindValue('refusalReason_id', $refusalReason_id, PDO::PARAM_BOOL);
        return $updVote->execute();
    }

    /**
     * AFFICHE LE VOTE ENVOYE PAR L'USER POUR UN CANDIDAT
     * @param int id d'un candidat
     * @return array donnée du vote d'un candidat
     */
    public function getVoteByUser($candidateId) {
        $getVote = $this->pdo->prepare('SELECT * FROM E2N_votes INNER JOIN  E2N_candidate ON E2N_candidate.id = E2N_votes.candidate_id WHERE candidate_Id = :candidateId AND userId = :usersId');
        $getVote->bindValue('usersId', $this->userId, PDO::PARAM_INT);
        $getVote->bindValue('candidateId', $candidateId, PDO::PARAM_INT);
        $getVote->execute();
        return $getVote->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * SELECTIONNE LES RESULTATS DES VOTES POUR UN CANDIDAT
     * @param int $candidateId,
     * @return array liste des votes pour un candidat
     */
    public function getVoteByCandidate($candidateId) {
        $getVote = $this->pdo->prepare('SELECT login,vote,name FROM `E2N_votes` INNER JOIN `E2N_users` ON `E2N_votes`.`userId` = `E2N_users`.`id` INNER JOIN `E2N_refusalReason` ON `E2N_votes`.`refusalReason_id` = `E2N_refusalReason`.`id`   WHERE `candidate_Id` = :candidateId');
        $getVote->bindValue('candidateId', $candidateId, PDO::PARAM_INT);
        $getVote->execute();
        return $getVote->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>


