<?php
include $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
include $_SERVER['DOCUMENT_ROOT'] . 'model/vote.php';
include $_SERVER['DOCUMENT_ROOT'] . 'model/candidate.php';
include $_SERVER['DOCUMENT_ROOT'] . 'controller/candidateController.php';
include $_SERVER['DOCUMENT_ROOT'] . 'controller/voteController.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vote</title>
        <meta charset="utf8"/>
        <script type="text/javascript" src="/jquery.3.1.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    </head>
    <body>

        <?php
        //Affichage de chaque candidat
        foreach ($candidateList as $candidateDetail) {
            ?>
            <table>
                <td><?= $candidateDetail['birthPlace'] ?></td>
                <td><?= $candidateDetail['candidateState_id'] ?></td>
                <td><?= $candidateDetail['vote'] ?></td>
            </table>

            <!-- PARTIE AFFICHAGE DES FORMULAIRE DE VOTES -->

            <?php
            //retourne le vote de l'utilisateur pour un candidat
            $vote = $voteManage->getVoteByUser($candidateDetail['id']);
            // Si l'user n'a pas voté : Formulaire d'ajout de vote sinon le formulaire de modification de vote
            if (!$vote) {
                ?>
                <form method="post" action="voteView.php">
                    <input name="candidateId" value="<?= $candidateDetail['id'] ?>" hidden/>
                    <input class="btn" type="submit" name="resultVote" value="Oui"/>
                    <?php
                    //Si le status du candidat est en 'entretiens'
                    if ($candidateDetail['candidateState_id'] == 5) {
                        ?>
                        <input class="btn" type = "submit" name = "updateVote" value = "En attente"/>
                    <?php } ?>
                    <input class="btn" type="submit" name="resultVote" value="Non"/>
                    <select name="refusalReason">
                        <option value="1">Aucune raison</option>
                        <option value="2">Formulaire incomplet</option>
                        <option value="3">Manque de motivation</option>
                    </select>
                </form>
                <?php
            } else {
                ?>
                <button class="btn modifVote" candidate = <?= $candidateDetail['id'] ?>>Modifier</button>
                <!-- Partie visible aprés avoir clicqué sur modifier -->
                <form class="<?= 'modifForm modifForm-' . $candidateDetail['id'] ?>" method = "post" action = "voteView.php">
                    <input name="candidateId" value="<?= $candidateDetail['id'] ?>" hidden/>
                    <input class="btn" type = "submit" name = "updateVote" value = "Oui"/>
                    <?php
                    //Si le status du candidat est en 'entretiens'
                    if ($candidateDetail['candidateState_id'] == 5) {
                        ?>
                        <input class="btn" type = "submit" name = "updateVote" value = "En attente"/>
                    <?php } ?>
                    <input class="voteNo btn" type = "submit" name = "updateVote" value = "Non"/>
                    <select class="refusalReason" name = "refusalReason">
                        <option value = "1">Aucune raison</option>
                        <option value = "2">Formulaire incomplet</option>
                        <option value = "3">Manque de motivation</option>
                    </select>
                </form>

                <!-- Script à déplacer dans un fichier Js-->
                <script>
                    $(document).ready(function () {
                        // "Toggle" bouton Modifier/Formulaire de modification
                        $('.modifForm').hide();
                        $('.modifVote').click(function () {
                            var candidate = $(this).attr('candidate');
                            $('.modifForm-' + candidate + '').show();
                            $(this).hide();
                        });
                    })</script>
                <?php
            }
        }
        ?>

        <!-- FIN PARTIE FORMULAIRES DE VOTES -->

    </body>
</html>