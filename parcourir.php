<?php include("blocs/header.php"); ?>
<link href="CSS/parcourir.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="content">
<?php
if ($db_found) {
        # Requête pour récupérer les produits
        $sql = "SELECT titre, prix, description, img1, img2, img3, img4, img5 FROM articles";
        $result = mysqli_query($db_handle, $sql);

        if (mysqli_num_rows($result) > 0) {
            # Afficher les données de chaque ligne
            while($row = mysqli_fetch_assoc($result)) {
                echo '<a href="parcourir.php">';
                echo '<div class="product">';
                

                echo '<div class="col">';
                echo '<h2 class="row auto">' . htmlspecialchars($row["titre"]) . '</h2>';
                echo '<p class="price row auto">Prix: ' . htmlspecialchars($row["prix"]) . '€</p>';
                echo '<p class="row auto">Description: ' . htmlspecialchars($row["description"]) . '</p>';
                echo '</div>';

                
                echo '<div class="row">';
            if (!empty($row["img1"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img1"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            if (!empty($row["img2"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img2"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            if (!empty($row["img3"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img3"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            if (!empty($row["img4"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img4"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            if (!empty($row["img5"])) {
                echo '<div class="col-auto"><img src="' . htmlspecialchars($row["img5"]) . '" alt="' . htmlspecialchars($row["titre"]) . '"></div>';
            }
            echo '</div>'; # Close row
            
                echo '</div>';
                
            }echo'</a>';
        } else {
            echo "0 résultats";
        }
        

        # Fermeture de la connexion à la base de données
        mysqli_close($db_handle);
    } else {
        echo "Base de données introuvable";
    }
?>
</div>
<?php include("blocs/footer.php"); ?>