<?php include("blocs/header.php"); ?>
<link href="CSS/index.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/index.css" rel="stylesheet">
    <title>Agora Francia</title>
</head>
<body>

<!--<div class="bandeau"> 
<img src="./CSS/images/bandeau.jpg" alt="Image description" id="banniere">
        <div class="txtBaniere"> Les ventes flash de Noël sont là ! </div>
    </div>-->
    
    <div class="selection">
        
        <div class="titreSelection">Découvrez nos catégories</div>
        
        <div class="choix">
        Mode achat immédiat
        </div>
        <div class="choix">
            Mode négociation
        </div>
        <div class="choix">
            Mode enchère
        </div>
    </div>


    <?php
    $sql = "SELECT * FROM (SELECT * FROM articles ORDER BY id DESC LIMIT 3) AS latest_articles";
    $result = mysqli_query($db_handle, $sql);
    $products = []; // Initialisation du tableau
    
    if ($result) {
        // Compter le nombre de lignes et traiter les résultats
        $num_rows = mysqli_num_rows($result);
    
        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Utiliser l'ID de l'article comme clé unique
                $products[$row['id']] = [
                    "image" => $row["img1"],
                    "name" => htmlspecialchars($row["titre"]), // Assurez-vous que le nom de la colonne est correct
                    "price" => htmlspecialchars($row["prix"]),
                    "description" => htmlspecialchars($row["description"])
                ];
            }
        }
    }
    
    ?>
    <div class="carousel">

    <div class="personnal-info" id = "une"> 
            <div class="titreMain">A la une !</div>
        </div>
        <div class="carousel-inner">
            <?php
            foreach ($products as $index => $product) {
                echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
                echo '<div class="article-colG col">';
                echo '    <div class="prodG">';
                echo '        <img src="' . $product["image"] . '" alt="Image produit" class="imgProd">';
                echo '    </div>';
                echo '    <div class="infoProd">';
                echo '        <h2>' . $product["name"] . '</h2>';
                echo '        <h2>Prix: ' . $product["price"] . ' €</h2>';
                echo '        <div class="Prod">' . $product["description"] . '</div>';
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

    <div class="personnal-info" id="about-section">
        <div class="titreMain">Qui sommes-nous ?</div>
    </div>

    <div class="article-colG col">
        <div class="presentation">
            <h1>Bienvenue sur Agora Francia !</h1>
            <p>Inspiré par l'esprit du marché grec antique, l'Agora Græcia, nous sommes ravis de vous présenter notre plateforme de magasinage en ligne, "Agora Francia". Conçu pour le grand public, notre site offre une expérience d'achat unique et enrichissante, adaptée à tous vos besoins.</p>
            
            <h4>Découvrez nos options de vente :</h4>
            <h3>1. Vente immédiate :</h3>
            <p>Parcourez notre sélection d'articles et achetez en toute simplicité. Lorsque vous trouvez un article qui vous plaît, ajoutez-le à votre panier et finalisez votre achat. C'est rapide et facile !</p>

            <h3>2. Vente par négociation :</h3>
            <p>Certains articles, comme des objets d'occasion ou présentant de légers défauts, peuvent être proposés à un prix initial avec la possibilité pour l'acheteur de négocier. Cette fonctionnalité vous permet de trouver le juste prix qui satisfait à la fois le vendeur et vous-même.</p>

            <h3>3. Vente par meilleure offre :</h3>
            <p>Pour les articles rares ou très demandés, nous offrons la possibilité de faire votre meilleure offre. L'article sera vendu à l'acheteur qui propose le montant le plus élevé, garantissant ainsi que vous obtenez la valeur que vous recherchez.</p>

            <h4>Fonctionnalités supplémentaires :</h4>
            <p><strong>Compte vendeur :</strong> Pour vendre vos propres articles sur Agora Francia, il vous suffit de demander l'autorisation à notre équipe d'administrateurs. Une fois approuvé, vous pourrez lister vos produits et les proposer à notre communauté d'acheteurs.</p>
            <p><strong>Compte acheteur :</strong> Tout le monde peut créer un compte acheteur gratuitement. Parcourez les articles disponibles, participez aux négociations et faites vos offres sur des articles uniques.</p>

            <h4>Notre engagement :</h4>
            <p>Agora Francia est supervisé par une équipe dédiée d'administrateurs qui assurent le bon fonctionnement du site et la sécurité des transactions. Notre objectif est de créer un environnement de magasinage convivial et fiable, où chaque membre peut profiter d'une expérience d'achat exceptionnelle.</p>

            <p>Rejoignez-nous dès aujourd'hui et découvrez une nouvelle façon de faire vos achats en ligne. Bienvenue sur Agora Francia, où l'esprit de l'Agora antique rencontre la modernité du commerce en ligne.</p>

            <p><strong>L'équipe Agora Francia</strong></p>
        </div>
    </div>
    
    <div class="article-colG col">
        <div class="presentation">
        <h1>Nous Contacter</h1>
        <p>Chez Agora Francia, nous sommes toujours là pour vous aider et répondre à vos questions. Que vous ayez besoin d'assistance avec une commande, que vous souhaitiez en savoir plus sur nos services ou que vous ayez des suggestions à nous faire, n'hésitez pas à nous contacter.</p>
        
        <h4>Coordonnées :</h4>
        <p><strong>Adresse :</strong> 00 rue du Petit Pont, Paris 75015, France</p>
        <p><strong>Téléphone :</strong> +33 6 00 00 00 00</p>
        <p><strong>Email :</strong> <a href="mailto:contact@agorafrancia.fr">contact@agorafrancia.fr</a></p>
        
        <p>Nous nous engageons à répondre à vos messages dans les plus brefs délais et à vous fournir le meilleur service possible.</p>
        
        <p><strong>L'équipe Agora Francia</strong></p>
        </div>
        <div class="carte">
            <iframe width="425" height="425" id="carte" src="https://www.openstreetmap.org/export/embed.html?bbox=2.286642193794251%2C48.85065355186168%2C2.289466559886933%2C48.852146684017626&amp;layer=mapnik" style="border: 1px solid black"></iframe>
            <br><small><a href="https://www.openstreetmap.org/#map=19/48.85140/2.28805">Notre localisation</a></small>
        </div>
    </div>

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
