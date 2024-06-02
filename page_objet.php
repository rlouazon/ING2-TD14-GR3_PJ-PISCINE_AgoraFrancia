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
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu lectus non metus pellentesque euismod a in lacus. 
        Donec sit amet dui bibendum, hendrerit metus at, congue mauris. Praesent vehicula quis dui nec iaculis. 
        Proin accumsan libero risus, eleifend ultrices nibh fermentum eu. Nulla ac maximus felis. Nunc efficitur tristique faucibus. 
        In at tristique turpis, in volutpat eros. Nam iaculis, ipsum ut sollicitudin sodales, nibh orci tincidunt ligula, a tempor sapien 
        quam sed risus. Curabitur cursus eget dolor sed mattis.
        Morbi aliquet dignissim eros, et faucibus tellus faucibus sed. Nulla facilisi. Sed pulvinar ex sit amet ipsum consequat tempus. 
        Nam lorem neque, porta nec posuere vitae, fermentum eget arcu. Sed hendrerit tristique viverra. Cras ut enim urna. Donec urna diam, 
        hendrerit ut tempus eu, luctus quis purus. Phasellus quis arcu a metus lacinia finibus sit amet non magna. Vestibulum in arcu ultrices,
         mattis lacus eu, lobortis ligula. Integer vel gravida ante. Praesent condimentum magna maximus ullamcorper mollis. 
         Praesent laoreet arcu vitae massa pharetra, sed congue orci feugiat. Nulla venenatis turpis a hendrerit elementum. Sed eu sodales augue. 
         Phasellus bibendum nisi nec hendrerit egestas. Nam volutpat lacinia nisl id semper.
        Sed risus nisl, condimentum in purus sit amet, laoreet cursus dolor. Ut lacinia est quis augue venenatis elementum. Suspendisse et 
        tincidunt lorem. Nunc quis est ut velit facilisis condimentum ut non neque. Curabitur bibendum ex at dignissim iaculis. Donec a nibh 
        vehicula, posuere tortor sit amet, dictum est. Integer ac efficitur lorem. Donec ut augue rutrum, lacinia velit ut, lacinia est. 
        Fusce a porta justo. Nam placerat ultricies metus. In eleifend augue a euismod tempor. Aenean nec libero porta, fermentum velit a, 
        dictum libero.
        Nam eu neque eget mi facilisis pretium. Nullam blandit lacus sed luctus mattis. Praesent diam felis, fringilla eget nisl non, 
        placerat scelerisque nulla. Quisque blandit tellus risus, eget dictum eros pharetra a. Ut interdum metus id lacus sodales, 
        quis vehicula ante tristique. Cras nunc lectus, euismod non libero non, luctus accumsan mauris. Suspendisse id est quis metus 
        faucibus dapibus. Vestibulum auctor elementum magna, eu ultrices sapien vestibulum ut. Donec eleifend placerat justo vitae pretium. 
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis gravida arcu, vitae malesuada diam.
        Etiam sit amet eros vel turpis finibus sollicitudin. Duis eget massa in enim efficitur finibus. Nam in ligula quis nisl fringilla cursus. 
        Cras dictum tincidunt magna, vitae lacinia nulla maximus pretium. Aenean faucibus magna a turpis dignissim, nec pellentesque mauris 
        rutrum. Morbi consequat, metus id scelerisque ultricies, metus est hendrerit lorem, nec finibus leo tortor sit amet ligula. 
        Aenean et diam non sem. 
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
