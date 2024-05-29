<?php
    $requete = "SELECT id FROM utilisateurs WHERE pseudo = \"" . $init_connexion_pseudo . "\" and mail = \"" . $init_connexion_login . "\" and password = \"" . $init_connexion_pass . "\"";
    $result = mysqli_query($db_handle, $requete);
    $occ = 0;
    $id = 0;
    while ($data = mysqli_fetch_assoc($result)) {
        $occ += 1;
        $id = (int)$data['id'];
    }
    if($occ == 1){
        $_SESSION['id'] = $id;
    }
    else{
        $alert = "Adresse-mail ou mot de passe incorrect";
    }
?>