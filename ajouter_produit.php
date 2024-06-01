<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<?php
$type_compte = 0;
if($logged != 0){
    $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
    $result = mysqli_query($db_handle, $requete);
    while ($data = mysqli_fetch_assoc($result)) {
        #ID
        $id =           $data['id'];
        $type =         $data['type'];
        $type_compte = $type;

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
    }
}

$success = 0;

if($logged != 0 && $type_compte != 0){
?>

<?php if($logged==0){
    echo "<script>setTimeout(() => window.location.replace(\"index.php\"), 0);</script>";
}
        $type=-1;
        $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
        $result = mysqli_query($db_handle, $requete);
        while ($data = mysqli_fetch_assoc($result)) {
            #ID
            
            $type =         $data['type'];
            }
        if ($type ==-1 || $type == 0){
            echo "<script>setTimeout(() => window.location.replace(\"index.php\"), 0);</script>";
        }
?>         <style>
.hidden {
    display: none;
}
</style>
</head>
<body>
<div class="centre">
<form method="post" enctype="multipart/form-data">
<h1 class="text-center">Ajout de produit</h1>

<div class="form-group">
    <h4>Informations du produit :</h4>
    <label for="titre">Titre* :</label>
    <input type="text" class="form-control" name="titre" maxlength="256" required>
</div>

<div class="form-group">
    <label for="type_de_vente">Type de vente* :</label>
    <select class="form-control" name="type_de_vente" id="type_de_vente" required>
        <option value="vd">Vente directe</option>
        <option value="enchere">Enchère</option>
        <option value="nego">Vente négociation</option>
    </select>
</div>

<div class="form-group hidden" id="limite_de_temps_div">
    <label for="limite_de_temps">Limite de temps :</label>
    <input type="number" class="form-control" name="limite_de_temps" id="limite_de_temps">
</div>

<div class="form-group">
    <label for="prix">Prix* :</label>
    <input type="number" class="form-control" name="prix" required>
</div>

<div class="form-group">
    <label for="description">Description* :</label>
    <textarea class="form-control" name="description" maxlength="2560" required></textarea>
</div>
<div class="form-group">
    <h4>Informations du produit :</h4>
    <label for="titre">Titre* :</label>
    <input type="text" class="form-control" name="titre" maxlength="256" required>
</div>

<div class="form-group">
    <label for="type_de_vente">Type de vente* :</label>
    <select class="form-control" name="type_de_vente" id="type_de_vente" required>
        <option value="vd">Vente directe</option>
        <option value="enchere">Enchère</option>
        <option value="nego">Vente négociation</option>
    </select>
</div>

<div class="form-group hidden" id="limite_de_temps_div">
    <label for="limite_de_temps">Limite de temps :</label>
    <input type="number" class="form-control" name="limite_de_temps" id="limite_de_temps">
</div>

<div class="form-group">
    <label for="prix">Prix* :</label>
    <input type="number" class="form-control" name="prix" required>
</div>

<div class="form-group">
    <label for="description">Description* :</label>
    <textarea class="form-control" name="description" maxlength="2560" required></textarea>
</div>

<div class="form-group">
    <h4>Images du produit :</h4>
    <label for="image1">Image 1* :</label>
    <input type="file" class="form-control" name="image1" required>
</div>
<div class="form-group">
    <label for="image2">Image 2 :</label>
    <input type="file" class="form-control" name="image2">
</div>
<div class="form-group">
    <label for="image3">Image 3 :</label>
    <input type="file" class="form-control" name="image3">
</div>
<div class="form-group">
    <label for="image4">Image 4 :</label>
    <input type="file" class="form-control" name="image4">
</div>
<div class="form-group">
    <label for="image5">Image 5 :</label>
    <input type="file" class="form-control" name="image5">
</div>

<div class="form-group">
    <label for="categorie">Catégorie* :</label>
    <select class="form-control" name="categorie" required>
        <option value="1">Articles hautes de gamme</option>
        <option value="2">Articles réguliers</option>
        <option value="0">Articles rares</option>
    </select>
</div>

<div class="form-group">
    <label for="etat_du_produit">État du produit* :</label>
    <select class="form-control" name="etat_du_produit" required>
        <option value="n">Neuf</option>
        <option value="cn">Comme neuf</option>
        <option value="be">Bon etat</option>
        <option value="abe">Assez bon etat</option>
    </select>
<div class="form-group">
    <h4>Images du produit :</h4>
    <label for="image1">Image 1* :</label>
    <input type="file" class="form-control" name="image1" required>
</div>
<div class="form-group">
    <label for="image2">Image 2 :</label>
    <input type="file" class="form-control" name="image2">
</div>
<div class="form-group">
    <label for="image3">Image 3 :</label>
    <input type="file" class="form-control" name="image3">
</div>
<div class="form-group">
    <label for="image4">Image 4 :</label>
    <input type="file" class="form-control" name="image4">
</div>
<div class="form-group">
    <label for="image5">Image 5 :</label>
    <input type="file" class="form-control" name="image5">
</div>

<div class="form-group">
    <label for="categorie">Catégorie* :</label>
    <select class="form-control" name="categorie" required>
        <option value="1">Articles hautes de gamme</option>
        <option value="2">Articles réguliers</option>
        <option value="0">Articles rares</option>
    </select>
</div>

<div class="form-group">
    <label for="etat_du_produit">État du produit* :</label>
    <select class="form-control" name="etat_du_produit" required>
        <option value="n">Neuf</option>
        <option value="cn">Comme neuf</option>
        <option value="be">Bon etat</option>
        <option value="abe">Assez bon etat</option>
    </select>
</div>

<button type="submit" name="ajout_du_produit" class="btn">Ajouter le produit</button>
<button type="submit" name="ajout_du_produit" class="btn">Ajouter le produit</button>

<script>
document.getElementById('type_de_vente').addEventListener('change', function () {
    var limiteDeTempsDiv = document.getElementById('limite_de_temps_div');
    var limiteDeTempsinput = document.getElementById('limite_de_temps');
    if (this.value === 'enchere') {
        limiteDeTempsDiv.classList.remove('hidden');
        limiteDeTempsinput.add('required');
    } else {
        limiteDeTempsDiv.classList.add('hidden');
        limiteDeTempsinput.remove('required', 'required');
    }
});
</script>


<?php
if(isset($_POST['ajout_du_produit'])){
    $path1 = $path2 = $path3 = $path4 = $path5 = "";
    
    if (!($_FILES['image1']['error'] == 4 || ($_FILES['image1']['size'] == 0 && $_FILES['image1']['error'] == 0))){
        $path1 = "photo_produit/".substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['image1']["type"])[1];
        move_uploaded_file($_FILES['image1']['tmp_name'], $path1);
    }
    if (!($_FILES['image2']['error'] == 4 || ($_FILES['image2']['size'] == 0 && $_FILES['image2']['error'] == 0))){
        $path2 = "photo_produit/" .substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['image2']["type"])[1];
        move_uploaded_file($_FILES['image2']['tmp_name'], $path2);
    }
    if (!($_FILES['image3']['error'] == 4 || ($_FILES['image3']['size'] == 0 && $_FILES['image3']['error'] == 0))){
        $path3 = "photo_produit/" .substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['image3']["type"])[1];
        move_uploaded_file($_FILES['image3']['tmp_name'], $path3);
    }
    if (!($_FILES['image4']['error'] == 4 || ($_FILES['image4']['size'] == 0 && $_FILES['image4']['error'] == 0))){
        $path4 = "photo_produit/" .substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['image4']["type"])[1];
        move_uploaded_file($_FILES['image4']['tmp_name'], $path4);
    }
    if (!($_FILES['image5']['error'] == 4 || ($_FILES['image5']['size'] == 0 && $_FILES['image5']['error'] == 0))){
        $path5 = "photo_produit/" .substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['image5']["type"])[1];
        move_uploaded_file($_FILES['image5']['tmp_name'], $path5);
    }

    $vd="";
    $nego="";
    $enchere="";
    $type_de_vente=$_POST['type_de_vente'];
    if($type_de_vente=="vd"){
        $vd=1;
    }elseif($type_de_vente=="nego"){
        $nego=1;
    }else{
        $enchere=1;
    }
    $limite_tps=$_POST['limite_de_temps'];
    if($limite_tps == ""){
        $limite_tps=0;
    }
    $limite_tps=$_POST['limite_de_temps'];
    if($limite_tps == ""){
        $limite_tps=0;
    }
    $requete = "INSERT INTO articles (vendeur,titre, type_vd,type_nego,type_enchere, limite_tps, prix, description, img1, img2, img3, img4, img5, categorie, etat,fin) VALUES ("
        . "'" . $logged . "',"  
        . "'" . mysqli_real_escape_string($db_handle, $_POST['titre']) . "',"
        . "'" . $vd . "',"  
        . "'" . $nego . "',"  
        . "'" . $enchere . "',"  
        . "" . "DATE_ADD(CURDATE(), INTERVAL ". $limite_tps ." DAY)" . ","
        . "" . "DATE_ADD(CURDATE(), INTERVAL ". $limite_tps ." DAY)" . ","
        . "'" . mysqli_real_escape_string($db_handle, $_POST['prix']) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $_POST['description']) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $path1) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $path2) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $path3) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $path4) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $path5) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $_POST['categorie']) . "',"
        . "'" . mysqli_real_escape_string($db_handle, $_POST['etat_du_produit']) . "',"
        . 0 . ")";
    $result = mysqli_query($db_handle, $requete);
    echo $requete;
    if ($result) {
        $alert = "Produit ajouté avec succès";
        $success = 1;
    } else {
        $alert = "Erreur lors de l'ajout du produit : " . mysqli_error($db_handle);
    }
}

}


include("blocs/redir.php");


?>

<?php include("blocs/footer.php"); ?>
