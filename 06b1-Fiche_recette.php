<?php
require './isLoggedIn.php';

$user = isLoggedIn();

if (!$user) {
    header('Location: /connexion.php');
}

// on récupére l'id de dans l'url

$id = $_GET['id'];
setcookie('idrecette', $id, time() + 60 * 5);

// on se connecte à la BDD

$pdo = require './database.php';

// on récupére la recette en question

$stateOneRecette = $pdo->prepare('SELECT * from recettes WHERE idrecette=:id');
$stateOneRecette->bindValue(':id', $id);
$stateOneRecette->execute();
$recette = $stateOneRecette->fetch();

// on récupère les ingredients qui correspondent à cette recette

$stateIngredients = $pdo->prepare('SELECT * FROM ingredients, possede WHERE ingredients.idIng = possede.idIng and possede.idrecette=:id ');
$stateIngredients->bindValue(':id', $id);
$stateIngredients->execute();
$ingredients = $stateIngredients->fetchAll();

// echo "<pre></pre>";
// var_dump($ingredients);
// echo "<pre></pre>";
// die();

//--------------------------------------------------------------------------- partie commentaires

$pdo = require './database.php';

$statement = $pdo->prepare('SELECT commentaire.*, utilisateur.pseudo
 FROM commentaire, utilisateur WHERE commentaire.idUser = utilisateur.idUser and idrecette=:id');
$statement->bindValue(':id', $_COOKIE['idrecette']);
$statement->execute();
$comments = $statement->fetchAll();

$statementUser = $pdo->prepare('SELECT * FROM utilisateur');
$statementUser->execute();
$users = $statementUser->fetchAll();

$statementRecipe = $pdo->prepare('SELECT * FROM recettes');
$statementRecipe->execute();
$recipe = $statementRecipe->fetchAll();

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$stateCreate = $pdo->prepare('
INSERT INTO commentaire (
    note,
   titre,
   commentaire,
   idUser,
   idrecette
   ) VALUES (
       :note,
       :titre,
       :commentaire,
       :idUser,
       :idrecette
       )
');

// $stateRead = $pdo->prepare('SELECT * FROM commentaire, utilisateur WHERE commentaire idcommentaire=:id');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_input = filter_input_array(INPUT_POST, [
        'titre' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'commentaire' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],

    ]);

    $titre = $_input['titre'] ?? '';
    $commentaire = $_input['commentaire'] ?? '';
    $note = $_POST['note'] ?? '';

    $stateCreate->bindValue(':note',  $note);
    $stateCreate->bindValue(':titre',  $titre);
    $stateCreate->bindValue(':commentaire',  $commentaire);
    $stateCreate->bindValue(':idUser',  $user['idUser']);
    $stateCreate->bindValue(':idrecette', $_COOKIE['idrecette']);
    $stateCreate->execute();

    // vider les champs input des commentaires
    $titre = '';
    $commentaire = '';

    header('Location: /06b-Recettes.php');
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Header-Footer.css">
    <link rel="stylesheet" href="CSS/06b1-Fiche_recette.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allison&display=swap" rel="stylesheet">

    <title>BOKO Local Vrac et Bio</title>
</head>

