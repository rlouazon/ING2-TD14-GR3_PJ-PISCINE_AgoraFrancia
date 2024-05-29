<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->


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
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="Connexion" class="btn">Connexion    <img src="CSS/images/inscription.png" alt="logo" class="imgInscription"></button>
        <div class="form-group">
            <label><a href="http://localhost/ING2-TD14-GR3_PJ-PISCINE_AgoraFrancia/inscription.php">Inscription</a></label>
        </div>
    </form>
</div>


<?php

    if(isset($_POST['Connexion'])){
        $init_connexion_pseudo = $_POST['pseudo'];
        $init_connexion_login = $_POST['mail'];
        $init_connexion_pass = sha1($_POST['password']);
        include("blocs/init_connexion.php");

        $delay = 0;
        include("blocs/redir.php");
    }

?>

<?php include("blocs/footer.php"); ?>