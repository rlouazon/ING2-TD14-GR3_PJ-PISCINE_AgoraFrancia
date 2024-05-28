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
    if(isset($_POST['Inscription'])){
        $condition = 0;
        if(isset($_POST['mail'])){
            if($_POST['mail'] != "" && count(explode('@', $_POST['mail']))>1){
                $requete = "SELECT * FROM utilisateurs WHERE mail = \"" . $_POST['mail'] . "\"";
                $result = mysqli_query($db_handle, $requete);
                $occ = 0;
                while ($data = mysqli_fetch_assoc($result)) {
                    $occ += 1;
                }
                if($occ == 0){
                    $condition = 1;
                }
                else{
                    $alert = "Adresse mail déjà inscrite";
                }
            }
            else{
                $alert = "Adresse mail incorrecte";
            }
        }
        else{
            $alert = "Adresse mail incorrecte inexistante";
        }

        if($condition == 1){
            
            $requete = "INSERT INTO utilisateurs VALUES ("
                ."\"\","
                ."\"".$_POST['nom']."\","
                ."\"".$_POST['prenom']."\","
                ."\"".$_POST['mail']."\","
                ."\"".$_POST['bank_type']."\","
                ."\"".$_POST['bank_carte']."\","
                ."\"".$_POST['bank_nom']."\","
                ."\"".$_POST['bank_date']."\","
                ."\"".sha1($_POST['bank_code'])."\","
                ."\"".sha1($_POST['password'])."\""
                .")";
            echo $requete;
            $result = mysqli_query($db_handle, $requete);
            $alert = "Compte créé";

            $requete = "SELECT id FROM utilisateurs WHERE mail = \"" . $_POST['mail'] . "\"";
            $result = mysqli_query($db_handle, $requete);
            $occ = 0;
            $id = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $occ += 1;
                $id = (int)$data['id'];
            }
            echo "     PRE" . $id;
            if($occ == 1){
                echo "     PRO" . $id;
                $_SESSION['id'] = $id;
                echo "     SESS" . $_SESSION['id'];
                $logged = $id;
                echo "     LOGGED" . $logged;
            }
            else{
                $alert = "Erreur de base de données : adresse mail ";
            }

        }
    }

?>

<?php include("blocs/footer.php") ?>
