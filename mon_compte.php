<?php include("blocs/header.php"); ?>
<link href="CSS/mon_compteA.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<?php
$type_compte = 0;
if($logged != 0){
    $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
    $result = mysqli_query($db_handle, $requete);
    while ($data = mysqli_fetch_assoc($result)) {
        #ID
        $id =           $data['id'];
        $type =         $data['type'];
        $type_compte = $type;

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



<style>
body {
    background: url('<?php echo $back; ?>'); /* Utilisez un chemin relatif */
    background-size: 100% 100%;
    /*background-size: cover;*/
    background-repeat: no-repeat;
    font-family: 'Lexend', Arial, sans-serif;
    margin: 0;

    padding-top: 90px; /* Ajoutez un padding-top pour éviter que le contenu ne soit caché sous le header fixe */
    position: relative;
}
</style>

<form method="post" class="personnal-info"> 
    <div class="titreMain">Informations Personnelles    </div>
    <button type="submit" name="Deconnexion" class="btn">Deconnexion    <img src="CSS/images/deconnexion.png" alt="logo" class="imgInscription"></button>
</form>
<?php
    if(isset($_POST['Deconnexion'])){
        include('blocs/end_connexion.php');
        
    }
?>

<div class="container">
    <div class="colonnesG">
        <div class="col colG">
            <div>
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
            </div>            
        </div>
        <?php
            if($type_compte != 0){
                ?>
                    <div class = "col">
                            <button class="bouttonAjouter"><a href="ajouter_produit.php?redir=<?php echo base64_encode($_SERVER['REQUEST_URI']) ?>">Ajouter une annonce</a></button>
                    </div>
                <?php
            }
        ?>
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
            <label class="info"><?php echo $addr2; ?></label>
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

    if($type_compte == 1 || $type_compte == 2){

        if($type_compte == 2){
            ?> <div class="colonneGauche"> <?php ;
            $requete = "SELECT * FROM articles";
        }
        else{
            $requete = "SELECT * FROM articles WHERE vendeur = " . intval($id);
        }
        $result = mysqli_query($db_handle, $requete);
        while ($data = mysqli_fetch_assoc($result)) {
            #ID VENDEUR
            $id_article =       $data['id'];
            $vendeur =          $data['vendeur'];

            #INFOS
            $titre =            $data['titre'];
            $prix =             $data['prix'];
            $description =      $data['description'];
            $categorie =        $data['categorie'];
            $etat =             $data['etat'];

            #TYPES
            $type_vd =          $data['type_vd'];
            $type_nego =        $data['type_nego'];
            $type_enchere =     $data['type_enchere'];

            #IMG
            $img1 =             $data['img1'];
            $img2 =             $data['img2'];
            $img3 =             $data['img3'];
            $img4 =             $data['img4'];
            $img5 =             $data['img5'];

            #FIN
            $fin =              $data['fin'];

            $types = [$type_vd, $type_nego, $type_enchere];
            $types_string = ["Vente directe", "Negociation", "Enchere"];

            for($i = 0; $i < count($types); $i++){
                if(intval($types[$i]) == 1){
                    ?>
                
                        <form class="article-colG col" method="post">
                            <div class="prodG">
                                <img src="<?php echo $img1 ?>" alt="Image produit" class="imgProd">
                                <h2><?php echo $titre . "<br>" . " (" . $types_string[$i] . ")" ?></h2>
                            </div>
                            <div class="infoProd">
                                <h2>Prix : <?php echo $prix ?>€</h2>
                                    <div class="Prod">
                                        <?php echo $description ?>
                                    </div>
                                <input type="hidden" name="id-type_article" value="<?php echo $id_article."-".$i; ?>" />
                                <button type="submit" name="Suppression_article" class="delete-button">Supprimer l'article</button>
                            </div>
                        </form>
                                       
                    <?php
                }
            }
        }
        if($type_compte == 2){?> </div> <?php ;}

    }

    
    if($type_compte == 2){

        ?> <div class="colonneDroite"> <?php
        $requete = "SELECT * FROM utilisateurs";
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
                
                    <form class="article-colD col" method="post">
                        <div class="prodG">
                            <img src="<?php echo $photo; ?>" alt="Image client" class="imgClient">
                            <h2><?php echo $prenom . " " . $nom; ?></h2>
                        </div>
                        
                        <div class="infoClient-actions">

                            <div class="infoClient">
                                <label class="namingC">Pseudonyme :</label>
                                <label class="infoC"><?php echo $pseudo; ?></label>

                                <label class="namingC">Adresse mail :</label>
                                <label class="infoC"><?php echo $mail; ?></label>

                                <label class="namingC">Téléphone :</label>
                                <label class="infoC"><?php echo $tel; ?></label>
                            </div>
                            <input type="hidden" name="id_utilisateur" value="<?php echo $id; ?>" />
                            <div class = "role">
                                <select name="perms_utilisateur">
                                    <option value="0" <?php if($type == 0){echo "selected";} ?>>Acheteur</option>
                                    <option value="1" <?php if($type == 1){echo "selected";} ?>>Vendeur</option>
                                    <option value="2" <?php if($type == 2){echo "selected";} ?>>Administrateur</option>
                                </select>
                                <button type="submit" name="Modifier_utilisateur" class="bouttonRole"><label class="namingC">Modifier le rôle</label></button>
                            </div>
                            <button type="submit" name="Supprimer_utilisateur" class="delete-button">Supprimer l'utilisateur</button>
                        </div>
                    </form>
                
                <?php
            }
        }
        ?> </div> <?php
    }

