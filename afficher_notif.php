<?php include("blocs/header.php"); ?>
<link href="CSS/parcourir.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclusion de jQuery -->
<?php

    // Requête pour récupérer les produits filtrés par etat
$param = "1";

if ($occ>=1){

// Execute the query
$result = mysqli_query($db_handle, $result);
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
                $type_acha="vente directe";
            }
            if ((intval($row["type_nego"])) == 1) {
                $type_article = 1;
            }
            if ((intval($row["type_enchere"])) == 1) {
                $type_article = 2;
            }

            // Display the article
            echo '<a href="articles.php?article=' . htmlspecialchars($row["id"]) . '&type=' . htmlspecialchars($row["id"]) . '">';
            echo '<div class="product">';
            if (!empty($row["img1"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img1"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            echo '<div class="col">';
            echo '<h2 class="row auto">' . htmlspecialchars($row["titre"]) . '</h2>';
            echo '<h2 class="row auto">id: ' . htmlspecialchars($row["id"]) . '</h2>';
            echo '<h2 class="row auto">type de payement : ' . $row["id"] . '</h2>';
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