<?php include("blocs/header.php"); ?>
<link href="CSS/index.css" rel="stylesheet">
<body>
    <p>
        Bienvenue sur Agora Francia ! 
        <br>Ce site est une platforme de vente d'objet de particuliers à particuliers.
        <br>3 types de ventes sont disponibles : 
        <ul>
            <li>
                Vente directe : obtenez immédiatement les articles rares ou recherchés sans trop de blabla !
            </li>
            <li>
                Négociation : Proposez un nouveaux prix au vendeur pour son article, dans la limite de 5 essais par objets
            </li>
            <li>
                Enchères : Participez aux enchères sur un produit convoité ! Saisissez le montant maximal que vous souhaitez payer 
                et nous nous chargeons du reste.
            </li>
        </ul>
        <br>Pourquoi ne pas également être vendeur ! Rejoignez des centaines de membres qui font activement vivre ce site et cette communautée. 
        <br>Pour cela, contactez l'administrateur et mettez en vente vos premiers articles ! 
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
