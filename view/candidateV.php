<?php
include $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
include $_SERVER['DOCUMENT_ROOT'] . 'view/header.php';
include $_SERVER['DOCUMENT_ROOT'] . 'model/candidate.php';
include $_SERVER['DOCUMENT_ROOT'] . 'model/vote.php';
include $_SERVER['DOCUMENT_ROOT'] . 'controller/candidateController.php';

// Si on a l'utilisateur est connecté que son groupsId = 1 = administrateur, 
//ou 2 = équipe pédagogique, ou 3 = groupe Simplon alors il peut accéder à cette page
if (isset($_SESSION['usrId']) && isset($_SESSION['usrGroupsId']) && $_SESSION['usrGroupsId'] == 1 || $_SESSION['usrGroupsId'] == 2 || $_SESSION['usrGroupsId'] == 3) {
    ?>
    <div class="row">
        <!--Filtre candidats-->
        <div id="usrCandidateFilter" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <!--Formulaire de recherche par Ordre alphabetique ASC / DESC-->
            <form name="formSearch" action="candidateV.php" method="post">
                <div id="usrCandidateAlpha" class="col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-6 col-xs-6">
                    <select class="usrCandidateSelect col-lg-12 col-md-12 col-sm-12 col-xs-12" name="lastName">
                        <option value="noParam">Nom</option>
                        <option value="ascLastName">A - Z</option>
                        <option value="descLastName">Z - A</option>
                    </select>
                    <input class="usrCandidateSubmit btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" type="submit" value="Trier"/>
                </div>
                <div id="usrCandidateBadge" class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <!--Formulaire de recherche par nombre de badges-->
                    <select class="usrCandidateSelect col-lg-12 col-md-12 col-sm-12 col-xs-12" name="badge">
                        <option value="noParam">Nombre de badge</option>
                        <option value="lessBadge">- de 25 badges</option>
                        <option value="moreBadge">+ de 25 badges</option>
                    </select>
                    <input class="usrCandidateSubmit btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" type="submit" value="Trier"/>
                </div>
            </form>
            <div id="usrCandidateSearchBar" class="col-lg-3 col-md-3 col-sm-10 col-xs-10">
                <!--Formulaire de recherche par barre de recherche-->
                <form name="formBarSearch" action="candidateV.php" method="post">
                    <input class="usrCandidateSearch form-control" name="search" type="search" placeholder="Nom, prénom, hacks ou superHero"/>
                    <input class="usrCandidateSubmitSearch btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" type="submit" value="Rechercher"/>
                </form>
            </div>
            <!--Bouton Top - retour en haut de page-->
            <a href="#">
                <div id="usrCandidateBtnTop" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i>
                </div>
            </a>
        </div>
    </div>

    <!--Formulaire d'affichage des propriétés des candidats-->
    <div class="row">
        <div id="usrCandidatefullAccordion" class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
            <hr/>
            <?php foreach ($candidateSearch as $candidateDetails) { ?>
                <div id="usrCandidateViewPicture" class="col-lg-offset-1 col-lg-1 col-md-offset-1 col-md-2 col-sm-2 col-xs-2">
                    <form enctype="multipart/form-data" action="candidateV.php" method="post">
                        <?php
                        if (!empty($candidateDetails['picture'])) {
                            ?>
                            <img class="usrCandidateProfilPicture" src="/assets/images/<?= $candidateDetails['picture'] ?>"/>
                            <?php
                        } else {
                            ?>
                            <div class="wrap-drop">
                                <input name="id" type="hidden" value="<?= $candidateDetails['id'] ?>"/>
                                <input type="file" onchange="this.form.submit();" name="picture"/>
                            </div>
                            <?php
                        }
                        ?>
                    </form>
                </div>
                <div class="usrCandidateViewAccordion">
                    <div class="accordion">
                        <div class="row">   
                            <div class="usrCandidateBlockName col-lg-6 col-md-6 col-sm-offset-1 col-sm-6 col-xs-offset-3 col-xs-5">
                                <p class="usrCandidateName"><?= $candidateDetails['firstName'] . ' ' . $candidateDetails['lastName'] ?></p>
                                <p class="usrCandidateNbBadge"><strong><?= $candidateDetails['badge'] ?></strong> badges Codecademy</p>
                            </div>
                            <div class="usrChevronDown col-lg-offset-1 col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="row">
                            <div class="col-lg-7">
                                <table class="usrCandidateTable">
                                    <tr>
                                        <th class="col-lg-4">Prénom</th>
                                        <td class="col-lg-8"><?= $candidateDetails['firstName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Nom</th>
                                        <td class="col-lg-8"><?= $candidateDetails['lastName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Email</th>
                                        <td class="col-lg-8"><?= $candidateDetails['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Téléphone</th>
                                        <td class="col-lg-8"><?= $candidateDetails['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Date de Naissance</th>
                                        <td class="col-lg-8"><?= $candidateDetails['birthDate'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Lieu de naissance</th>
                                        <td class="col-lg-8"><?= $candidateDetails['birthPlace'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Adresse</th>
                                        <td class="col-lg-8"><?= $candidateDetails['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Nationalité</th>
                                        <td class="col-lg-8"><?= $candidateDetails['nationality'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Super Héro</th>
                                        <td class="col-lg-8"><?= $candidateDetails['superHero'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Hacks</th>
                                        <td class="col-lg-8"><?= $candidateDetails['hacks'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Motivation</th>
                                        <td class="col-lg-8"><?= $candidateDetails['motivation'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Futur</th>
                                        <td class="col-lg-8"><?= $candidateDetails['future'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Lien Openclassroom</th>
                                        <td class="col-lg-8"><a href="<?= $candidateDetails['openclassroomLink'] ?>"><?= $candidateDetails['openclassroomLink'] ?></a></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Niveau d'anglais</th>
                                        <td class="col-lg-8"><?= $candidateDetails['englishLevelName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Badges codecadmy</th>
                                        <td class="col-lg-8"><?= $candidateDetails['badge'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Niveau d'étude</th>
                                        <td class="col-lg-8"><?= $candidateDetails['gradeName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Disponibilité</th>
                                        <td class="col-lg-8"><?php
                                            if ($candidateDetails['available'] == 1) {
                                                echo "Oui";
                                            } elseif ($candidateDetails['available'] == 2) {
                                                echo "Non";
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-lg-4">Contrainte de disponibilité</th>
                                        <td class="col-lg-8"><?= $candidateDetails['constraint'] ?></td>
                                    </tr>
                                    <tr>
                                        <!--Affichage des informations du status candidat selon les données renseignées par le candidats à l'inscription-->
                                        <th class="col-lg-4">Statut du candidats</th>
                                        <td class="col-lg-8">
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['student']) && $candidateDetails['student'] == 1) {
                                                    echo "Etudiant";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['employe']) && $candidateDetails['employe'] == 1) {
                                                    echo "Salarié";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['DAPE']) && $candidateDetails['DAPE'] == 1) {
                                                    echo "Demandeur d'emploi indemnisé par Pôle Emploi";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['DANPE']) && $candidateDetails['DANPE'] == 1) {
                                                    echo "Demandeur d'emploi non indemnisé par Pôle Emploi";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['RSA']) && $candidateDetails['RSA'] == 1) {
                                                    echo "Allocataire RSA";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['ASS']) && $candidateDetails['ASS'] == 1) {
                                                    echo "Allocataire ASS";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['ASH']) && $candidateDetails['ASH'] == 1) {
                                                    echo "Allocataire ASH";
                                                }
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                if (!empty($candidateDetails['other'])) {
                                                    echo $candidateDetails['other'];
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                <table class="usrCandidateTable">
                                    <!--Ajout du genre candidats-->
                                    <tr>
                                        <th class="col-lg-4">Genre</th>
                                        <td class="col-lg-8">
                                            <label for="genre">F:</label>
                                            <input name="genre_<?= $candidateDetails['id'] ?>" type="radio" value="1" class="submitInfo" <?php
                                            if ($candidateDetails['genre'] == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                            <label for="genre">H:</label>
                                            <input name="genre_<?= $candidateDetails['id'] ?>" type="radio" value="2" class="submitInfo" <?php
                                            if ($candidateDetails['genre'] == 2) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>

                                        </td>
                                    </tr>
                                    <tr><!--Ajout du QPV candidats-->
                                        <th class="col-lg-4">QPV</th>
                                        <td class="col-lg-8">
                                            <label for="qpv">Oui:</label>
                                            <input name="qpv_<?= $candidateDetails['id'] ?>" type="radio" value="1" class="submitInfo" <?php
                                            if ($candidateDetails['qpv'] == 1) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                            <label for="qpv">Non:</label>
                                            <input name="qpv_<?= $candidateDetails['id'] ?>" type="radio" value="0" class="submitInfo" <?php
                                            if ($candidateDetails['qpv'] == 0) {
                                                echo 'checked="checked"';
                                            }
                                            ?>/>
                                        </td>
                                    </tr>

                                    <!-- Ajout d'une photo au candidat -->
                                    <tr>
                                        <th class="col-lg-5">Modifier la photo</th>
                                        <td class="col-lg-7">
                                            <form enctype="multipart/form-data" action="candidateV.php" method="post">
                                                <input name="id" type="hidden" value="<?= $candidateDetails['id'] ?>"/>
                                                <input class="col-lg-12" name="picture" type="file"/>
                                                <input class="col-lg-7" type="submit" value="Modifier photo"/>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="usrCandidateTable">
                                    <!-- Formulaire de création ou de modification de form -->
                                    <tr>
                                        <th>Voter</th>
                                        <td>
                                            <?php
                                            $vote = $voteManage->getVoteByUser($candidateDetails['id']);

                                            if (!$vote) {
                                                ?>
                                                <!-- Formulaire de création de vote-->
                                                <form method="post" action="candidateV.php">
                                                    <input name="candidateId" value="<?= $candidateDetails['id'] ?>" hidden/>
                                                    <input class="btn" type="submit" name="resultVote" value="Oui"/>
                                                    <input class="btn" type="submit" name="resultVote" value="Non"/>
                                                    <select name="refusalReason">
                                                        <option value="1">Aucune raison</option>
                                                        <option value="2">Formulaire incomplet</option>
                                                        <option value="3">Manque de motivation</option>
                                                    </select>
                                                </form>

                                            <?php } else { ?>

                                                <!-- Bouton 'Modifier' pour faire apparaitre le formaulaire -->
                                                <button class="btn modifVote" candidate = <?= $candidateDetails['id'] ?>>Modifier</button>

                                                <!-- Formulaire de modification de vote-->
                                                <form class="<?= 'modifForm modifForm-' . $candidateDetails['id'] ?>" method = "post" action = "candidateV.php">
                                                    <input name="candidateId" value="<?= $candidateDetails['id'] ?>" hidden/>
                                                    <input class="btn" type = "submit" name = "updateVote" value = "Oui"/>
                                                    <?php if ($candidateDetails['candidateState_id'] == 5) { ?>
                                                        <input class="btn" type = "submit" name = "updateVote" value = "En attente"/>
                                                    <?php } ?>
                                                    <input class="voteNo btn" type = "submit" name = "updateVote" value = "Non"/>
                                                    <select class="refusalReason" name = "refusalReason">
                                                        <option value = "1">Aucune raison</option>
                                                        <option value = "2">Formulaire incomplet</option>
                                                        <option value = "3">Manque de motivation</option>
                                                    </select>
                                                </form>
                                            <?php } ?>
                                        </td>
                                    <tr>
                                </table>
                            </div>
                        </div>
                        <!-- Liste des votes effectué par les utilisateurs-->
                        <table>
                            <?php
                            $listVotes = $voteManage->getVoteByCandidate($candidateDetails['id']);
                            ?>
                            <tr>
                                <th>votant</th>
                                <th>décision</th>
                                <th>raison</th>
                            <tr>
                                <?php foreach ($listVotes as $voteUser) { ?>
                                <tr>
                                    <td><?= $voteUser['login'] ?></td>
                                    <td><?= $voteUser['vote'] ?></td>
                                    <td><?= $voteUser['name'] ?></td>
                                </tr>
                            <?php } ?>

                        </table>
                    </div>
                </div>
                <hr/>
            <?php } ?>
        </div>
    </div>
    <script>
        //Accordéon déroulant
        var acc = document.getElementsByClassName('accordion');
        var i;
        for (i = 0; i < acc.length; i++) {
            acc[i].onclick = function () {
                this.classList.toggle('active');
                this.nextElementSibling.classList.toggle('show');
            }
        }
        $(document).ready(function () {
            // "Toggle" bouton Modifier/Formulaire de modification
            $('.modifForm').hide();
            $('.modifVote').click(function () {
                var candidate = $(this).attr('candidate');
                $('.modifForm-' + candidate + '').show();
                $(this).hide();
            });

            var offset = $('#usrCandidateFilter').offset().top;
            //option pour le footer correction du bug de position
            height = $('.container-fluid').height() + 50;
            $('.footer').css({
                top: '150px'})
            //Barre de filtre/recherche fixe au scroll
            $(document).scroll(function () {
                var scrollTop = $(document).scrollTop();
                if (scrollTop > offset) {
                    $('#usrCandidateFilter').css({
                        position: 'fixed',
                        top: '0px',
                    });
                    //saut pour visibilité du premier candidat
                    $('#usrCandidatefullAccordion').css({
                        top: '150px',
                    });

                    //position footer
                    $('.container-fluid').css({
                        height: height + 'px',
                    })
                }
                //sinon revient à sa position initiale
                else {
                    $('#usrCandidateFilter').css({
                        position: 'static',
                    });
                    $('#usrCandidatefullAccordion').css({
                        top: '0px',
                    });
                }
            });


        });
    </script>
    <script src="/assets/js/users.js" type="text/javascript"></script>
    <script src="/assets/lib/ezdz/js/fabric-1.6.3.min.js" type="text/javascript"></script>
    <script src="/assets/lib/ezdz/js/jquery.ezdz.min.js" type="text/javascript"></script>
    <script src="/assets/lib/ezdz/js/script.js" type="text/javascript"></script>

    <?php
    include_once "footer.php";
}
?>