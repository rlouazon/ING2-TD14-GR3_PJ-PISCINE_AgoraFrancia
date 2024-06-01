<?php include("blocs/header.php"); ?>
<link href="CSS/mon_compteA.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="personnal-info" id="panier"> 
    <div class="titreMain">Mon Panier</div>
</div>


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
    }

    $articles = [];
    $requete = "SELECT * FROM articles AS A, (SELECT article, type FROM panier WHERE acheteur = " . $logged . ") AS P WHERE A.id = P.article";
    echo $requete;
    $result_base = mysqli_query($db_handle, $requete);
    while ($data_base = mysqli_fetch_assoc($result_base)) {
        #ID VENDEUR
        $id_article =       $data_base['id'];
        $vendeur =          $data_base['vendeur'];

        #INFOS
        $titre =            $data_base['titre'];
        echo $titre;
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
        
        echo " TYPE : " . $type;

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
                $requete = "SELECT * FROM op_enchere WHERE article = " . $id_article . " ORDER BY prix ASC";
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
            "id" => $id,
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

    print_r($articles);
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
        <label class="info"> 0.00€</label>  
    </div>

        <div class="info">
            <label class="info"> Livraisons :</label>
        </div>
        <div class="info">
            <label class="naming">Frais de livraisons :</label>
            <label class="info"> 0.00€</label>  
        </div>

        <h2 class="text-center">Total</h2>
        <div class="info">
            <label class="naming">Total de la commande :</label>
            <label class="info"> 2200.98€</label>  
        </div>

        <button class="validation-button">Passer à la caisse</button>

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
</div>
        
    <div class="personnal-info"> 
        <div class="titreMain">Mes articles</div>
    </div>  









    <?php  
        for($i = 0; $i < count($articles); $i++){
    ?>
        <div class="article-colG col">
            <div class="prodG">
                <img src="<?php echo $articles[$i]['image']; ?>" alt="Image produit" class="imgProd">
                <h2><?php echo $articles[$i]['titre']; ?></h2>
            </div>
            <div class="infoProd">
                <h2>Prix: <?php echo $articles[$i]['prix']; ?>€</h2>
                    <div class="Prod">
                        <?php echo $articles[$i]['description']; ?>
                    </div>
                <button class="delete-button">Supprimer l'article</button>
            </div>
        </div>
    <?php
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
