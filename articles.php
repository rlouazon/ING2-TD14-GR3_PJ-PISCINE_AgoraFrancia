<?php include("blocs/header.php"); ?>

<?php

$article = 0;
if(isset($_GET["article"])){
    if($_GET["article"] != ""){
        $article = intval($_GET["article"]);
    }
}
$type = -1;
if(isset($_GET["type"])){
    if($_GET["type"] != ""){
        $type = intval($_GET["type"]);
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





if($occ != 1 || $type == -1 || ((($type == 0) == intval($type_vd)) && (($type == 1) == intval($type_nego)) && (($type == 2) == intval($type_enchere))) == 0){
    echo "<script>setTimeout(() => window.location.replace(\"index.php\"), 0);</script>";
}

?>

<p><?php echo $vendeur ?></p>
<p><?php echo $titre ?></p>
<p><?php echo $prix ?></p>
<p><?php echo $description ?></p>
<p><?php echo $categorie ?></p>
<p><?php echo $etat ?></p>
<p><?php echo $type_vd ?></p>
<h1>TYPE : <?php echo $type; ?></h2>
<h2>VD : <?php echo (($type == 0) == intval($type_vd)); ?></h2>
<h2>NEGO : <?php echo (($type == 1) == intval($type_nego)); ?></h2>
<h2>ENCHERE : <?php echo (($type == 2) == intval($type_enchere)); ?></h2>
<h2><?php echo ((($type == 0) == intval($type_vd)) && (($type == 1) == intval($type_nego)) && (($type == 2) == intval($type_enchere))) == 1; ?></h2>


<?php include("blocs/footer.php"); ?>