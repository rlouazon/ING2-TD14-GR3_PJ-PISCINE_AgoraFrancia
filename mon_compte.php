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
    }
}
?>

<div class="personnal-info"> 
    <div class="titreMain">Informations Personnelles</div>
</div>

<div class="container">
    <div class="col colG">
        <form method="post">
            <img src="CSS/images/pp.png" alt="photo de profil" class="pp">
            <div class="nomPrenom"> 
                <h2> Stéphane HARDEL</h2>
            </div>
            <div class="info">
                <label class="naming">Pseudonyme :</label>
                <label class="info"> Greg</label>
            </div>
            <div class="info">
                <label class="naming">Adresse mail :</label>
                <label class="info"> miamlecaca@gmail.com</label>
            </div>
            <div class="info">
                <label class="naming">Téléphone :</label>
                <label class="info"> 06 65 98 35 92</label>
            </div>
        </form>
    </div>
    <div class="col colD">
        <h2 class="text-center">Informations Bancaires</h2>
        <div class="info">
            <label class="naming">Type de carte :</label>
            <label class="info"> Visa</label>
        </div>
        <div class="info">
            <label class="naming">Numéro de carte :</label>
            <label class="info"> 0123456789012345 </label>
        </div>
        <div class="info">
            <label class="naming">Nom du titulaire :</label>
            <label class="info"> Greg le mec du meme</label>
        </div>
        <div class="info">
            <label class="naming">Date d'éxpiration :</label>
            <label class="info"> 09/28</label>
        </div>

        <h2 class="text-center">Adresse de livraison</h2>
        <div class="info">
            <label class="naming">Adresse 1 :</label>
            <label class="info"> 32 Chemin du Queric</label>
        </div>
        <div class="info">
            <label class="naming">Adresse 2 :</label>
            <label class="info"></label>
        </div>
        <div class="info">
            <label class="naming">Ville :</label>
            <label class="info"> La Trinité-sur-Mer</label>
        </div>
        <div class="info">
            <label class="naming">Code Postal :</label>
            <label class="info"> 56400</label>
        </div>
        <div class="info">
            <label class="naming">Pays :</label>
            <label class="info"> FRANCE</label>
        </div>
    </div>
</div>

<?php include("blocs/footer.php"); ?>
