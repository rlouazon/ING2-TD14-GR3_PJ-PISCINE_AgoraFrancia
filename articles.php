<?php include("blocs/header.php"); ?>
<link href="CSS/page_objet.css" rel="stylesheet">

<?php

$article = 0;
if(isset($_GET["article"])){
    if($_GET["article"] != ""){
        $article = intval($_GET["article"]);
    }
}
$type_article = -1;
if(isset($_GET["type"])){
    if($_GET["type"] != ""){
        $type_article = intval($_GET["type"]);
    }
}

$requete = "SELECT * FROM articles WHERE id = \"" . intval($article) . "\"";
$result = mysqli_query($db_handle, $requete);
$occ = 0;
while ($data = mysqli_fetch_assoc($result)) {
    #ID VENDEUR
    $vendeur = $data['vendeur'];

    #INFOS
    $titre =            $data['titre'];
    $prix =             $data['prix'];
    $description =      $data['description'];
    $categorie =        intval($data['categorie']);
    $etat =             $data['etat'];

    #TYPES
    $type_vd =          intval($data['type_vd']);
    $type_nego =        intval($data['type_nego']);
    $type_enchere =     intval($data['type_enchere']);

    #IMG
    $img1 =             $data['img1'];
    $img2 =             $data['img2'];
    $img3 =             $data['img3'];
    $img4 =             $data['img4'];
    $img5 =             $data['img5'];

    #FIN
    $fin =              $data['fin'];

    #LIMITES
    $limite_tps =       $data['limite_tps'];
    $limite_op =        $data['limite_op'];

    $occ += 1;
}


# Si :
#  - Pas dans la bdd ou plusieurs (bug)
#  - Si pas de type indiqué (empeche de gerer le multi type)
#  - Si le type ne correspond pas a un de ceux de la bdd (modif manuelle de l'utilisateur ~ triche)
#  - Si l'annonce est échue
if($occ != 1   ||   $type_article == -1   ||   ((($type_article == 0) == intval($type_vd)) && (($type_article == 1) == intval($type_nego)) && (($type_article == 2) == intval($type_enchere))) == 0   ||   $fin == 1){
    echo "<script>setTimeout(() => window.location.replace(\"index.php\"), 0);</script>";
}

?>


<div class="personnal-info" id = "une"> 
        <div class="titreMain"><?php echo $titre ?></div>
    </div>
    
    <div class="carousel">
        <div class="carousel-inner">
            <?php

            $products = [];
            if($img1 != ""){$products[] = ["image" => $img1];}
            if($img2 != ""){$products[] = ["image" => $img2];}
            if($img3 != ""){$products[] = ["image" => $img3];}
            if($img4 != ""){$products[] = ["image" => $img4];}
            if($img5 != ""){$products[] = ["image" => $img5];}

            foreach ($products as $index => $product) {
                echo '<div class="carousel-item' . ($index === 0 ? ' active' : '') . '">';
                echo '        <img src="' . $product["image"] . '" alt="Image produit" class="imgProd">';
                echo '</div>';
            }

            $categorie_article = "";
            if($categorie == 0){$categorie_article = "Rare";}
            if($categorie == 1){$categorie_article = "Haut de Gamme";}
            if($categorie == 2){$categorie_article = "Régulier";}

            $etat_article = "";
            if($etat == 'n'){$etat_article = "Neuf";}
            if($etat == 'cn'){$etat_article = "Comme Neuf";}
            if($etat == 'be'){$etat_article = "Bon Etat";}
            if($etat == 'abe'){$etat_article = "Assez Bon Etat";}

            $type_affichage_article = "";
            if($type_vd == 1){$type_affichage_article = "Vente Directe";}
            if($type_nego == 1){$type_affichage_article = "Vente par Négociation";}
            if($type_enchere == 1){$type_affichage_article = "Vente par Enchere";}
            ?>
            <div class = "descriptionProd">
                <h1><?php echo $titre ?></h1>
                <h3><div class="naming">Description : </div> <?php echo $description ?></h3>
                <div class="prix">Prix : <?php echo $prix ?>€</div>
                <?php if($type_enchere == 1){ ?> <h5>Date limite : <?php echo $limite_tps ?></h5> <?php ;} ?>
                <div class="sousCategorie">
                    <h6>Etat : <?php echo $etat_article ?> </h6>
                    <h6>Catégorie : <?php echo $categorie_article ?> </h6>
                    <h6>Type de vente : <?php echo $type_affichage_article ?> </h6>
                <div>
            </div>
        </div>
        <button class="prev" onclick="moveCarousel(-1)"><</button>
        <button class="next" onclick="moveCarousel(1)">></button>
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

