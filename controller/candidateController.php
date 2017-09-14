<?php

if (isset($_POST['name'])) {

    include '../model/database.php';
    include '../model/candidate.php';
    //connection a la BDD
    $pdo = new database();
    $db = $pdo->connectDB();
    //création de l'instance de l'objet candidate
    $candidate = new candidate($db);
    //iniatialisation des variables
    $id = 0;
    $value = $_POST['value'];
    $result = false;
    /* Controller d'ajout du genre */
    //suppression du sufixe du name de l'input
    if (preg_match('/genre_/', $_POST['name'])) {
        $id = str_replace('genre_', '', $_POST['name']);
        $candidate->id = $id;
        $candidate->genre = $value;
        //appel de la méthode modifiant le genre
        $result = $candidate->upDateGenre();
    }
    /* Controller d'ajout du qpv */
    //suppression du sufixe du name de l'input
    if (preg_match('/qpv_/', $_POST['name'])) {
        $id = str_replace('qpv_', '', $_POST['name']);
        $candidate->id = $id;
        $candidate->qpv = $value;
        //appel de la méthode modifiant le qpv
        $result = $candidate->upDateQPV();
    }
    echo $result;
} else {
    $pdo = new database();
    $db = $pdo->connectDB();

//création de l'instance de l'objet candidate
    $candidate = new candidate($db);
    
//appel de la méthode getCandidate() de la class candidate
//la fonction retourne un tableau de tous les candidats, que l'on met dans la variable $candidateList
    $candidateList = $candidate->getCandidate();


    /* Controller d'ajout Photo */
    if (count($_POST) > 0) {
        if (isset($_POST['id']) && isset($_FILES['picture'])) {
//redirection des photos téléchargées
            $repository = $_SERVER['DOCUMENT_ROOT'] . 'assets/images/';
//extensions autorisées
            $extendOk = array('jpeg', 'jpg', 'png', 'JPG');
//récupération de l'extension du fichier
            $nameFile = $_FILES['picture']['name'];
            $extend = pathinfo($nameFile, PATHINFO_EXTENSION);
            $renameFile = $repository . $nameFile;
//Si picture à bien été téléchargée
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $renameFile)) {
//vérification des valeurs id E2N_users et picture E2N_candidate
                $candidate->id = $_POST['id'];
                $candidate->picture = $nameFile;
                $candidate->upDateCandidate();
                echo "Succés de l'ajout photo !";
//contrôle d'extension de la photo
                if (!(in_array($extend, $extendOk))) {
                    echo "Le fichier n'est pas un .jpeg, .jpg ou .png";
                }
            } 
        }
    }

    /* Controller de tri et de recherche */

//récupération des valeurs du filtre
//récupération des valeurs de la recherche
//vérification des valeurs du filtre des candidats
    if (isset($_POST['lastName']) && $_POST['lastName'] == 'ascLastName') {
        $candidateSearch = $candidate->orderByAZ();
    } elseif (isset($_POST['lastName']) && $_POST['lastName'] == 'descLastName') {
        $candidateSearch = $candidate->orderByZA();
    } elseif (isset($_POST['badge']) && $_POST['badge'] == 'lessBadge') {
        $candidateSearch = $candidate->orderByLessBadge();
    } elseif (isset($_POST['badge']) && $_POST['badge'] == 'moreBadge') {
        $candidateSearch = $candidate->orderByMoreBadge();
    } elseif (isset($_POST['search'])) {
        $paramBarSearch = $_POST['search'];
        $candidateSearch = $candidate->getCandidateBySearchBar($paramBarSearch);
    } else {
        $paramFilterSearch = '';
        $candidateSearch = $candidate->joinCandidateByUsers();
    }


    /* Controller de votes */

//Créer un objet de vote pour l'utilisateur
//@param('connexion db','id user actif')
    $voteManage = new usrVote($db, 25);

//Récupére les valeurs d'un formulaire pour  ajoute un vote  pour un candidat à l'envoi du formulaire
    if (isset($_POST['resultVote']) && !empty($_POST['resultVote'])) {
        $candidate_Id = $_POST['candidateId'];
        $vote = $_POST['resultVote'];
        $refusalReason_id = $_POST['refusalReason'];
        $voteManage->addVote($candidate_Id, $vote, $refusalReason_id);
    }

// Récupére les valeurs d'un formulaire pour modifier  un vote pour un candidat
    if (isset($_POST['updateVote']) && !empty($_POST['updateVote'])) {
        $candidate_Id = $_POST['candidateId'];
        $vote = $_POST['updateVote'];
        $refusalReason_id = $_POST['refusalReason'];
        $voteManage->updateVote($candidate_Id, $vote, $refusalReason_id);
    }
}
?>

