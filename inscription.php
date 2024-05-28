<?php include("blocs/header.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->
</head>
<body>

<div class="header">
    <img src="CSS/images/logo.png" alt="logo" class="logo">
    <h2>AGORA FRANCIA</h2>
</div>

<div class="centre">
    <form method="post">
        <h1 class="text-center">Inscription</h1>
        <div class="form-group">
            <h4>Vos informations :</h4>
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="mail">Mail :</label>
            <input type="email" class="form-control" id="mail" name="mail" maxlength="256" required>
        </div>
        <div class="form-group">
            <h4>Votre moyen de paiement :</h4>
            <label>Type de carte :</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" id="visa" value="0" checked>
                <label class="form-check-label" for="visa">VISA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" id="mastercard" value="1">
                <label class="form-check-label" for="mastercard">MasterCard</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" id="amex" value="2">
                <label class="form-check-label" for="amex">American Express</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" id="paypal" value="3">
                <label class="form-check-label" for="paypal">Paypal</label>
            </div>
        </div>
        <div class="form-group">
            <label for="bank_carte">Numéro de carte bancaire :</label>
            <input type="number" class="form-control" id="bank_carte" name="bank_carte" min="999999999999999" max="10000000000000000" required>
        </div>
        <div class="form-group">
            <label for="bank_nom">Nom affilié a la carte :</label>
            <input type="text" class="form-control" id="bank_nom" name="bank_nom" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="bank_date">Date d'expiration de la carte :</label>
            <input type="month" class="form-control" id="bank_date" name="bank_date" min="2024-01" required>
        </div>
        <div class="form-group">
            <label for="bank_code">Code confidentiel de la carte :</label>
            <input type="number" class="form-control" id="bank_code" name="bank_code" max="10000" required>
        </div>
        <div class="form-group">
            <h4>Sécurité :</h4>
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="Inscription" class="btn">Inscription    <img src="CSS/images/inscription.png" alt="logo" class="imgInscription"></button>
    </form>
</div>

<?php
if (isset($_POST['Inscription'])) {
    $condition = 0;
    if (isset($_POST['mail']) && $_POST['mail'] != "") {
        // Validation du mail ou autres opérations
    }
}
?>

</body>
</html>