?>


<?php

}
else{
    echo "<script>setTimeout(() => window.location.replace(\"connexion.php?redir=".base64_encode($_SERVER['REQUEST_URI'])."\"), 0);</script>";
}


if(isset($_POST['Suppression_article'])){
    $donnees = explode('-', $_POST['id-type_article']);
    if(count($donnees) == 2){
        $occ = 0;
        $requete = "SELECT * FROM articles WHERE id = " . $donnees[0] . (($type_compte != 2) ? (" AND vendeur = " . $logged) : "");
        $result = mysqli_query($db_handle, $requete);
        while ($data = mysqli_fetch_assoc($result)) {
            $occ += 1;
        }
        if($occ == 1){
            $cols = ['type_vd', 'type_nego', 'type_enchere'];
            $requete = "UPDATE articles SET " . $cols[intval($donnees[1])] . " = 0 WHERE id = " . $donnees[0] . (($type_compte != 2) ? (" AND vendeur = " . $logged) : "");
            $result = mysqli_query($db_handle, $requete);

            $requete = "SELECT * FROM articles WHERE id = " . $donnees[0] . (($type_compte != 2) ? (" AND vendeur = " . $logged) : "");
            $result = mysqli_query($db_handle, $requete);
            $sum = 0;
            $occ = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $sum = intval($data[$cols[0]]) + intval($data[$cols[1]]) + intval($data[$cols[2]]);
                $occ += 1;
            }
            if($occ == 1 && $sum == 0){
                $requete = "DELETE FROM articles WHERE id = " . $donnees[0] . (($type_compte != 2) ? (" AND vendeur = " . $logged) : "");
                $result = mysqli_query($db_handle, $requete);
            }
            echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
        }
    }
}

if(isset($_POST['Supprimer_utilisateur'])){
    $donnees = $_POST['id_utilisateur'];
    $requete = "SELECT * FROM utilisateurs WHERE id = " . $donnees;
    $result = mysqli_query($db_handle, $requete);
    $occ = 0;
    while ($data = mysqli_fetch_assoc($result)) {
        $occ += 1;
    }
    if($occ == 1){
        $requete = "DELETE FROM utilisateurs WHERE id = " . $donnees;
        $result = mysqli_query($db_handle, $requete);
    }
    echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
}

if(isset($_POST['Modifier_utilisateur'])){
    $donnees = $_POST['id_utilisateur'];
    $modif_type = $_POST['perms_utilisateur'];
    $requete = "SELECT * FROM utilisateurs WHERE id = " . $donnees;
    $result = mysqli_query($db_handle, $requete);
    $occ = 0;
    while ($data = mysqli_fetch_assoc($result)) {
        $occ += 1;
    }
    if($occ == 1){
        $requete = "UPDATE utilisateurs SET type = " . $modif_type ." WHERE id = " . $donnees;
        $result = mysqli_query($db_handle, $requete);
    }
    echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
}


?>

<?php include("blocs/footer.php"); ?>