<div class="col">
<?php

    $condition = 0;
    $id_panier = 0;
    if($logged != 0){
        $requete = "SELECT * FROM panier WHERE acheteur = " . $logged . " AND article = " . $article . " AND type = " . $type_article;
        $result = mysqli_query($db_handle, $requete);
        $occ = 0;
        while ($data = mysqli_fetch_assoc($result)) {
            $occ += 1;
            $id_panier = (int)$data['id'];
        }
        if($occ == 1){
            $condition = 1;
        }
        $requete = "SELECT * FROM articles WHERE id = " . $article . " AND vendeur = " . $logged;
        $result = mysqli_query($db_handle, $requete);
        $occ = 0;
        while ($data = mysqli_fetch_assoc($result)) {
            $occ += 1;
        }
        if($occ == 1){
            $condition = 2;
        }
    }
    if($condition == 0){
        ?>
            <form method="post">
                <h1><button type="submit" class="panier-ajouter" name="AjouterPanier" class="btn">Ajouter au Panier</button></h1>
            </form>
        <?php
    }
    else if($condition == 1){

        if($type_article == 0){
            ?> <p class="textPanier">Produit déjà ajouté au panier <a class="textPanier" href="panier.php" id="voirPanier">(Voir mon panier)</a></p> <?php
        }
        else if($type_article == 1){
            # Detection du prix max
            $requete = "SELECT * FROM articles WHERE id = " . $article . " AND type_nego = " . $type_article;
            $result = mysqli_query($db_handle, $requete);
            $occ = 0;
            $borne_max = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $borne_max = intval($data['prix']);
                $occ += 1;
            }
            if($occ == 1){
                
                # 6 de 0 à 5
                $requete = "SELECT * FROM op_nego WHERE article = " . $article . " ORDER BY nb_op ASC";
                $result = mysqli_query($db_handle, $requete);
                $occ = 0;
                $fin_nego = 0;
                $user_nego = -1;
                echo "<div class=\"nego-offres\">";
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<p class=\"nego-offre\">";
                    $occ += 1;
                    echo ($occ%2 == 1) ?  "Acheteur : " : "Vendeur : ";
                    echo $data['prix'] . "€";
                    $fin_nego = intval($data['fin']);
                    if($fin_nego){echo " (Validé)";}
                    $user_nego = intval($data['acheteur']);
                    echo "</p>";
                }
                echo "</div>";
                echo "<div class=\"nego-compteur\">Négociation : " . ($occ) . "/" . 5 . "</div>";
                if(!($user_nego == -1 || $user_nego == $logged)){$fin_nego = 1;}
                echo "</p>";
                if($occ >= 6){
                    $requete = "UPDATE op_nego SET fin = 1 WHERE article = " . $article . " AND acheteur = " . $logged . " AND nb_op = 5";
                    $result = mysqli_query($db_handle, $requete);
                    $fin_nego = 1;
                }
                ?>
                    <form method="post">
                    
                    <div class="choixNego">
                        <button type="submit" class="nego-refuser" name="RefuserNego" class="btn"            <?php if($fin_nego == 1 || $occ%2 == 1){echo "disabled";} ?>>Proposer une contre offre</button>
                        <input type="hidden" name="occ" value="<?php echo ($occ); ?>"> 
                        <input type="number" class="nego-input" name="prix" max="<?php echo $borne_max ?>" <?php if($fin_nego == 1 || $occ%2 == 1){echo "disabled";} ?>> 
                        <button type="submit" class="nego-accepter" name="AccepterNego" class="btn"           <?php if($fin_nego == 1 || $occ%2 == 1){echo "disabled";} ?>>Accepter (Mettre fin a la négociation)</button>
                    </div>
                    </form>
                <?php
            }
        }
        else if($type_article == 2){
            $borne_min = -1;
            $message = "";
            $condition = 0;
            # Detection d'une enchere deja déposée'
            $requete = "SELECT * FROM op_enchere WHERE article = " . $article . " AND acheteur = " . $logged;
            $result = mysqli_query($db_handle, $requete);
            $occ = 0;
            $prix = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $prix = $data['prix'];
                $occ += 1;
            }

            # Si enchere/pas déposée
            if($occ == 1){
                $message = "Enchere déposée (" . $prix . "€)";
            }
            else{
                # Detection du prix minimum et de la date limite
                $requete = "SELECT * FROM articles WHERE id = " . $article;
                $result = mysqli_query($db_handle, $requete);
                $occ = 0;
                $datelimite = "";
                while ($data = mysqli_fetch_assoc($result)) {
                    $datelimite = date('Y-m-d H:i:s', strtotime($data['limite_tps']));
                    $borne_min = $data['prix'];
                    $occ += 1;
                }


                # Detection de l'enchere a déposer
                $borne_average = $borne_min - 1;
                $id_plus_haut = 0;
                $requete = "SELECT * FROM op_enchere WHERE article = " . $article;
                $result = mysqli_query($db_handle, $requete);
                while ($data = mysqli_fetch_assoc($result)) {
                    $borne_average = ($borne_average < intval($data['prix'])) ? $data['prix'] : $borne_average;
                    $id_plus_haut = ($borne_average < intval($data['prix'])) ? intval($data['acheteur']) : $id_plus_haut;
                }


                # Si conditions respectées encherir
                if($occ == 1){
                    if(date("Y-m-d H:i:s") < $datelimite){
                        $message = "Encherir";
                        $condition = 1;
                    }
                    else{
                        $message = "Date de fin d'enchere dépassée";
                        if($id_plus_haut == 0){
                            $message = $message . " (Aucun participant)";
                        }
                        else{
                            $requete = "SELECT * FROM utilisateurs WHERE id = " . $id_plus_haut;
                            $result = mysqli_query($db_handle, $requete);
                            $user = "";
                            $occ = 0;
                            while ($data = mysqli_fetch_assoc($result)) {
                                $user = $data['pseudo'];
                                $occ += 1;
                            }
                            $message = $message . " (".$user.")";
                        }
                    }
                }
                else{
                    $message = "Date de fin d'enchere non trouvée";
                }
            }
            ?>
                <form method="post">
                <h1>
                    <p class="enchere-reco"><?php echo ($condition == 1) ? "Recommandation : " .  ($borne_average + 1) . "€" : "" ?></p>
                    <input type="number" class="enchere-prix" name="prix" <?php echo "min=\"". $borne_min . "\"" ?><?php if($condition == 0){echo "disabled";} ?>> 
                    <button class="enchere-envoyer" type="submit" name="Encherir" class="btn" <?php if($condition == 0){echo "disabled";} ?>><?php echo $message ?></button>
                </h1>
                </form>
            <?php 
            
        }


    }
    else if($condition == 2){
        ?> <p class="info-proprio">Vous êtes propriétaire de l'offre</p> <?php
        if($type_article == 0){
            
        }
        else if($type_article == 1){
            # Detection du prix max
            $requete = "SELECT * FROM articles WHERE id = " . $article . " AND type_nego = " . $type_article;
            $result = mysqli_query($db_handle, $requete);
            $occ = 0;
            $borne_max = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $borne_max = intval($data['prix']);
                $occ += 1;
            }
            if($occ == 1){
                
                # 6 de 0 à 5
                $requete = "SELECT * FROM op_nego WHERE article = " . $article . " ORDER BY nb_op ASC";
                $result = mysqli_query($db_handle, $requete);
                $occ = 0;
                $fin_nego = 0;
                $user_nego = -1;
                echo "<div class=\"nego-offres\">";
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<p class=\"nego-offre\">";
                    $occ += 1;
                    echo ($occ%2 == 1) ? "Acheteur : " : "Vendeur : ";
                    echo $data['prix'] . "€";
                    $fin_nego = intval($data['fin']);
                    if($fin_nego){echo " (Validé)";}
                    $user_nego = intval($data['acheteur']);
                    echo "</p>";
                }
                echo "</div>";
                echo "<div class=\"nego-compteur\">Négociation : " . ($occ) . "/" . 5 . "</div>";
                if($occ >= 6){
                    $requete = "UPDATE op_nego SET fin = 1 WHERE article = " . $article . " AND acheteur = " . $user_nego . " AND nb_op = 5";
                    $result = mysqli_query($db_handle, $requete);
                    $fin_nego = 1;
                }
                ?>
                    <form method="post" class="choixNego">
                        <button type="submit" id="RefuserNego" class="nego-refuser" name="RefuserNego" class="btn"            <?php if($fin_nego == 1 || $occ%2 == 0){echo "disabled";} ?>>Proposer une contre offre</button>
                        <input type="hidden" id="occ" name="occ" value="<?php echo ($occ); ?>"> 
                        <input type="number" id="prix" class="nego-input" name="prix" max="<?php echo $borne_max ?>" <?php if($fin_nego == 1 || $occ%2 == 0){echo "disabled";} ?>>
                        <button type="submit" class="nego-accepter"id="AccepterNego" name="AccepterNego" class="btn"           <?php if($fin_nego == 1 || $occ%2 == 0){echo "disabled";} ?>>Accepter (Mettre fin a la négociation)</button>
                    </form>
                <?php
            }
        }
        else if($type_article == 2){
            $str = "";
            $requete = "SELECT * FROM op_enchere WHERE article = " . $article;
            $result = mysqli_query($db_handle, $requete);
            $prix = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $str = $str . $data["prix"].", \r\n";
            }
            ?>
                <form method="post">
                <h1>
                    <button type="submit" class="enchere-effectue" name="Encherir" class="btn" disabled ?>Encheres effectuées</button>
                    <input type="text" class="enchere-liste" name="prix" readonly value="<?php echo $str; ?>">
                </h1>
                </form>
            <?php 
        }
    }


