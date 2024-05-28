<?php include("blocs/header.php"); ?>
<link href="CSS/inscription.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->


<div class="centre">
    <form method="post">
        <h1 class="text-center">Connexion</h1>
        <div class="form-group">
            <label for="mail">Mail :</label>
            <input type="email" class="form-control" id="mail" name="mail" maxlength="256" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="Connexion" class="btn">Connexion    <img src="CSS/images/inscription.png" alt="logo" class="imgInscription"></button>
    </form>
</div>

<?php
    if(isset($_POST['Connexion'])){
        $init_connexion_login = $_POST['mail'];
        $init_connexion_pass = sha1($_POST['password']);
        include("blocs/init_connexion.php");

        if(isset($_GET["redir"])){
            if($_GET["redir"] != ""){
                echo $_GET["redir"];
                echo "<script>setTimeout(() => window.location.replace(\"".base64_decode($_GET["redir"])."\"), 3000);</script>";
            }
        }

    }

?>

<?php include("blocs/footer.php"); ?>