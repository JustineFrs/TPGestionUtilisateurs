<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/user.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/group.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/addOrChangeController.php';
?>
<div class="col-xs-12 form-group usrAddOrChangeUserContainer">
    <form enctype="multipart/form-data" action="addOrChangeUser.php" method="post" class="usrAddOrChangeUserBloc">
        <input type="hidden" name="id" value="<?= $id ?>"/>
        <br/>
        <div class="form-group usrAddOrChangeUserInput <?php echo $lastNameError ? 'has-error' : 'has-success' ?>">
            <label for="nom" class="col-xs-12">Nom :</label>
            <input type="text" name="lastName" class="form-control" value="<?= $lastName ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $firstNameError ? 'has-error' : 'has-success' ?>">
            <label>Prenom :</label>
            <input type="text" name="firstName" class="form-control" required="required" value="<?= $firstName ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $loginError ? 'has-error' : 'has-success' ?>">
            <label for="login">Login :</label>
            <input type="text" name="login" class="form-control" required="required" value="<?= $login ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $passwordError ? 'has-error' : 'has-success' ?>">
            <label>Password :</label>
            <input type="text" name="password" class="form-control" value="<?= $password ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $emailError ? 'has-error' : 'has-success' ?>">
            <label>Mail :</label>
            <input type="text" name="email" class="form-control" required="required" value="<?= $email ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $birthDateError ? 'has-error' : 'has-success' ?>">
            <label>Date de Naissance :</label>
            <input type="text" name="birthDate" class="form-control" required="required" value="<?= $birthDate ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $phoneError ? 'has-error' : 'has-success' ?>">
            <label>Téléphone :</label>
            <input type="text" name="phone" class="form-control" required="required" value="<?= $phone ?>"/>
            <br/>
        </div>
        <div class="form-group usrAddOrChangeUserInput <?php echo $avatar ? 'has-error' : 'has-success' ?>">
            <label for="avatar">Avatar :</label>
            <input type="file" name="avatar" value="../assets/images/<?= $avatar ?>" class="col-sm-12 usrAddOrChangeUserInput"/>
        </div>
        <?php if ($_SESSION['usrGroupsId'] == 1) { ?>
            <select name="groupsId" class="usrAddOrChangeUserSelect">
                <?php foreach ($groupList as $groupDetail) { ?>
                    <option value="<?= $groupDetail['id'] ?>"><?= $groupDetail['name'] ?></option>
                <?php }  ?>
            </select><br/>
        <?php } if (!isset($_GET['id'])) { ?><input type="submit" value="Ajouter un utilisateur" name="addUser" class="btn btn-success"/><br/>
        <?php } else { ?><input type="submit" value="Modifier un utilisateur" name="changeUser" class="btn btn-success"/><?php } ?><br/>
    </form>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . 'view/footer.php'; ?>