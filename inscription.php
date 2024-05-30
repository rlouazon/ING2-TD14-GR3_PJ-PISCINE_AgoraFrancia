<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->


<div class="centre">
    <form method="post" enctype="multipart/form-data">
        <h1 class="text-center">Inscription</h1>

        <div class="form-group">
            <h4>Vos informations :</h4>
            <label for="pseudo">Pseudo :</label>
            <input type="text" class="form-control" name="pseudo" maxlength="256">
        </div>
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" name="nom" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control" name="prenom" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="mail">Mail :</label>
            <input type="email" class="form-control" name="mail" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="mail">Telephone :</label>
            <input type="tel" class="form-control" name="tel" maxlength="256" required>
        </div>

        <div class="form-group">
            <h4>Votre moyen de paiement :</h4>
            <label>Type de carte :</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" value="0" checked>
                <label class="form-check-label" for="visa">VISA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" value="1">
                <label class="form-check-label" for="mastercard">MasterCard</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" value="2">
                <label class="form-check-label" for="amex">American Express</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bank_type" value="3">
                <label class="form-check-label" for="paypal">Paypal</label>
            </div>
        </div>
        <div class="form-group">
            <label for="bank_carte">Numéro de carte bancaire :</label>
            <input type="number" class="form-control" name="bank_carte" min="999999999999999" max="10000000000000000" required>
        </div>
        <div class="form-group">
            <label for="bank_nom">Nom affilié a la carte :</label>
            <input type="text" class="form-control"name="bank_nom" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="bank_date">Date d'expiration de la carte :</label>
            <input type="month" class="form-control" name="bank_date" min="2024-01" required>
        </div>
        <div class="form-group">
            <label for="bank_code">Code confidentiel de la carte :</label>
            <input type="number" class="form-control" name="bank_code" max="10000" required>
        </div>

        <div class="form-group">
            <h4>Adresse :</h4>
            <label for="addr1">Addresse 1 :</label>
            <input type="text" class="form-control" name="addr1" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="addr2">Addresse 2 :</label>
            <input type="text" class="form-control" name="addr2" maxlength="256">
        </div>
        <div class="form-group">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="codepostal">Code Postal :</label>
            <input type="number" class="form-control" name="codepostal" max="100000" required>
        </div>
        <div class="form-group">
            <label for="pays">Pays :</label>
            <input type="text" class="form-control" name="pays" maxlength="256" required>
        </div>

        <div class="form-group">
            <h4>Personnalisation :</h4>
            <label for="photo">Photo :</label>
            <input type="file" class="form-control" name="photo" required>
        </div>
        <div class="form-group">
            <label for="back">Arrière-plan :</label>
            <input type="file" class="form-control" name="back" required>
        </div>

        <div class="form-group">
            <h4>Sécurité :</h4>
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <h4>Conditions d'utilisation :</h4>
            <label style="text-align: center;" for="conditions">J'accepte les conditions d'utilisation et consent a être dans l'obligation d'acheter un article pour lequel j'ai émis une offre.</label>
            <input type="checkbox" class="form-control" name="conditions" required>
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
            
            $path1 = "photo_user/".substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['photo']["type"])[1];
            $path2 = "back_user/".substr(md5(microtime()),rand(0,26),50).".".explode("/", $_FILES['back']["type"])[1];
            move_uploaded_file($_FILES['photo']['tmp_name'], $path1);
            move_uploaded_file($_FILES['back']['tmp_name'], $path2);
           
            $requete = "INSERT INTO utilisateurs VALUES ("
                ."\"\","
                ."\"".$_POST['pseudo']."\","
                ."\"".$_POST['nom']."\","
                ."\"".$_POST['prenom']."\","
                ."\"".$_POST['mail']."\","
                ."\"".$_POST['tel']."\","
                ."\"".$_POST['bank_type']."\","
                ."\"".$_POST['bank_carte']."\","
                ."\"".$_POST['bank_nom']."\","
                ."\"".$_POST['bank_date']."\","
                ."\"".$_POST['bank_code']."\","
                ."\"".$_POST['addr1']."\","
                ."\"".$_POST['addr2']."\","
                ."\"".$_POST['ville']."\","
                ."\"".$_POST['codepostal']."\","
                ."\"".$_POST['pays']."\","
                ."\"".$path1."\","
                ."\"".$path2."\","
                ."\"".sha1($_POST['password'])."\","
                ."\"0\""
                .")";
            $result = mysqli_query($db_handle, $requete);
            $alert = "Compte créé";

            $init_connexion_pseudo = $_POST['pseudo'];
            $init_connexion_login = $_POST['mail'];
            $init_connexion_pass = sha1($_POST['password']);
            include("blocs/init_connexion.php");

            $delay = 3000;
            include("blocs/redir.php");

        }
    }

?>

<?php include("blocs/footer.php"); ?>