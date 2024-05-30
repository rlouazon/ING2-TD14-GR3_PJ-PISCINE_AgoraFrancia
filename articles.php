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

#Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas consectetur quis diam ac accumsan. Mauris in vestibulum mi. Suspendisse vel blandit erat. Donec eleifend accumsan felis nec gravida. Mauris pretium mauris vel dapibus interdum. Aenean quis turpis nisl. Pellentesque iaculis sem eu leo congue interdum non non eros. Suspendisse ut pellentesque nisl. Etiam eget efficitur elit. Morbi elementum libero nec lacus pulvinar pulvinar.
#Quisque varius sem non finibus sollicitudin. Donec sit amet lectus a orci hendrerit sollicitudin. Vivamus odio massa, lobortis posuere eros ut, viverra facilisis tortor. Vestibulum tempor nisi quis nibh bibendum elementum. Donec elit elit, malesuada eget convallis non, porta sit amet nibh. In hac habitasse platea dictumst. Vestibulum purus tortor, faucibus ac venenatis nec, gravida quis mi. Mauris dolor nisi, pretium vel blandit scelerisque, semper id erat. Nullam pellentesque posuere lacus, non lobortis augue congue ac. Maecenas a libero condimentum tellus maximus bibendum sed non ex. Sed id ex nisi. Nam sit amet est accumsan, consequat elit ac, fringilla ex. Integer volutpat turpis quis lorem cursus consequat. Proin eget ex eu dui elementum sollicitudin in id nisi. Sed bibendum mauris vitae maximus congue. Nullam volutpat dictum congue.
#Aliquam erat volutpat. Ut aliquet venenatis ante, quis sollicitudin lorem. Ut ac enim non libero gravida malesuada quis eget tellus. Etiam nec ullamcorper tellus. Donec vehicula mauris in mi accumsan, eget ultricies ligula viverra. Curabitur consectetur feugiat arcu a accumsan. 

# Si :
#  - Pas dans la bdd ou plusieurs (bug)
#  - Si pas de type indiqué (empeche de gerer le multi type)
#  - Si le type ne correspond pas a un de ceux de la bdd (modif manuelle de l'utilisateur ~ triche)
#  - Si l'annonce est échue
if($occ != 1   ||   $type_article == -1   ||   ((($type_article == 0) == intval($type_vd)) || (($type_article == 1) == intval($type_nego)) || (($type_article == 2) == intval($type_enchere))) == 0   ||   $fin == 1){
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

    include('blocs/panier_utilitaire.php');
    if(!recherche_panier($article, $type_article)){
        ?>
            <form method="post">
                <button type="submit" name="AjouterPanier" class="btn">Ajouter au Panier    <img src="CSS/images/inscription.png" alt="logo"></button>
            </form>
        <?php
    }

    

?>




<?php include("blocs/footer.php"); ?>