?>
</div>


<?php


    if(isset($_POST['AjouterPanier'])){
        if($logged != 0){
            $requete = "INSERT INTO panier VALUES (" .
            "''," . 
            "'" . $logged . "'," .
            "'" . $article . "'," .
            "'" . $type_article . "'" . 
            ")";
            $result = mysqli_query($db_handle, $requete);
            echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
        }
        else{
            echo "<script>setTimeout(() => window.location.replace(\"connexion.php?redir=".base64_encode($_SERVER['REQUEST_URI'])."\"), 0);</script>";
        }
    }


    if(isset($_POST['AccepterNego'])){
        $requete = "UPDATE articles SET fin = 1 WHERE id = " . $article . " AND type_nego = " . $type_article;
        #$result = mysqli_query($db_handle, $requete);

        $id_acheteur = 0;
        if(intval($_POST['occ'])%2 == 0){
            $id_acheteur = $logged;
        }
        else{
            $requete = "SELECT * FROM op_nego WHERE article = " . $article . " AND nb_op = " . (intval($_POST['occ']) - 1);
            $result = mysqli_query($db_handle, $requete);
            while ($data = mysqli_fetch_assoc($result)) {
                $id_acheteur = intval($data['acheteur']);
            }
        }
        
        if(intval($_POST['occ']) > -1){
            $requete = "UPDATE op_nego SET fin = 1 WHERE article = " . $article . " AND acheteur = " . $id_acheteur . " AND nb_op = " . (intval($_POST['occ'] - 1));
            echo $requete;
            $result = mysqli_query($db_handle, $requete);
        }
        echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
    }
    if(isset($_POST['RefuserNego'])){
        $id_acheteur = 0;
        if(intval($_POST['occ'])%2 == 0){
            $id_acheteur = $logged;
        }
        else{
            $requete = "SELECT * FROM op_nego WHERE article = " . $article . " AND nb_op = " . (intval($_POST['occ']) - 1);
            $result = mysqli_query($db_handle, $requete);
            while ($data = mysqli_fetch_assoc($result)) {
                $id_acheteur = intval($data['acheteur']);
            }
        }
        $requete = "INSERT INTO op_nego VALUES ("
        . "'',"
        . $article . ","
        . $id_acheteur . ","
        . intval($_POST['occ']) . ","
        . intval($_POST['prix']) . ","
        . "0"
        . ")"; 
        echo $requete;
        $result = mysqli_query($db_handle, $requete);
        echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
    }


    if(isset($_POST['Encherir'])){
        if($logged != 0){
            $requete = "INSERT INTO op_enchere VALUES (" .
            "''," . 
            "'" . $article . "'," .
            "'" . $logged . "'," .
            "" . $_POST['prix'] . "" . 
            ")";
            $result = mysqli_query($db_handle, $requete);
            
            echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
        }
        else{
            echo "<script>setTimeout(() => window.location.replace(\"connexion.php?redir=".base64_encode($_SERVER['REQUEST_URI'])."\"), 0);</script>";
        }
    }

?>




<?php include("blocs/footer.php"); ?>