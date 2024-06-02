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
/*
Stockage !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="centre">
    <form method="post" enctype="multipart/form-data"class="p-5">
        <div class="form-group">
                <label for="titre">Titre* :</label>
                <input type="text" class="form-control" name="titre" maxlength="256" required>
        </div>
        <div class="form-group">
            <label>rareté :</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="1" name="1" value="1">
                <label class="form-check-label" for="1">Articles hautes de gamme</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="2" name="2" value="2">
                <label class="form-check-label" for="2">Articles réguliers</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="0" name="0" value="0">
                <label class="form-check-label" for="0">Articles rares</label>
            </div>
        </div>

        <div class="form-group">
            <label>rareté :</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="vd" name="vd" value="vd">
                <label class="form-check-label" for="vd">Vente directe</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="enchere" name="enchere" value="enchere">
                <label class="form-check-label" for="enchere">Enchère</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="nego" name="nego" value="nego">
                <label class="form-check-label" for="nego">Vente négociation</label>
            </div>
        </div>
        

        <div class="form-group">
            <label for="prix">Prix* :</label>
            <div class="row">
                 <div class="col">
                    <input type="number" class="form-control" name="prix bas" placeholder="Prix bas" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="prix haut" placeholder="Prix haut" required>
                </div>
                
            </div>
        </div>
        <button type="submit" name="Inscription" class="btn">Enregistrer    <img src="CSS/images/inscription.png" alt="logo" class="imgInscription"></button>
    </form>
</div>
<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $titre = $_POST["titre"];
    $rare = isset($_POST["0"]) ? $_POST["0"] : 0;
    $haut_de_gamme = isset($_POST["1"]) ? $_POST["1"] : 0;
    $reguliers = isset($_POST["2"]) ? $_POST["2"] : 0;
    $vd = isset($_POST["vd"]) ? $_POST["vd"] : 0;
    $enchere = isset($_POST["enchere"]) ? $_POST["enchere"] : 0;
    $nego = isset($_POST["nego"]) ? $_POST["nego"] : 0;
    $prix_bas = $_POST["prix_bas"];
    $prix_haut = $_POST["prix_haut"];

    // Afficher les valeurs récupérées
    echo "Titre : " . $titre . "<br>";
    echo "Rareté - Articles rares : " . $rare . "<br>";
    echo "Rareté - Articles haut de gamme : " . $haut_de_gamme . "<br>";
    echo "Rareté - Articles réguliers : " . $reguliers . "<br>";
    echo "Type de vente - Vente directe : " . $vd . "<br>";
    echo "Type de vente - Enchère : " . $enchere . "<br>";
    echo "Type de vente - Vente négociation : " . $nego . "<br>";
    echo "Prix bas : " . $prix_bas . "<br>";
    echo "Prix haut : " . $prix_haut . "<br>";
    $vdsql=0;
    $encheresql=0;
    $negosql=0;
    if ($vd =="vd"){
        $vdsql=1;
    }
    if ($enchere =="enchere"){
        $encheresql=1;
    }
    if ($nego =="nego"){
        $negosql=1;
    }


    $titre = mysqli_real_escape_string($db_handle, $titre);
    $rare = mysqli_real_escape_string($db_handle, $rare);
    $haut_de_gamme = mysqli_real_escape_string($db_handle, $haut_de_gamme);
    $reguliers = mysqli_real_escape_string($db_handle, $reguliers);
    $vd = mysqli_real_escape_string($db_handle, $vd);
    $nego = mysqli_real_escape_string($db_handle, $nego);
    $enchere = mysqli_real_escape_string($db_handle, $enchere);
    $prix_bas = mysqli_real_escape_string($db_handle, $prix_bas);
    $prix_haut = mysqli_real_escape_string($db_handle, $prix_haut);
    $logged = mysqli_real_escape_string($db_handle, $logged);
    
    $sql = "UPDATE utilisateurs SET notification = '" . base64_encode("SELECT * FROM '" .base64_encode("SELECT * FROM articles ORDER BY id DESC LIMIT 5")."' AS latest_articles WHERE titre = " . $titre. " AND (categorie = " .$rare. " OR categorie = " .$haut_de_gamme. " OR categorie = " . $reguliers. ") AND (type_vd = ". $vdsql. " OR type_nego = " . $negosql . " OR type_enchere = " . $encheresql. ") AND (prix > " . $prix_bas. " AND prix < " .$prix_haut) . "' WHERE id = " . $logged;
    //echo $sql;
// Exécution de la requête
$result = mysqli_query($db_handle, $sql);

// Vérification des erreurs
if (!$result) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($db_handle));
}
}
?>
<?php include("blocs/footer.php"); ?>
*/ 


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
    ?> </div>


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