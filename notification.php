<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->

<div class="centre">
    <form method="post" enctype="multipart/form-data"class="p-5">
        <div class="form-group">
                <label for="titre">Titre* :</label>
                <input type="text" class="form-control" name="titre" maxlength="256" required>
        </div>
        <div class="form-group">
            <label>rareté :</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="1" name="1" value="1">
                <label class="form-check-label" for="1">Articles hautes de gamme</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="2" name="2" value="2">
                <label class="form-check-label" for="2">Articles réguliers</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="0" name="0" value="0">
                <label class="form-check-label" for="0">Articles rares</label>
            </div>
        </div>

        <div class="form-group">
            <label>rareté :</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="vd" name="vd" value="vd">
                <label class="form-check-label" for="vd">Vente directe</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="enchere" name="enchere" value="enchere">
                <label class="form-check-label" for="enchere">Enchère</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="nego" name="nego" value="nego">
                <label class="form-check-label" for="nego">Vente négociation</label>
            </div>
        </div>
        

        <div class="form-group">
            <label for="prix">Prix* :</label>
            <div class="row">
                 <div class="col">
                    <input type="number" class="form-control" name="prix bas" placeholder="Prix bas" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="prix haut" placeholder="Prix haut" required>
                </div>
                
            </div>
        </div>
        <button type="submit" name="Inscription" class="btn">Enregistrer    <img src="CSS/images/inscription.png" alt="logo" class="imgInscription"></button>
    </form>
</div>

<?php include("blocs/footer.php"); ?>