<body>


    <?php require_once 'includes/header.php' ?>

    <!-- <nav class="btn--return">
            <a href="06b-Recettes.php"><img src="Icons/btn-return-fb.png" alt="return" id="btn-return" width="200px"></a>
        </nav> -->



    <main>



        <div class="info_recipe">
            <h1><?= $recette['titre'] ?></h1>
            <pre><?= $recette['presentation'] ?></pre>
        </div>

        <div class="container-recipe-global">
            <div class="container-recipe-ingredient">
                <div class="recipe">
                    <h2>Recette</h2>
                    <div class="deroul-recipe">
                        <div class="time-prepa">
                            <img src="Icons/hourglass_icon_178153.png" alt="" id="icon-recipe" width="40px">
                            <p>Préparation : <strong><?= $recette['duree'] ?> minutes</strong></p>
                        </div>
                        <div class="difficult">
                            <img src="Icons/leaf_icon-icons.com_48277.png" alt="icon-recipe" width="40px">
                            <p>difficulté : <strong><?= $recette['difficulte'] ?></strong></p>
                        </div>
                        <div class="price">
                            <img src="Icons/etiquette-tn---2.png" alt="icon-recipe" width="40px">
                            <p>Budget : <strong><?= $recette['budget'] ?></strong></p>
                        </div>

                    </div>
                </div>


                <div class="ingredient">
                    <h2>Ingrédients</h2>
                    <div class="list-ingredients">
                        <!-- <pre> -->
                        <!-- on boucle pour afficher les ingrédients -->
                        <?php foreach ($ingredients as $i) : ?>
                            <?= "- " . $i['name'] . " : " . $i['qte'] . " " .  $i['type'] . "<br>" ?>
                        <?php endforeach; ?>
                        <!-- // - Légumes bio
// - Eau
// - Sucre
// - Vinaigre de cidre bio (ou vinaigre de vin bio)
// - des aromates : Herbes et aromates, Baies, laurier, romarin, 
// grains de poivre, de moutarde, de coriandre... -->
                        <!-- </pre> -->
                    </div>
                </div>
            </div>

            <div class="container_img">
                <div class="illustration-recipe">
                    <img src="<?= $recette['img1'] ?>" alt="prepa_pickels" width="400px">
                </div>
            </div>
        </div>


        <div class="container_prepa">

            <div class="illustra">

                <div class="deroule_prepa">
                    <h2>Préparation</h2>
                    <div class="txt_deroule_prepa">
                        <?= $recette['preparation'] ?>
                        <!-- <pre>
Dans une casserole, faire bouillir 1 volume d’eau avec 1/2 volume de vinaigre de cidre et 1/2 volume de sucre.
En parallèle, râper les légumes avec une râpe manuelle en inox ou les découper en morceaux (selon le légume 
choisi et son envie).
Stériliser les bocaux avec de l’eau bouillante.
Disposer les légumes râpés dans le fond des bocaux (remplir au 3/4).
Ajouter par dessus les épices et aromates au choix : poivre, baies, laurier, romarin, aneth…
Verser la préparation bouillante sur les légumes jusqu’à remplir le bocal.
Laisser refroidir.
Fermer le bocal hermétiquement.
Faire mariner 3 jours au réfrigérateur avant de déguster
Faire bouillir eau vinaigre sucre.
Stériliser bocaux.
Légumes dans bocaux.
                </pre> -->
                    </div>
                </div>
            </div>
        </div>
    </main>


    <h1>Commentaires</h1>

    <!-- afficher les commentaires -->
    <div class="tchat">
        <?php foreach ($comments as $a) : ?>
            <span class="titre"><?= $a['titre'] ?></span>
            <span class="comment"><?= $a['commentaire'] ?></span><br>
            <span class="date"><?= $a['date'] ?></span>
            <span class="pseunote"><?= $a['pseudo'] . " | Note : " . $a['note'] ?></span>
        <?php endforeach; ?>
    </div>



    <div class="input-container">
        <form action="/06B1-Fiche_recette.php<?= $id ? "?id=$id" : '' ?>" method="POST">
            <div class="title_comment">
                <label for="titre">Titre</label>
                <textarea name="titre" id="titre"><?= $titre ?? '' ?></textarea>
            </div>
            <div class="commentaire_comment">
                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" id="commentaire"><?= $commentaire ?? '' ?></textarea>
            </div>
            <div class="title_comment">
                <label for="note">Note</label>
                <input type="number" name="note" min="1" max="10" value="10" id="note">/10
            </div>
            <div class="form-action">
                <button class="btn btn-primary">Publier</button>
            </div>
        </form>
    </div>




    <?php require_once 'includes/footer.php' ?>

</body>

</html>