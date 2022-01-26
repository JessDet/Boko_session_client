<?php

$pdo = require './database.php';


require './isLoggedIn.php';
$user = isLoggedIn();

$filename = __DIR__. '\IMG\img\\';
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    echo"<pre>";
    print_r($_FILES['photo']);
    echo"</pre>";

    move_uploaded_file($_FILES["photo"]["tmp_name"], $filename . $_FILES["photo"]["avatar"]);
    

    $files = '\IMG\img\\' . $_FILES["photo"]["avatar"] ?? '';

    

    if ($files) {
        $statement = $pdo ->prepare('INSERT INTO utilisateur VALUES (DEFAULT, :avatar)');
        $statement->bindValue(':avatar', $files);
        $statement->execute();
    }
  
};



// ---------------------------------- récupération des données de l'utilisateur pour la modif

$id = $_GET['edit'] ?? '';
echo $id;

$stateReadUser = $pdo->prepare('SELECT * FROM utilisateur WHERE idUser=:id');
$stateReadUser->bindValue(':id', $id);
$stateReadUser->execute();
$users = $stateReadUser->fetch();
    $firstname = $users['firstname'] ?? '';
    $lastname = $users['lastname'] ?? '';
    $birthday = $users['birthday'] ?? '';
    $adress = $users['adress'] ?? '';
    $phone = $users['phone'] ?? '';
    $pseudo = $users['pseudo'] ?? '';
    $email = $users['email'] ?? '';
    $password = $users['password'] ?? '';
    // $avatar = $users['avatar'];
    $id = $users['id'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $birthday = $_POST['birthday'] ?? '';
        $adress = $_POST['adress'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $pseudo = $_POST['pseudo'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
            // $user['avatar'] = $avatar;
        $id = $_POST['id'] ?? '';
  

$stateUpdate = $pdo->prepare('
UPDATE utilisateur
SET
    firstname=:firstname,
    lastname=:lastname,
    birthday=:birthday,
    adress=:adress,
    phone=:phone,
    pseudo=:pseudo,
    email=:email,
    password=:password,
    // avatar=:avatar,
WHERE idUser=:id
');

    $stateUpdate->bindValue(':firstname', $firstname);
    $stateUpdate->bindValue(':lastname', $lastname);
    $stateUpdate->bindValue(':birthday', $birthday);
    $stateUpdate->bindValue(':adress', $adress);
    $stateUpdate->bindValue(':phone', $phone);
    $stateUpdate->bindValue(':pseudo', $pseudo);
    $stateUpdate->bindValue(':email', $email);
    $stateUpdate->bindValue(':password', $password);
    // $stateUpdate->bindValue(':avatar', $user['avatar']);
    $stateUpdate->bindValue(':id', $id); 
    $stateUpdate->execute(); 

}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/modif_profil.css">
    <link rel="stylesheet" href="/CSS/Header-Footer.css">
    <title>Connexion</title>
</head>

<body>
<!-- <?php require_once 'includes/header.php' ?> -->

<div class="top_page">

    <div class="deco">
        <img src="/IMG/feuillage.jpg" alt="feuillage" class="img_feuilles">
    </div>

    <h1>Modifier mon profil</h1>



    </div>

<body>
    
<div class="box_modifications">
    <div class="avatar">
        <form action="/modif_profil.php" method="POST" enctype="multipart/form-data">
            <h2>Photo de profil</h2><br>
            <label for="fileUpload">Fichier : </label>
            <input type="file" name="photo" id="fileUpload">
            <input type="submit" name="submit" value="Telecharger">
        </form>
    </div><br>

        <div class="container" id="container">
            <form class="maj-form" action="/profile.php <?= $id ? "?id=$id" : '' ?>" method="POST">
            <h2>Informations personnelles</h2><br>
                    <input class="maj" type="text" placeholder="firstname" name="firstname" value="<?= $firstname ?? '' ?>"><br>
                    <input class="maj" type="text" placeholder="lastname" name="lastname" value="<?= $lastname ?? '' ?>"><br>
                    <input class="maj" type="text" placeholder="birthday AAAA-MM-JJ" name="birthday" value="<?= $birthday ?? '' ?>"><br>
                    <input class="maj" type="text" placeholder="adress" name="adress" value="<?= $adress ?? '' ?>"><br>
                    <input class="maj" type="text" placeholder="phone" name="phone" value="<?= $phone ?? '' ?>"><br>
                    <input class="maj" type="text" placeholder="pseudo" name="pseudo" value="<?= $pseudo ?? '' ?>"><br>
                    <input class="maj" type="text" placeholder="email" name="email" value="<?= $email ?? '' ?>"><br>
                    <input class="maj" type="password" placeholder="password" name="password" value="<?= $password ?? '' ?>"><br>
            </form>
	
        </div>

        <br>
        <button>Modifier</button><br>
    
        </div>

    <?php require_once 'includes/footer.php' ?>
</body>

</html>