<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/user.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/group.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/connexionController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/usrStyle.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/lib/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="/assets/lib/jquery/jquery-2.2.4.js" type="text/javascript"></script>
        <script src="/assets/lib/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <link href="/assets/lib/ezdz/css/jquery.ezdz.min.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/lib/ezdz/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
        <title>E2N : Ecole du Numérique du Noyonnais</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="usrHeaderTop">
                    <div class="header_bloc col-lg-2 col-md-2 col-sm-2 col-xs-6">
                        <img src="../assets/images/logo.jpg"/>
                    </div>
                    <div class="col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6 usrConnexionBloc">
                        <div class="usrConnexionForm">
                            <?php
                            // Si l'utilisateur n'est pas connecté, on affiche rien
                            if (!isset($_SESSION['usrId'])) {
                                ?>
                                <form action="manageUser.php" method="post">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 usrConnexionLog">
                                        <input type="text" name="login" placeholder="login" class="usrConnexionSubmit" required="required"/>
                                        <br/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 usrConnexionLog">
                                        <input type="text" name="password" placeholder="password" class="usrConnexionSubmit" required="required"/>
                                        <br/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 usrConnexionLog">
                                        <input type="submit" value="Se connecter" class="usrConnexionSubmit"/>
                                    </div>
                                </form>
                                <?php
                                // Si l'id utilisateur est rentré, on démarre la session et lui affiche Bonjour "prénom"
                            } else {
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-offset-9 col-md-offset-9 col-sm-offset-9 usrHeaderConnexionBar">
                            <form action="manageUser.php" method="post">
                                <p class="col-lg-6 col-md-6 col-sm-6 col-xs-offset-2 col-xs-4 usrHeaderConnexionName">Bonjour <?= $_SESSION['usrFirstName'] ?></p>
                                <input type="submit" name="disconnect" value="Se déconnecter" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 usrConnexionSubmit"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row usrHeaderBottom">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 usrHeaderMenu">
                        <div class="dropdown col-lg-3 col-md-3 col-sm-3 col-xs-12 usrHeaderDropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Utilisateur
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="profile.php">Mon Profil</a></li>
                            <?php
                            } // Si le groupsId de l'utilisateur = 1, alors il peut dérouler l'ensemble des li des dropdowns
                            if (isset($_SESSION['usrGroupsId']) && $_SESSION['usrGroupsId'] == 1) {
                                ?>
                                <li><a href="manageUser.php">Gestion Utilisateurs</a></li>
                                <li><a href="addOrChangeUser.php">Ajouter un utilisateur</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                        <div class="dropdown col-lg-3 col-md-3 col-sm-3 col-xs-12 usrHeaderDropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Groupe
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="manageGroup.php">Gérer les groupes</a></li>
                                <li><a href="groupAdd.php">Ajouter un groupe</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                        <div class="dropdown col-lg-3 col-md-3 col-sm-3 col-xs-12 usrHeaderDropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Candidats
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="candidateV.php">Gérer les candidats</a></li>
                            </ul>
                        </div>
                        <?php
                        // Si le groupsId != 1, on ferme les balises du 1er dropdown
                    } else {
                        ?>
                        </ul>
                    </div>
<?php } ?>
            </div>
        </div>