<?php include("blocs/header.php"); ?>
<link href="CSS/mon_compteA.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="personnal-info" id="panier"> 
    <div class="titreMain">Mon Panier</div>
</div>


<?php 

        $requete = "SELECT * FROM theme";
        $result = mysqli_query($db_handle, $requete);

        $theme = "";
        $reduction = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['active'] != "0"){$theme = $row['nom'];}
            $reduction = intval($row['active']);
        }

        if($theme == ""){
            ?> <link href="CSS/index.css" rel="stylesheet"> <?php
        }
        else if($theme == "noel"){
            ?> <link href="CSS/index2.css" rel="stylesheet"> <?php
        }

    ?>


<?php
if($logged != 0){
    # Infos utilisateur
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

        $bank_type_disp = "";
        $bank_types = ["VISA", "Mastercard", "American Express", "Paypal"]; 
        $bank_type_disp = $bank_types[intval($bank_type)];
    }

    $articles = [];
    $requete = "SELECT * FROM articles AS A, (SELECT article, type FROM panier WHERE acheteur = " . $logged . ") AS P WHERE A.id = P.article";
    $result_base = mysqli_query($db_handle, $requete);
    while ($data_base = mysqli_fetch_assoc($result_base)) {
        #ID VENDEUR
        $id_article =       $data_base['id'];
        $vendeur =          $data_base['vendeur'];

        #INFOS
        $titre =            $data_base['titre'];
        $prix =             $data_base['prix'];
        $description =      $data_base['description'];
        $categorie =        $data_base['categorie'];
        $etat =             $data_base['etat'];

        #TYPES
        $type_vd =          $data_base['type_vd'];
        $type_nego =        $data_base['type_nego'];
        $type_enchere =     $data_base['type_enchere'];

        #IMG
        $img1 =             $data_base['img1'];
        $limite_tps =       $data_base['limite_tps'];

        #FIN
        $fin =              $data_base['fin'];

        $type = -1;
        $type_disp = "";
        $types = [$type_vd, $type_nego, $type_enchere];
        $types_string = ["Vente directe", "Negociation", "Enchere"]; 
        for($i = 0; $i < count($types_string); $i++){
            $type = (intval($types[$i] == 1)) ? $i : $type;
            $type_disp = (intval($types[$i] == 1)) ? $types_string[$i] : $type_disp ;
        }
        $etat_disp = "";
        $etat_bdd = ["n", "cn", "be", "abe"];
        $etat_string = ["Neuf", "Comme Neuf", "Bon Etat", "Assez Bon Etat"]; 
        for($i = 0; $i < count($etat_string); $i++){
            $etat_disp = (intval($etat_bdd[$i] == $etat)) ? $etat_string[$i] : $etat_disp ;
        }
        $categorie_disp = "";
        $categorie_string = ["Rare", "Haut de Gamme", "Régulier"]; 
        $categorie_disp = $categorie_string[$categorie];

        $prix_temporaire = 0;   #Afficher si le prix est temporaire
        $retirer_panier = 1;    #Produit retirable du panier
        if($type == 0){
            $prix_temporaire = 0;
            $retirer_panier = 1;
        }
        else if($type == 1){
            $retirer_panier = 0;
            $prix_temporaire = 1;
            $requete = "SELECT * FROM op_nego WHERE article = " . $id_article . " AND acheteur = " . $logged . " ORDER BY nb_op ASC";
            $result = mysqli_query($db_handle, $requete);
            $prix_detecte = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $prix_detecte = intval($data['prix']);
                $prix_temporaire = (intval($data['fin']) == 1) ? 0 : 1;
            }
            if($prix_temporaire == 1){
                $prix = $prix;
            }
            else{
                $prix = $prix_detecte;
            }
        }
        else if($type == 2){
            $retirer_panier = 0;
            $prix_temporaire = 1;
            $datelimite = date('Y-m-d H:i:s', strtotime($limite_tps));
            if(date("Y-m-d H:i:s") < $datelimite){
                $prix_temporaire = 1;
            }
            else{
                $requete = "SELECT * FROM op_enchere WHERE article = " . $id_article . " ORDER BY prix DESC";
                #echo $requete;
                $result = mysqli_query($db_handle, $requete);
                $win = 0;
                $prix_temp = 0;
                while ($data = mysqli_fetch_assoc($result)) {
                    $prix_temp = $prix;
                    $prix = intval($data['prix']);
                    $win = intval($data['acheteur']);
                }
                if($win != $logged){
                    $requete = "DELETE FROM panier WHERE article = " . $id_article . " AND acheteur = " . $logged;
                    $result = mysqli_query($db_handle, $requete);
                }
                else{
                    $retirer_panier = 0;
                    $prix_temporaire = 0;
                    $prix = $prix_temp + 1;
                }
            }
        }


        $articles[] = [
            "id" => $id_article,
            "type" => $type,
            "titre" => $titre,
            "description" => $description,
            "categorie" => $categorie_disp,
            "etat" => $etat_disp,
            "type_de_vente" => $type_disp,
            "image" => $img1,
            "prix" => $prix,
            "prix_temporaire" => $prix_temporaire,
            "retirer_panier" => $retirer_panier
        ];

    }

