<?php include("blocs/header.php"); ?>
<link href="CSS/parcourir.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="content">
<?php 

function trier_les_element_parcourir($type_de_rarete, $db_found, $db_handle) {
    if ($db_found) {
        // Requête pour récupérer les produits
        $sql = "SELECT titre, prix, etat, description, img5 FROM articles";
        $result = mysqli_query($db_handle, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Afficher les données de chaque ligne
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["etat"] == $type_de_rarete) {
                    echo '<a href="parcourir.php">';
                    echo '<div class="product">';
                    echo '<div class="col">';
                    echo '<h2 class="row auto">' . htmlspecialchars($row["titre"]) . '</h2>';
                    echo '<p class="price row auto">Prix: ' . htmlspecialchars($row["prix"]) . '€</p>';
                    echo '<p class="row auto">Description: ' . htmlspecialchars($row["description"]) . '</p>';
                    echo '</div>';

                    if (!empty($row["img5"])) {
                        echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img5"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
                    }
                    echo '</div>';
                    echo '</a>';
                }
            }
        } else {
            echo "0 résultats";
        }

        // Fermeture de la connexion à la base de données
        mysqli_close($db_handle);
    } else {
        echo "Base de données introuvable";
    }
}
trier_les_element_parcourir("rares",$db_found,$db_handle)

?>

</div>
<?php include("blocs/footer.php"); ?>