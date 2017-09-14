<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/group.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/groupAdd.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/header.php';
?>
<a href="manageGroup.php" name="manageGroup.php">Retour à la liste</a>
        <div class="col-lg-12 titleGroup">
            
            <div class="row">
                <?php if (empty($_GET['id'])) { ?>
                    <h1>Créations groupes</h1>
                <?php } else {
                    ?>
                    <h1>Modifications groupes</h1>
                <?php } ?>
            </div>
        </div>
    <div class="form-group">
        <form action="groupAdd.php" method="post" class="cadre">
            <p><?php ?></p>
            <div class="form-group idk <?php echo $nameError ? 'has-error' : 'has-success' ?>">

                <label for="nom">Nom du groupe :</label>
                <input type="text" value="<?php echo $nameRecov ?>" name="name" class="form-control" />
                <label for="enable">Activation du groupe ? : </label><input type="checkbox" value=1 checked=""  name="enable"/><br />
                <br/>
            </div>
            <?php if (!$id) { ?>
                <input type="submit" value="Ajouter un Groupe" name="addGroup"/><br/>
            <?php } else { ?>
                <input type="hidden" value="<?php echo $id ?>" name="idGroup"/>
                <input type="submit" value="Modifier un Groupe" name="changeGroup"/><?php } ?><br/>
        </form>
    </div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'view/footer.php';
?>