?>

<div class="container">
    <div class="col colG">
        <form method="post">
            <h2 class="text-center">Résumé de commande</h2>
            <div class="info">
                <label class="info">Sous total :</label>
            </div>

            <?php
                for($i = 0; $i < count($articles); $i++){
                    ?>
                        <div class="info">
                            <label class="naming"><?php echo $articles[$i]['titre']; ?></label>
                            <label class="info"><?php echo $articles[$i]['prix']; ?>€ <?php if($articles[$i]['prix_temporaire'] == 1){echo " (TEMPORAIRE)";} ?></label>  
                        </div>
                    <?php 
                }
            ?>
        
            <div class="info">
                <label class="info"> Promotion :</label>
            </div>
            <div class="info">
                <label class="naming">Promotion :</label>
                <label class="info">-<?php $reduction ?>€ (<?php $theme ?>)</label>  
            </div>

            <div class="info">
                <label class="info"> Livraison :</label>
            </div>
            <div class="info">
                <label class="naming">Frais de livraison :</label>
                <label class="info"> 0.00€</label>  
            </div>

            <h2 class="text-center">Total</h2>
            <div class="info">
                <label class="naming">Total de la commande :</label>
                <?php 
                    $total = 0;
                    $lock = 0;
                    for($i = 0; $i < count($articles); $i++){
                        $total += $articles[$i]['prix'];
                        $lock = ($articles[$i]['prix_temporaire'] == 1) ? 1 : $lock;
                    }
                ?>
                <label class="info"><?php echo ($total-$reduction); ?>€</label>  
            </div>
            <input type="hidden" name="prix" value="<?php echo ($total-$reduction); ?>">
            <button class="validation-button" name="Payer" <?php echo ($lock == 1) ? "disabled" : ""; ?>>Passer à la caisse</button>

            </div>
        
        </form>



        <div class="col colD">

            <h2 class="text-center">Informations Bancaires</h2>
            <div class="info">
                <label class="naming">Type de carte :</label>
                <label class="info"><?php echo $bank_type_disp; ?></label>
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
                <label class="naming">Date d'éxpiration :</label>
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
</div>
        
<div class="personnal-info"> 
    <div class="titreMain">Mes articles</div>
</div>  








<br>
    <?php  
        for($i = 0; $i < count($articles); $i++){
    ?>
        <div class="article-colG col">
            <div class="prodG">
                <img src="<?php echo $articles[$i]['image']; ?>" alt="Image produit" class="imgProd">
                <h2><a href="articles.php?article=<?php echo $articles[$i]['id'] ?>&type=<?php echo $articles[$i]['type']?>"><?php echo $articles[$i]['titre']; ?></a></h2>
            </div>
            <form class="infoProd" method="post">
                <h2>Prix: <?php echo $articles[$i]['prix']; ?>€<?php if($articles[$i]['prix_temporaire'] == 1){echo " (TEMPORAIRE)";} ?></h2>
                    <div class="Prod">
                        <?php echo $articles[$i]['description']; ?>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $articles[$i]['id'] ?>">
                <button name="SupprimerPanier" class="delete-button" <?php echo ($articles[$i]['retirer_panier'] == 0) ? "disabled" : "" ?> type="submit" >Supprimer l'article</button>
            </form>
        </div>
    <?php
        }
    ?>

