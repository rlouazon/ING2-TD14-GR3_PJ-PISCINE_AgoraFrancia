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
    </p>
    
<?php

if($type_compte == 1 || $type_compte == 2){

    if($type_compte == 2){
        ?> <div class="colonneGauche"> <?php ;
        $requete = "SELECT * FROM articles";
    }
    else{
        $requete = "SELECT * FROM articles WHERE vendeur = " . intval($id);
    }
    $result = mysqli_query($db_handle, $requete);
    while ($data = mysqli_fetch_assoc($result)) {
        #ID VENDEUR
        $id_article =       $data['id'];
        $vendeur =          $data['vendeur'];

        #INFOS
        $titre =            $data['titre'];
        $prix =             $data['prix'];
        $description =      $data['description'];
        $categorie =        $data['categorie'];
        $etat =             $data['etat'];

        #TYPES
        $type_vd =          $data['type_vd'];
        $type_nego =        $data['type_nego'];
        $type_enchere =     $data['type_enchere'];

        #IMG
        $img1 =             $data['img1'];
        $img2 =             $data['img2'];
        $img3 =             $data['img3'];
        $img4 =             $data['img4'];
        $img5 =             $data['img5'];

        #FIN
        $fin =              $data['fin'];

        $types = [$type_vd, $type_nego, $type_enchere];
        $types_string = ["Vente directe", "Negociation", "Enchere"];

        for($i = 0; $i < count($types); $i++){
            if(intval($types[$i]) == 1){
                ?>
            
                    <form class="article-colG col" method="post">
                        <div class="prodG">
                            <img src="<?php echo $img1 ?>" alt="Image produit" class="imgProd">
                            <h2><a href="<?php echo 'articles.php?article='.$id_article.'&type='.$i;?>"><?php echo $titre . "<br>" . " (" . $types_string[$i] . ")" ?></a></h2>
                        </div>
                        <div class="infoProd">
                            <h2>Prix : <?php echo $prix ?>€</h2>
                                <div class="Prod">
                                    <?php echo $description ?>
                                </div>
                            <input type="hidden" name="id-type_article" value="<?php echo $id_article."-".$i; ?>" />
                            <button type="submit" name="Suppression_article" class="delete-button">Supprimer l'article</button>
                        </div>
                    </form>
                                   
                <?php
            }
        }
    }
    if($type_compte == 2){?> </div> <?php ;}

}


if($type_compte == 2){

    ?> <div class="colonneDroite"> <?php
    $requete = "SELECT * FROM utilisateurs";
    $result = mysqli_query($db_handle, $requete);
    while ($data = mysqli_fetch_assoc($result)) {
        #ID
        $id =           $data['id'];
        $type =         $data['type'];

        #INFO PERSO
        $pseudo =       $data['pseudo'];
        $nom =          $data['nom'];
        $prenom =       $data['prenom'];
        $mail =         $data['mail'];
        $tel =          $data['tel'];

        #BANQUE
        $bank_type =    $data['bank_type'];
        $bank_carte =   $data['bank_carte'];
        $bank_nom =     $data['bank_nom'];
        $bank_date =    $data['bank_date'];

        #ADDRESSE
        $addr1 =        $data['addr1'];
        $addr2 =        $data['addr2'];
        $ville =        $data['ville'];
        $codepostal =   $data['codepostal'];
        $pays =         $data['pays'];

        #IMAGES
        $photo =        $data['photo'];
        $back =         $data['back'];

            ?>
            
                <form class="article-colD col" method="post">
                    <div class="prodG">
                        <img src="<?php echo $photo; ?>" alt="Image client" class="imgClient">
                        <h2><?php echo $prenom . " " . $nom; ?></h2>
                    </div>
                </form>
            
            <?php
        }
    }
    ?> </div> <?php

?>
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
