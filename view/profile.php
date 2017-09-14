<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/user.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/profileController.php';
if (isset($_SESSION['usrId'])) {
    ?>
    <div class="row">
        <div class="col-lg-offset-4 col-lg-4">
            <div class="form-group row">
                <label for="example-text-input" class="col-xs-4 col-form-label">Avatar :</label>
                <div class="col-xs-8">
                    <img src="../assets/images/<?= $user->avatar ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-xs-4 col-form-label">Nom :</label>
                <div class="col-xs-8">
                    <input class="form-control" value="<?= $user->lastName ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstname" class="col-xs-4 col-form-label">Prénom :</label>
                <div class="col-xs-8">
                    <input class="form-control" value="<?= $user->firstName ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-url-input" class="col-xs-4 col-form-label">Login :</label>
                <div class="col-xs-8">
                    <input class="form-control" value="<?= $user->login ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-tel-input" class="col-xs-4 col-form-label">Date de Naissance :</label>
                <div class="col-xs-8">
                    <input class="form-control" value="<?= $birthDate ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-tel-input" class="col-xs-4 col-form-label">Telephone :</label>
                <div class="col-xs-8">
                    <input class="form-control" value="<?= $user->phone ?>"/>
                </div>
            </div>
            <div class="row usrProfileButton">
            <a href="addOrChangeUser.php?id=<?= $user->id ?>" class="col-xs-offset-4 col-xs-8 btn btn-success">Modifier mon profil</a>
            </div>
        </div>
    </div>
    <?php
}
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/footer.php';
