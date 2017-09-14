<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/group.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/groupController.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 usrTitleGroup">Liste des groupes</div>
        <table class="table table-striped groupList">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom du groupe</th>
                    <th>Activer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groupList as $groupDetail) { ?>
                    <tr>
                        <td><?php echo $groupDetail['id'];
                    ?></td>
                        <td><?php echo $groupDetail['name'];
                    ?></td>
                        <td><?php if ($groupDetail['enable'] == 1) { ?>
                            <td><img src="../assets/images/validation.gif" alt="activer"></td>
                        <?php } else {
                            ?>
                            <td><img class="usrManageGroupImg" src="../assets/images/croixrouge.png" alt="désactiver"></td>
                        <?php } ?>
                        <td>  
                            <div class="btn-group" role="group">
                                <a class="btn btn-warning usrModifGroup" href="groupAdd.php?id=<?php echo $groupDetail['id']; ?>"><span class="glyphicon glyphicon-user"></span> Modifier</a>
                            </div></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-default usrAddGroupBtn" href="groupAdd.php">Création Groupe </a>
    </div>
</div>

<script src="../assets/lib/bootstrap.min.js" ></script>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/footer.php';
?>
