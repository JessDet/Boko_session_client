<?php

require './isLoggedIn.php';

$user = isLoggedIn();

if (!$user) {
    header('Location: /connexion.php');
}


$pdo = require './database.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="/CSS/Header-Footer.css">
    <title>Connexion</title>
</head>

<body>
    <?php require_once 'includes/header.php' ?>

    <nav class="log">
        <a href="/logout.php/"><img class="logout_icon" src="icons/logout_90894.png" alt="Se déconnecter"></a>
    </nav>

    <h1>PROFIL</h1>
    <h2>Hello <?= $user['pseudo'] ?></h2>


    <div class="info_profil">
        <span><?= $user['firstname'] ?></span>
        <span><?= $user['lastname'] ?></span>
        <span><?= $user['adress'] ?></span>
        <span><?= $user['phone'] ?></span>
        <span><?= $user['email'] ?></span>
    </div>



    <?php require_once 'includes/footer.php' ?>
</body>

</html>