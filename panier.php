<?php include("blocs/header.php"); ?>

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

<link href="CSS/mon_compteA.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="personnal-info"> 
    <div class="titreMain">Mon Panier</div>
</div>

<div class="container">
    <div class="col colG">
        <form method="post">
        <h2 class="text-center">Résumé de commande</h2>
        <div class="info">
            <label class="info"> Sous total :</label>
        </div>

        <div class="info">
        <label class="naming">- Gode or platine ancéstral</label>
        <label class="info"> 2 198€</label>  
    </div>
    <div class="info">
        <label class="naming">- Saucisse taille M parcque c'est trop bon</label>
        <label class="info"> 2.98€</label>  
    </div>

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
        
    <div class="personnal-info"> 
        <div class="titreMain">Mes articles</div>
    </div>  

    <div class="article-colG col">



        <div class="prodG">
            <img src="CSS/images/produit.png" alt="Image produit" class="imgProd">
            <h2>Nom du produit</h2>
        </div>
        <div class="infoProd">
            <h2>Prix: $XX.XX</h2>
                <div class="Prod">
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                </div>
            <button class="delete-button">Supprimer l'article</button>
        </div>
    </div>

    <div class="article-colG col">
        <div class="prodG">
            <img src="CSS/images/produit.png" alt="Image produit" class="imgProd">
            <h2>Nom du produit</h2>
        </div>
        <div class="infoProd">
            <h2>Prix: $XX.XX</h2>
                <div class="Prod">
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                    Miam le Caca c'est délicieux, je vous la garanti, MIAM MIAM j'ADORE le KK !!
                </div>
            <button class="delete-button">Supprimer l'article</button>
        </div>
    </div>

    







  
    
</div>

<?php include("blocs/footer.php"); ?>
