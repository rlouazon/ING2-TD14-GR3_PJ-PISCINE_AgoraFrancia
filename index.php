<?php include("blocs/header.php"); ?>
<link href="CSS/index.css" rel="stylesheet">
<body>
    <p>  
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada rhoncus leo id porttitor. Curabitur quis massa odio. Cras pulvinar leo quis sagittis maximus. Aenean sed purus arcu. Phasellus sit amet venenatis arcu. Phasellus at tortor dui. 
    <br>Donec convallis magna quis arcu cursus euismod. Cras tristique ipsum vel massa efficitur, ac mattis diam suscipit. Phasellus laoreet lobortis tortor, et vehicula nunc fermentum pellentesque. Sed rutrum volutpat neque eget aliquet. 
    <br>Pellentesque finibus leo id mauris blandit sollicitudin. Nam malesuada efficitur purus, ut tincidunt ante. Fusce bibendum, orci sed sagittis ultrices, tortor arcu vehicula arcu, ornare consequat tortor ipsum sit amet libero. 
    <br>Nam tempor viverra nunc ut tristique. Vestibulum dignissim augue venenatis magna viverra, in aliquet eros pharetra. Curabitur non lectus condimentum nulla dapibus venenatis.
    </p>
    
    <div class="personnal-info" id = "une"> 
        <div class="titreMain">A la une !</div>
    </div> 
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
                    "image" => "CSS/images/produit2.png",
                    "name" => "Nom du produit 2",
                    "price" => "0000",
                    "description" => "Description du produit 2"
                ],
                [
                    "image" => "CSS/images/produit3.png",
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
                echo '    </div>';
                echo '    <div class="infoProd">';
                echo '        <h2>' . $product["name"] . '</h2>';
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
        <button class="prev" onclick="moveCarousel(-1)"><</button>
        <button class="next" onclick="moveCarousel(1)">></button>
    </div>

    <iframe width="425" height="200" src="https://www.openstreetmap.org/export/embed.html?bbox=2.286642193794251%2C48.85065355186168%2C2.289466559886933%2C48.852146684017626&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=19/48.85140/2.28805">Afficher une carte plus grande</a></small>

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
