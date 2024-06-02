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