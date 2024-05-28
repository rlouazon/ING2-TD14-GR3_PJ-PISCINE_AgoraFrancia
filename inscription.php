<?php include("blocs/header.php") ?>

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