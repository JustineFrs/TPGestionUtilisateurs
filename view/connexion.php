<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/user.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'model/group.php';
include_once $_SERVER['DOCUMENT_ROOT'] . 'controller/connexionController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/usrStyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid usrConnexionBloc">
                <div class="usrConnexionForm">
                    <form action="connexion.php" method="post">
                        <div class="usrConnexionCenter"><input type="text" name="login" placeholder="login" class="usrConnexionInput"/><br/></div>
                        <div class="usrConnexionCenter"><input type="text" name="password" placeholder="password" class="usrConnexionInput"/><br/></div>
                        <div class="usrConnexionCenter"><input type="submit" value="Se connecter" class="usrConnexionInput"/></div>
                    </form>
            </div>
        </div>
    </body>
</html>