<?php
if(isset($_POST['SupprimerPanier'])){
    $requete = "DELETE FROM panier WHERE article = " . $_POST['id'] . " AND acheteur = " . $logged;
    $result = mysqli_query($db_handle, $requete);
    echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
}
if(isset($_POST['Payer'])){
    $prix = intval($_POST['prix']);
    $solde = intval($_POST['prix']) + rand(rand(-1000, 0), rand(0, 1000));
    $condition = ($prix <= $solde) ? 1 : 0;
    if($condition == 1){
        $alert = "PAIEMENT ACCEPTE : Vous avez été débité de " . $prix . "€. (Solde : " . $solde . "€ -> " . ($solde-$prix) . "€)";
        $requete = "SELECT * FROM articles AS A, (SELECT article, type FROM panier WHERE acheteur = " . $logged . ") AS P WHERE A.id = P.article";
        $result = mysqli_query($db_handle, $requete);
        while ($data = mysqli_fetch_assoc($result)) {
            $requete2 = "DELETE FROM articles WHERE id = " . $data['id'];
            $result2 = mysqli_query($db_handle, $requete2);
        }

        $to = $mail;


        $today = new DateTime('now');
        // Ajouter 3 jours à la date du jour
        $threeDays = $today->add(new DateInterval('P3D'));
        // Formater la date dans le format souhaité
        $formattedDate = $threeDays->format('Y-m-d');
        $minHour = 8;
        $maxHour = 19;
        // Generate random hour within the range
        $randomHour = rand($minHour, $maxHour);
        // Generate random minutes between 0 and 59
        $randomMinute = rand(0, 59);
        // Format the time string
        $randomTime = $randomHour . ':' . $randomMinute;



            ini_set('SMTP','smtp.gmail.com');
            ini_set('smtp_port', '465');
            ini_set('sendmail_from','agorafranciaece@gmail.com'); # works ok: from and to email addresses handled correctly
            #ini_set('sendmail_from','rogerkeeling@f2s.com'); #appears to work (no error reported) but no email arrives
            
            // Multiple recipients
            $to = $mail . ', '; // note the comma

            // Subject
            $subject = 'Agora Francia - Votre Commande';

            // Message
            $message = "<p>" . "Bonjour, \n\nMerci pour votre commande\n\nVotre commande effectuée sur notre site aujourd'hui vient d'être soldée (Prix : " . $prix . "€).\n\nVotre colis sera emballé et mis en livraison sous 3 jours ouvrés.\n\nEstimation de livraison : le " . $formattedDate . " à " . $randomTime . ".\n\nMerci et bonne journée." . '<p>' ;


            // To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // Additional headers
            $headers[] = 'To: ' . $pseudo . " <" . $mail . ">, " ;
            $headers[] = 'From: ' . "Agora Francia " . '<agorafranciaece@gmail.com>';
            $ok=mail($to,$subject,$message,"");
            echo ("rwk1".$ok."rwk2");
            // Mail it
            if(mail($to, $subject, $message, implode("\r\n", $headers))){echo "sgehkbqegkjbgkjzbgkjzg";};

    }
    else{
        $alert = "PAIEMENT REFUSE : Solde insuffisant (" . $solde . "€), vous n'avez pas été débité. (Solde minimum requis : " . $prix . "€)";
    }
    
    #echo "<script>setTimeout(() => window.location.replace(\"\"), 0);</script>";
}
?>


<?php 

}
else{
    echo "<script>setTimeout(() => window.location.replace(\"connexion.php?redir=".base64_encode($_SERVER['REQUEST_URI'])."\"), 0);</script>";
}

?>






    







  
    
</div>

<?php include("blocs/footer.php"); ?>
