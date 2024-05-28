<?php include("/blocs/header.php") ?>

<h1>Inscription</h1>
    <form method="post">
        <table>

            <tr>
                <td>Vos informations :</td>
            </tr>
            <tr>
                <td><label>Nom :</label></td>
                <td><input type="text"  name="nom"      maxlength="256" required></td>
            </tr>
            <tr>
                <td><label>Prenom :</label></td>
                <td><input type="text"  name="prenom"   maxlength="256" required></td>
            </tr>
            <tr>
                <td><label>Mail :</label></td>
                <td><input type="email" name="mail"     maxlength="256" required></td>
            </tr>

            <tr>
                <td>Votre moyen de paiement :</td>
            </tr>
            <tr>
                <td><label>Type de carte :</label></td>
                <td>
                    <label><input type="radio" name="bank_type" value="0"   checked>VISA</label>
                    <label><input type="radio" name="bank_type" value="1">MasterCard</label>
                    <label><input type="radio" name="bank_type" value="2">American Express</label>
                    <label><input type="radio" name="bank_type" value="3">Paypal</label>
                </td>
            </tr>
            <tr>
                <td><label>Numéro de carte bancaire :</label></td>
                <td><input type="number" name="bank_carte" min="999999999999999" max="10000000000000000" required></td>
            </tr>
            <tr>
                <td><label>Nom affilié a la carte :</label></td>
                <td><input type="text" name="bank_nom" maxlength="256" required></td>
            </tr>
            <tr>
                <td><label>Date d'expiration de la carte :</label></td>
                <td><input type="month" name="bank_date" min="2024-01" required></td>
            </tr>
            <tr>
                <td><label>Code confidentiel de la carte :</label></td>
                <td><input type="number" name="bank_code" max="10000" required></td>
            </tr>

            <tr>
                <td>Sécurité :</td>
            </tr>
            <tr>
                <td><label>Mot de passe :</label></td>
                <td><input type="password" name="password" required></td>
            </tr>

            <tr>
                <td><input type="submit" name="Inscription" value="Inscription"></td>
            </tr>
        </table>
    </form>

<?php


?>