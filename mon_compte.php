<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<?php
    if($logged != 0){

        $requete = "SELECT * FROM utilisateurs WHERE id = \"" . $logged;
        $result = mysqli_query($db_handle, $requete);
        $occ = 0;
        $id = 0;
        while ($data = mysqli_fetch_assoc($result)) {

            #ID
            $id =           $data['id'];
            $type =         $data['type'];

            #INFO PERSO
            $pseudo =       $data['pseudo'];
            $nom =          $data['nom'];
            $prenom =       $data['prenom'];
            $mail =         $data['mail'];
            $tel =          $data['tel'];

            #BANQUE
            $bank_type =    $data['bank_type'];
            $bank_carte =   $data['bank_carte'];
            $bank_nom =     $data['bank_nom'];
            $bank_date =    $data['bank_date'];

            #ADDRESSE
            $addr1 =        $data['addr1'];
            $addr2 =        $data['addr2'];
            $ville =        $data['ville'];
            $codepostal =   $data['codepostal'];
            $pays =         $data['pays'];

            #IMAGES
            $photo =        $data['photo'];
            $back =         $data['back'];

        }

    }

?>

<div class="centre">
    <form method="post">
        <h1 class="text-center">Connexion</h1>
        <div class="form-group">
            <label for="pseudo">Pseudo :</label>
            <input type="text" class="form-control" name="pseudo" maxlength="256" required>
        </div>
        <div class="form-group">
            <label for="mail">Mail :</label>
            <input type="email" class="form-control" id="mail" name="mail" maxlength="256" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="Connexion" class="btn">Connexion    <img src="CSS/images/inscription.png" alt="logo" class="imgInscription"></button>
    </form>
</div>



<?php include("blocs/footer.php"); ?>