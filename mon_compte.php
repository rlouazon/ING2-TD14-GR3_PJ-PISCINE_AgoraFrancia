<?php include("blocs/header.php"); ?>
<link href="CSS/mon_compte.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<?php
if($logged != 0){
    $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
    $result = mysqli_query($db_handle, $requete);
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

        ?>



<style>body::before{background: url('<?php echo $back; ?>');}</style>

<div class="personnal-info"> 
    <div class="titreMain">Informations Personnelles</div>
</div>

<div class="container">
    <div class="col colG">
        <form method="post">
            <img src="<?php echo $photo; ?>" alt="photo de profil" class="pp">
            <div class="nomPrenom"> 
                <h2><?php echo $prenom . " " . $nom; ?></h2>
            </div>
            <div class="info">
                <label class="naming">Pseudonyme :</label>
                <label class="info"><?php echo $pseudo; ?></label>
            </div>
            <div class="info">
                <label class="naming">Adresse mail :</label>
                <label class="info"><?php echo $mail; ?></label>
            </div>
            <div class="info">
                <label class="naming">Téléphone :</label>
                <label class="info"><?php echo $tel; ?></label>
            </div>
        </form>
    </div>
    <div class="col colD">
        <h2 class="text-center">Informations Bancaires</h2>
        <div class="info">
            <label class="naming">Type de carte :</label>
            
            <label class="info"><?php echo (intval($bank_type) < 2) ? ((intval($bank_type) == 0) ? "VISA" : "Mastercard") : ((intval($bank_type) == 2) ? "American Express" : "Paypal"); ?></label>
        </div>
        <div class="info">
            <label class="naming">Numéro de carte :</label>
            <label class="info"><?php echo $bank_carte; ?></label>
        </div>
        <div class="info">
            <label class="naming">Nom du titulaire :</label>
            <label class="info"><?php echo $bank_nom; ?></label>
        </div>
        <div class="info">
            <label class="naming">Date d'expiration :</label>
            <label class="info"><?php echo $bank_date; ?></label>
        </div>

        <h2 class="text-center">Adresse de livraison</h2>
        <div class="info">
            <label class="naming">Adresse 1 :</label>
            <label class="info"><?php echo $addr1; ?></label>
        </div>
        <div class="info">
            <label class="naming">Adresse 2 :</label>
            <label class="info"><?php echo $addr1; ?></label>
        </div>
        <div class="info">
            <label class="naming">Ville :</label>
            <label class="info"><?php echo $ville; ?></label>
        </div>
        <div class="info">
            <label class="naming">Code Postal :</label>
            <label class="info"><?php echo $codepostal; ?></label>
        </div>
        <div class="info">
            <label class="naming">Pays :</label>
            <label class="info"><?php echo $pays; ?></label>
        </div>
    </div>
</div>


<?php

    }
}
else{
    echo "<script>setTimeout(() => window.location.replace(\"http://localhost/ING2-TD14-GR3_PJ-PISCINE_AgoraFrancia/connexion.php?redir=".base64_encode($_SERVER['REQUEST_URI'])."\"), 0);</script>";
}

?>

<?php include("blocs/footer.php"); ?>
