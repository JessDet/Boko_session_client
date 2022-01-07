<?php

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
    

<?php require_once'includes/header.php' ?>
    
        <nav class="btn--return">
            <a href="06b-Recettes.php"><img src="Icons/btn-return-fb.png" alt="return" id="btn-return" width="200px"></a>
        </nav>



<main>
    

    <div class="info_recipe">
        <h1>Les pickles de legumes</h1>
        <pre>Les pickles de légumes apportent une touche d’originalité à vos plats.
        
Avec leur petit goût acidulé, ces petits condiments sont parfaits pour donner une touche de pep’s et de 
couleur dans une salade, un bowl, un sandwich ou à grignoter à l’apéritif entre amis avec un peu de
fromage frais ou de houmous.

Faire des pickles est simple et rapide et nécessite peu d’ingrédients.

Cette recette de base permet de réaliser toute sorte de pickles différents avec de nombreux légumes : 
céleri rave, fenouil, carotte, choux rouge, oignon, choux-fleur, cornichon, radis noir, concombre, courgette, 
navet, betterave…</pre>

    </div>

<div class="container-recipe-global">
    <div class="container-recipe-ingredient">
        <div class="recipe">
            <h2>Recette</h2>
            <div class="deroul-recipe">
                <div class="time-prepa">
                    <img src="Icons/hourglass_icon_178153.png" alt="" id="icon-recipe" width="40px">
                    <p>Préparation : <strong>20 minutes</strong></p></div>
                <div class="difficult">
                    <img src="Icons/leaf_icon-icons.com_48277.png" alt="icon-recipe" width="40px">
                    <p>difficulté : <strong>facile</strong></p></div>
                <div class="price">
                    <img src="Icons/etiquette-tn---2.png" alt="icon-recipe" width="40px">
                    <p>Budget : <strong>peu élevé</strong></p></div>

            </div>
        </div>


        <div class="ingredient">
            <h2>Ingrédients</h2>
            <div class="list-ingredients">
                <pre>
- Légumes bio
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
            <h2>Préparation</h2>
            <div class="txt_deroule_prepa">
                <pre>
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
                </pre>
            </div>
        </div>
    </div>
</div>









</main>

<div class="content">
            <div class="block p-20 form-container">
                <h1><?= $id ? "Modifier " : "Ecrire " ?>un commentaire</h1>
                <form action="/addAnArticle.php<?= $id ? "?id=$id" : '' ?>" method="POST">
                    <div class="form-control">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" value="<?= $title ?? '' ?>">
                        <p class="text-error"><?= $errors['title']?></p>
                    </div>
                    <div class="form-control">
                        <label for="category">Catégorie</label>
                        <select name="category" id="category">
                        <option <?= !$category || $category ==="movie" ? 'selected' : '' ?> value="movie">Cinema</option>
                        <option <?= $category ==="music" ? 'selected' : '' ?> value="music">Musique</option>
                        <option  <?= $category ==="serie" ? 'selected' : '' ?> value="serie">Série</option>
                       </select>
                        <p class="text-error"><?= $errors['category']?></p>
                    </div>
                    <div class="form-control">
                        <label for="content">Content</label>
                        <textarea name="content" id="content"><?= $content ?? '' ?></textarea>
                        <p class="text-error"><?= $errors['content']?></p>
                    </div>
                    <div class="form-action">
                        <a href="/" class="btn btn-secondary" type="button">Annuler</a>
                        <button class="btn btn-primary"><?= $id ? 'Modifier' : 'Sauvegarder' ?></button>
                    </div>
                </form>
            </div>
        </div>

   

<?php require_once'includes/footer.php' ?>

</body>
</html>