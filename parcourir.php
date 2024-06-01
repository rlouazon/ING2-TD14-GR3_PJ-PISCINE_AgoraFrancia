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
                            <option value="0" <?php if(isset($_GET['categorie'])){if($_GET['categorie'] == "0"){echo "selected";}} ?>>Rares</option>
                            <option value="1" <?php if(isset($_GET['categorie'])){if($_GET['categorie'] == "1"){echo "selected";}} ?>>Haut de gamme</option>
                            <option value="2" <?php if(isset($_GET['categorie'])){if($_GET['categorie'] == "2"){echo "selected";}} ?>>Régulier</option>
                            <option value="3" <?php if(isset($_GET['categorie'])){if($_GET['categorie'] == "3"){echo "selected";}} ?>>Tout</option>
                        </select>
                    </div>
                    <div class="col-auto mb-3 mt-3"style="padding-top: 15px;">
                         
                        <select id="type_achat" class="form-control row " name="type_achat">
                            <option value="enchere" <?php if(isset($_GET['type_achat'])){if($_GET['type_achat'] == "enchere"){echo "selected";}} ?> >Enchere</option>
                            <option value="negociation"    <?php if(isset($_GET['type_achat'])){if($_GET['type_achat'] == "negociation"){echo "selected";}} ?>    >Negociation</option>
                            <option value="vente_directe"      <?php if(isset($_GET['type_achat'])){if($_GET['type_achat'] == "vente_directe"){echo "selected";}} ?>      >Achat immédiat</option>
                            <option value="tout"    <?php if(isset($_GET['type_achat'])){if($_GET['type_achat'] == "tout"){echo "selected";}} ?>    >Tout</option>
                        </select>
                    </div>
                    <div class="col-auto mb-3 mt-3" style="padding-top: 5px;">
                        <input type="submit" value="Soumettre" class="form-control col">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
if (isset($_GET['categorie']) && isset($_GET['type_achat'])) {
    $categorie = htmlspecialchars($_GET['categorie']);
    $type_achat = htmlspecialchars($_GET['type_achat']);
function trier_les_element_parcourir($type_payement, $type_de_rarete, $db_handle) {
    // Requête pour récupérer les produits filtrés par etat
    $param = "1";

    if ($type_payement == "enchere") {
        $sql = "SELECT * FROM articles WHERE type_enchere = " . $param . " AND categorie= " . $type_de_rarete;
    } elseif ($type_payement == "negociation") {
        $sql = "SELECT * FROM articles WHERE type_nego = " . $param . " AND categorie= " . $type_de_rarete;
    } elseif ($type_payement == "vente_directe") {
        $sql = "SELECT * FROM articles WHERE type_vd = " . $param . " AND categorie= " . $type_de_rarete;
    } elseif ($type_payement == "tout") {
        $sql = "SELECT * FROM articles WHERE categorie = " . $type_de_rarete;
    }

    // Execute the query
    $result = mysqli_query($db_handle, $sql);
    $occ = 0;

    // Check if query execution was successful
    if ($result) {
        // Count number of rows and process results
        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $occ += 1;
                $id_panier = (int)$row['id'];

                // Determine the type of article
                $type_article = -1;
                if ((intval($row["type_vd"])) == 1) {
                    $type_article = 0;
                }
                if ((intval($row["type_nego"])) == 1) {
                    $type_article = 1;
                }
                if ((intval($row["type_enchere"])) == 1) {
                    $type_article = 2;
                }

                // Display the article
                echo '<a href="articles.php?article=' . htmlspecialchars($row["id"]) . '&type=' . htmlspecialchars($type_article) . '">';
                echo '<div class="product">';
                if (!empty($row["img1"])) {
                    echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img1"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
                }
                echo '<div class="col">';
                echo '<h2 class="row auto">' . htmlspecialchars($row["titre"]) . '</h2>';
                echo '<h2 class="row auto">id: ' . htmlspecialchars($row["id"]) . '</h2>';
                echo '<h2 class="row auto">type de payement : ' . $type_payement . '</h2>';
                echo '<p class="price row auto">Prix: ' . htmlspecialchars($row["prix"]) . '€</p>';
                echo '<p class="row auto">Description: ' . htmlspecialchars($row["description"]) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }
        } 
    } else {
        echo "Error: " . mysqli_error($db_handle);
    }
}


if ($db_found) {
    if (isset($_GET['categorie'])) {
        echo '<div id="results">';
        $categorie = htmlspecialchars($_GET['categorie']);
        if ($categorie != 3){
            trier_les_element_parcourir(htmlspecialchars($_GET['type_achat']),$categorie, $db_handle);
        } else {
            trier_les_element_parcourir(htmlspecialchars($_GET['type_achat']),"0", $db_handle);
            trier_les_element_parcourir(htmlspecialchars($_GET['type_achat']),"1", $db_handle);
            trier_les_element_parcourir(htmlspecialchars($_GET['type_achat']),"2", $db_handle); 
        }
        echo '</div>';
    } else {
        $affichage=3;
        trier_les_element_parcourir("tout","0", $db_handle);
        trier_les_element_parcourir("tout","1", $db_handle);
        trier_les_element_parcourir("tout","2", $db_handle); 
    }

    // Fermeture de la connexion à la base de données
} else {
    echo "Base de données introuvable";
}
}
?>

<?php include("blocs/footer.php"); ?>
