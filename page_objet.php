<?php include("blocs/header.php"); ?>
<link href="CSS/pag_objet.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/page_objet.css" rel="stylesheet">
    <title>Agora Francia</title>
</head>
<body>

    <div class="personnal-info" id = "une"> 
        <div class="titreMain">Titre du produit</div>
    </div>
    
    <div class="carousel">
        <div class="carousel-inner">
            <?php
            $products = [
                ["image" => "CSS/images/produit3.png", "name" => "Nom du produit 1", "price" => "0000", "description" => "Description du produit 1"],
                ["image" => "CSS/images/produit2.png", "name" => "Nom du produit 2", "price" => "0000", "description" => "Description du produit 2"],
                ["image" => "CSS/images/produit.png", "name" => "Nom du produit 3", "price" => "0000", "description" => "Description du produit 3"]
            ];

            foreach ($products as $index => $product) {
                echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
                echo '        <img src="' . $product["image"] . '" alt="Image produit" class="imgProd">';
                echo '</div>';
            }
            ?>
            <div class = "descriptionProd">
                <h1>Titre du produit</h1>
                <h3>Description : Voici une belle description ! Q'ils sont jolis ces mots ! </h3>
                <h5>Prix : 22,22 €</h5>
                <h5>Limite de temps : 3j3h6min.</h5>
                <h6> Vendeur : Greg </h6>
                <h6> Etat : Très bon état </h6>
                <h6> Catégorie : Occasion </h6>
                <h6> Type de vente : Enchère </h6>
            </div>
        </div>
        <button class="prev" onclick="moveCarousel(-1)"><</button>
        <button class="next" onclick="moveCarousel(1)">></button>
    </div>

    <div class="col" id="achat">
       dq
    </div>
    <p>
        
    </p>

    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;
        const interval = 5000;

        function moveCarousel(direction) {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + direction + totalItems) % totalItems;
            items[currentIndex].classList.add('active');
        }

        setInterval(() => {
            moveCarousel(1);
        }, interval);
    </script>

<?php include("blocs/footer.php"); ?>
