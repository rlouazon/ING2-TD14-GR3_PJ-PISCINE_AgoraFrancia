<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<?php
    if($logged != 0){

        $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
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
    else{
        echo "<script>setTimeout(() => window.location.replace(\"http://localhost/ING2-TD14-GR3_PJ-PISCINE_AgoraFrancia/connexion.php?redir=".base64_encode($_SERVER['REQUEST_URI'])."\"), 0);</script>";
    }

?>




<?php include("blocs/footer.php"); ?>