<?php include("/blocs/header.php") ?>

<h1>Inscription</h1>

    <form method="post">
        <table>
        <tr>
            <td><label>Nom du produit :</label></td>
            <td><input type="text" name="product_name" required></td>²
        </tr>
        <tr>
            <td><label>Stock :</label></td>
            <td><input type="number" min="0" name="in_stock"></td>
        </tr>
        <tr>
            <td><label>Prix :s</label></td>
            <td><input type="number" min="0" name="price" required></td>
        </tr>
        <tr>
            <td><label>Marque :</label></td>
            <td><input type="text" name="brand" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="Traitement" value="Traitement"></td>
        </tr>
        </table>
    </form>

</body>
</html>