<?php

require_once './isLoggedIn.php';

$user = isLoggedIn();

if (!$user) {
    header ('Location: ./connexion.php');
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Inscription.css">
    <link rel="stylesheet" href="/CSS/Header-Footer.css">
    <title>Connexion</title>
</head>
<body>
<?php require_once'includes/header.php' ?>

    <h1>PROFIL</h1>
    <h2>Hello<?= $user['pseudo'] ?></h2>


    <nav>
        <a href="/">Accueil</a>
        
        <a href="/logout.php/">Se déconnecter</a>
        
        <a href="/profile.php/">Profil</a>
    </nav>


    
<?php require_once'includes/footer.php' ?>
</body>
</html>