<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/user.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/group.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/manageController.php';
// Si on a l'utilisateur est connecté que son groupsId = 1 = administrateur, alors il peut accéder à cette page
if (isset($_SESSION['usrId']) && $_SESSION['usrGroupsId'] == 1) {
    ?>
    <div class="row">
        <h1 class="usrManageUserMainTitle"><u>Gestion des utilisateurs</u></h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form enctype="multipart/form-data" action="manageUser.php" method="get">
                <div class="usrManageUserFilter">
                    <select name="groupsId">
                        <option value="0">Tous les utilisateurs</option>
                        <?php foreach ($groupList as $filterUser) { ?>               
                            <option value="<?= $filterUser['id'] ?>" <?= ($groupsId == $filterUser['id'] ? 'selected' : ''); ?>><?= $filterUser['name'] ?></option>
                        <?php }  ?>
                    </select>
                    <button type="submit">Filtrer</button>
                </div>
            </form>
            <div class="usrManageUserFilter col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a href="addOrChangeUser.php" name="add" class="btn btn-primary">Ajouter un utilisateur</a>
            </div>
        </div>
    </div>
</div>
    <table>
        <tr class="usrManageUserTitles">
            <th class="usrManageUserTitlesCenter">Id</th>
            <th class="usrManageUserTitlesCenter">Avatar</th>
            <th class="usrManageUserTitlesCenter">Nom</th>
            <th class="usrManageUserTitlesCenter">Prenom</th>
            <th class="usrManageUserTitlesCenter">Login</th>
            <th class="usrManageUserTitlesCenter">Password</th>
            <th class="usrManageUserTitlesCenter">Email</th>
            <th class="usrManageUserTitlesCenter">Age</th>
            <th class="usrManageUserTitlesCenter">Date de naissance</th>
            <th class="usrManageUserTitlesCenter">Téléphone</th>
            <th class="usrManageUserTitlesCenter">Autorisation</th>
            <th class="usrManageUserTitlesCenter">Groupe</th>
        </tr>
        <?php foreach ($userList as $userDetail) { ?>
            <tr class="usrManageUserContent">
                <td><?= $userDetail['id'] ?></td>
                <td><img src="/assets/images/<?= $userDetail['avatar'] ?>"/></td>
                <td><?= $userDetail['lastName'] ?></td>
                <td><?= $userDetail['firstName'] ?></td>
                <td><?= $userDetail['login'] ?></td>
                <td><?= $userDetail['password'] ?></td>
                <td><?= $userDetail['email'] ?></td>
                <td><?= $userDetail['age'] . ' ans' ?></td>
                <td><?= $userDetail['birthDate'] ?></td>
                <td><?= $userDetail['phone'] ?></td>
                <td><?= $userDetail['enable'] ?></td>
                <td><?= $userDetail['groupsName'] ?></td>
                <td><a href="addOrChangeUser.php?id=<?= $userDetail['id'] ?>" class="btn btn-warning">Modifier le groupe</a></td>
            <?php } ?>
    </table>  
    <?php
    include_once "footer.php";
}
