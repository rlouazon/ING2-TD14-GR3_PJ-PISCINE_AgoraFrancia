<?php include("blocs/header.php"); ?>
<link href="CSS/index.css" rel="stylesheet">

<body>
    <div class="carousel">
        <div class="carousel-inner">
            <?php
            // Tableau contenant les informations sur les produits
            $products = [
                [
                    "image" => "CSS/images/produit.png",
                    "name" => "Nom du produit 1",
                    "price" => "0000",
                    "description" => "Description du produit 1"
                ],
                [
                    "image" => "CSS/images/produit.png",
                    "name" => "Nom du produit 2",
                    "price" => "0000",
                    "description" => "Description du produit 2"
                ],
                [
                    "image" => "CSS/images/produit.png",
                    "name" => "Nom du produit 3",
                    "price" => "0000",
                    "description" => "Description du produit 3"
                ]
            ];

            foreach ($products as $index => $product) {
                echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';

                // Contenu du produit
                echo '<div class="article-colG col">';
                echo '    <div class="prodG">';
                echo '        <img src="' . $product["image"] . '" alt="Image produit" class="imgProd">';
                echo '        <h2>' . $product["name"] . '</h2>';
                echo '    </div>';
                echo '    <div class="infoProd">';
                echo '        <h2>Prix: ' . $product["price"] . ' €</h2>';
                echo '        <div class="Prod">';
                echo '            ' . $product["description"];
                echo '        </div>';
                echo '        <button class="validation-button">Ajouter au panier l\'article</button>';
                echo '    </div>';
                echo '</div>';

                echo '</div>';
            }
            ?>
        </div>
        <button class="prev" onclick="moveCarousel(-1)">&#10094;</button>
        <button class="next" onclick="moveCarousel(1)">&#10095;</button>
    </div>

    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;
        const interval = 5000; // Durée de l'intervalle en millisecondes (5 secondes)

        // Fonction pour changer la diapositive du carrousel
        function moveCarousel(direction) {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + direction + totalItems) % totalItems;
            items[currentIndex].classList.add('active');
        }

        // Rotation automatique du carrousel
        setInterval(() => {
            moveCarousel(1);
        }, interval);
    </script>
</body>

<?php include("blocs/footer.php"); ?>
