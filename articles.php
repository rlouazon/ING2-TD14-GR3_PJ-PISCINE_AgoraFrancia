<?php include("blocs/header.php"); ?>

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


<p><?php echo $vendeur ?></p>
<p><?php echo $titre ?></p>
<p><?php echo $prix ?></p>
<p><?php echo $description ?></p>
<p><?php echo $categorie ?></p>
<p><?php echo $etat ?></p>
<?php echo ($img1 != "") ? "<img src=\"".$img1."\">" : ""; ?>
<?php echo ($img2 != "") ? "<img src=\"".$img2."\">" : ""; ?>
<?php echo ($img3 != "") ? "<img src=\"".$img3."\">" : ""; ?>
<?php echo ($img4 != "") ? "<img src=\"".$img4."\">" : ""; ?>
<?php echo ($img5 != "") ? "<img src=\"".$img5."\">" : ""; ?>


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
    echo $condition;
    if($condition == 0){
        ?>
            <form method="post">
                <button type="submit" name="AjouterPanier" class="btn">Ajouter au Panier</button>
            </form>
        <?php
    }
    else if($condition == 1){


        if($type_article == 0){
            $requete = "INSERT INTO op_vd VALUES (" .
            "''," . 
            "'" . $article . "'," .
            "'" . $logged . "'," .
            "0" . 
            ")";
            $result = mysqli_query($db_handle, $requete);
            echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
        }
        else if($type_article == 2){
            $message = "";
            $prixmin = 0;
            $condition = 0;

            $requete = "SELECT * FROM op_enchere WHERE article = " . $article . " AND acheteur = " . $logged;
            $result = mysqli_query($db_handle, $requete);
            $occ = 0;
            $prix = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $prix = $data['prix'];
                $occ += 1;
            }
            if($occ == 1){
                $message = "Enchere déposée (" . $prix . "€)";
            }
            else{
                $requete = "SELECT * FROM articles WHERE id = " . $article;
                $result = mysqli_query($db_handle, $requete);
                $occ = 0;
                $datelimite = "";
                while ($data = mysqli_fetch_assoc($result)) {
                    $datelimite = date('Y-m-d H:i:s', strtotime($data['limite_tps']));
                    $prixmin = $data['prix'];
                    $occ += 1;
                }
                if($occ == 1){
                    if(date("Y-m-d H:i:s") < $datelimite){
                        $message = "Encherir";
                        $condition = 1;
                    }
                    else{
                        $message = "Date de fin d'enchere dépassée";
                    }
                }
                else{
                    $message = "Date de fin d'enchere non trouvée";
                }
            }
            ?>
                <form method="post">
                    <input type="number" name="prix" min="<?php echo $prixmin ?>" <?php if($condition == 0){echo "disabled";} ?>> 
                    <button type="submit" name="Encherir" class="btn" <?php if($condition == 0){echo "disabled";} ?>><?php echo $message ?></button>
                </form>
            <?php 
        }


    }
    else if($condition == 2){
        if($type_article == 2){
            $str = "";
            $requete = "SELECT * FROM op_enchere WHERE article = " . $article;
            $result = mysqli_query($db_handle, $requete);
            $prix = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                echo $str = $str . $data["prix"].", \r\n";
            }
            ?>
                <form method="post">
                    <input type="text" name="prix" readonly value="<?php echo $str; ?>">
                    <button type="submit" name="Encherir" class="btn" disabled ?>Encheres effectuées</button>
                </form>
            <?php 
        }
    }


?>


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