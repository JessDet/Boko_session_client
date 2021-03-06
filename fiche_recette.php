<?php


$pdo = require_once './database.php';

$statement = $pdo->prepare('SELECT * FROM commentaire');
$statement->execute();
$commentStatement = $pdo->prepare('SELECT * FROM commentaire natural join session');
$commentStatement->execute();

$commentaires = $statement->fetchAll();

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$stateCreate = $pdo->prepare('
INSERT INTO commentaire (
   titre,
   commentaire
   ) VALUES (
       :titre,
       :commentaire
       )
');

$stateUpdate = $pdo->prepare('
UPDATE commentaire
SET
titre=:titre
commentaire=:commentaire
WHERE idcommentaire=:id
');

$stateRead = $pdo->prepare('SELECT * FROM commentaire WHERE idcommentaire=:id');


// $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $_POST = filter_input_array(INPUT_POST, [
        'titre' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ],
        'commentaire' => [
            'filter' => FILTER_SANITIZE_STRING,
            'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
        ]
    ]);

    $titre = $_POST['titre'] ?? '';
    $commentaire = $_POST['commentaire'] ?? '';

    if ($id) {
        $commentaires['titre'] = $titre;
        $commentaires['commentaire'] = $commentaire;
        $stateUpdate->bindValue(':titre',  $commentaires['titre']);
        $stateUpdate->bindValue(':commentaire',  $commentaires['commentaire']);
        $stateUpdate->bindValue(':id',  $id);
        $stateUpdate->execute();
    } else {
        $stateCreate->bindValue(':titre',  $titre);
        $stateCreate->bindValue(':commentaire',  $commentaire);
        $stateCreate->execute();
    }
    header('Location: /fiche.php');
}



// require_once './isLoggedIn.php';

// $user = isLoggedIn();

// if (!$user) {
//     header('Location: /connexion.php');
// }







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

    <nav class="btn--return">
        <a href="06b-Recettes.php"><img src="Icons/btn-return-fb.png" alt="return" id="btn-return" width="200px"></a>
    </nav>



    <main>



        <div class="info_recipe">
            <h1>Les pickles de legumes</h1>





            <pre>Les pickles de l??gumes apportent une touche d???originalit?? ?? vos plats.
        
Avec leur petit go??t acidul??, ces petits condiments sont parfaits pour donner une touche de pep???s et de 
couleur dans une salade, un bowl, un sandwich ou ?? grignoter ?? l???ap??ritif entre amis avec un peu de
fromage frais ou de houmous.

Faire des pickles est simple et rapide et n??cessite peu d???ingr??dients.

Cette recette de base permet de r??aliser toute sorte de pickles diff??rents avec de nombreux l??gumes : 
c??leri rave, fenouil, carotte, choux rouge, oignon, choux-fleur, cornichon, radis noir, concombre, courgette, 
navet, betterave???</pre>

        </div>

        <div class="container-recipe-global">
            <div class="container-recipe-ingredient">
                <div class="recipe">
                    <h2>Recette</h2>
                    <div class="deroul-recipe">
                        <div class="time-prepa">
                            <img src="Icons/hourglass_icon_178153.png" alt="" id="icon-recipe" width="40px">
                            <p>Pr??paration : <strong>20 minutes</strong></p>
                        </div>
                        <div class="difficult">
                            <img src="Icons/leaf_icon-icons.com_48277.png" alt="icon-recipe" width="40px">
                            <p>difficult?? : <strong>facile</strong></p>
                        </div>
                        <div class="price">
                            <img src="Icons/etiquette-tn---2.png" alt="icon-recipe" width="40px">
                            <p>Budget : <strong>peu ??lev??</strong></p>
                        </div>

                    </div>
                </div>


                <div class="ingredient">
                    <h2>Ingr??dients</h2>
                    <div class="list-ingredients">
                        <pre>
- L??gumes bio
- Eau
- Sucre
- Vinaigre de cidre bio (ou vinaigre de vin bio)
- des aromates : Herbes et aromates, Baies, laurier, romarin, 
grains de poivre, de moutarde, de coriandre...
                </pre>
                    </div>
                </div>
            </div>

            <div class="container_img">
                <div class="illustration-recipe">
                    <img src="IMG/Banque d'img/Prepa-pickels.jpg" alt="prepa_pickels" width="400px">
                </div>
            </div>
        </div>


        <div class="container_prepa">

            <div class="illustra">

                <div class="deroule_prepa">
                    <h2>Pr??paration</h2>
                    <div class="txt_deroule_prepa">
                        <pre>
Dans une casserole, faire bouillir 1 volume d???eau avec 1/2 volume de vinaigre de cidre et 1/2 volume de sucre.
En parall??le, r??per les l??gumes avec une r??pe manuelle en inox ou les d??couper en morceaux (selon le l??gume 
choisi et son envie).
St??riliser les bocaux avec de l???eau bouillante.
Disposer les l??gumes r??p??s dans le fond des bocaux (remplir au 3/4).
Ajouter par dessus les ??pices et aromates au choix : poivre, baies, laurier, romarin, aneth???
Verser la pr??paration bouillante sur les l??gumes jusqu????? remplir le bocal.
Laisser refroidir.
Fermer le bocal herm??tiquement.
Faire mariner 3 jours au r??frig??rateur avant de d??guster
Faire bouillir eau vinaigre sucre.
St??riliser bocaux.
L??gumes dans bocaux.
                </pre>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <h1>Commentaires</h1>


    <div class="tchat">
        <?php foreach ($commentaires as $a) : ?>
            <!-- <h2><?= $user['username'] ?></h2> -->
            <span class="date"><?= $a['date'] ?></span>
            <span><?= $a['titre'] ?></span>
            <span><?= $a['commentaire'] ?></span>
        <?php endforeach; ?>
    </div>



    <div class="input-container">
        <form action="/fiche.php<?= $id ? "?id=$id" : '' ?>" method="POST">
            <label for="titre">Titre</label>
            <textarea name="titre" id="titre"><?= $titre ?? '' ?></textarea>

            <label for="commentaire">Commentaire</label>
            <textarea name="commentaire" id="commentaire"><?= $commentaire ?? '' ?></textarea>

            <div class="form-action">

                <button class="btn btn-primary"><?= $id ?: 'Publier' ?></button>
            </div>
        </form>
    </div>




    <?php require_once 'includes/footer.php' ?>

</body>

</html>