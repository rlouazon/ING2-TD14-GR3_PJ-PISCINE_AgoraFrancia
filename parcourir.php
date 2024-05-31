<?php include("blocs/header.php"); ?>
<link href="CSS/parcourir.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclusion de jQuery -->


<?php $affichage="Tout";$affichage_payement="Tout"; ?>
<div class="centre">
    <div class="content col pl-3">
        <div class="row">
            <div class="col-auto">
                <form id="categorieForm" class="row">
                    <div class="col-auto mb-3">
                        <label for="categorie" class="row">Choisissez une catégorie :</label>  
                        <select id="categorie" class="form-control row" name="categorie">
                            <option value="0">Rares</option>
                            <option value="1">Haut de gamme</option>
                            <option value="2">Régulier</option>
                            <option value="3">Tout</option>
                        </select>
                    </div>
                    <div class="col-auto mb-3">
                        <label for="type_achat" class="row">Choisissez un type d achat :</label>  
                        <select id="type_achat" class="form-control row" name="type_achat">
                            <option value="4">Enchere</option>
                            <option value="5">Negociation</option>
                            <option value="6">Achat immédiat</option>
                            <option value="3">Tout</option>
                    </select>
                    <div class="col-auto mb-3 mt-3" style="padding-top: 5px;">
                        <input type="submit" value="Soumettre" class="form-control col">
                    </div>
                    </div>
                    <?php
                    if(isset($_GET['categorie']) && isset($_GET['type_achat']) ){
                        if($_GET['categorie']==0){
                            $affichage="Rares";
                        } elseif($_GET['categorie']==1){
                            $affichage="Haut de gamme";
                        } elseif($_GET['categorie']==2){
                            $affichage="Régulier";
                        }else {
                            $affichage="Tout";
                        }
                        if($_GET['type_achat']==4){
                            $affichage_payement="Enchere";
                        } elseif($_GET['type_achat']==5){
                            $affichage_payement="Negociation";
                        } elseif($_GET['type_achat']==6){
                            $affichage_payement="Achat immédiat";
                        } else {
                            $affichage_payement="Tout";
                        }
                    }
                    ?>
                    <div id="results" class="col-auto mb-3 mt-4" style="padding-top: 5px;">
                        <h2><?php echo htmlspecialchars($affichage); ?></h2>
                    </div> <!-- Div pour afficher les résultats -->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('categorie');
    var selectedValue = 3; // Replace this with the value you want to set as selected

    var options = selectElement.options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].value == selectedValue) {
            options[i].selected = true;
            break;
        }
    }
});
</script>

<?php
function trier_les_element_parcourir($type_de_rarete, $db_handle) {
    // Requête pour récupérer les produits filtrés par etat
    $sql = "SELECT * FROM articles WHERE categorie = ?";
    
    if ($type_de_rarete == 4) {
        $sql = "SELECT * FROM articles WHERE type_enchere = ?";
        $param = "1";
    } elseif ($type_de_rarete == 5) {
        $sql = "SELECT * FROM articles WHERE type_nego = ?";
        $param = "1";
    } elseif ($type_de_rarete == 6) {
        $sql = "SELECT * FROM articles WHERE type_vd = ?";
        $param = "1";
    } else {
        $param = $type_de_rarete;
    }

    $stmt = mysqli_prepare($db_handle, $sql);
    mysqli_stmt_bind_param($stmt, 's', $param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Afficher les données de chaque ligne
        while ($row = mysqli_fetch_assoc($result)) {
            $type_article = -1;
            if((intval($row["type_vd"])) == 1){$type_article = 0;}
            if((intval($row["type_nego"])) == 1){$type_article = 1;}
            if((intval($row["type_enchere"])) == 1){$type_article = 2;}
            echo '<a href="articles.php?article='.$row["id"].'&type='.$type_article.'">';
            echo '<div class="product">';
            if (!empty($row["img1"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img1"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            echo '<div class="col">';
            echo '<h2 class="row auto">' . htmlspecialchars($row["titre"]) . '</h2>';
            echo '<h2 class="row auto">id: '. htmlspecialchars($row["id"]) . '</h2>';
            echo '<p class="price row auto">Prix: ' . htmlspecialchars($row["prix"]) . '€</p>';
            echo '<p class="row auto">Description: ' . htmlspecialchars($row["description"]) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    } 
    
    mysqli_stmt_close($stmt);
}

if ($db_found) {
    if (isset($_GET['categorie'])) {
        echo '<div id="results">';
        $categorie = htmlspecialchars($_GET['categorie']);
        if ($categorie != 3){
            trier_les_element_parcourir($categorie, $db_handle);
        } else {
            trier_les_element_parcourir("0", $db_handle);
            trier_les_element_parcourir("1", $db_handle);
            trier_les_element_parcourir("2", $db_handle); 
        }
        echo '</div>';
    } else {
        $affichage=3;
        trier_les_element_parcourir("0", $db_handle);
        trier_les_element_parcourir("1", $db_handle);
        trier_les_element_parcourir("2", $db_handle); 
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($db_handle);
} else {
    echo "Base de données introuvable";
}
?>

<?php include("blocs/footer.php"); ?>
