<?php 

    # Connexion à la base de données
    $database = "agorafrancia";
    $db_handle = mysqli_connect('localhost', 'root', '' );
    $db_found = mysqli_select_db($db_handle, $database);

?>

<?php 

    # Connexion au compte utilisateur
    session_start();
    $logged = 0;
    if(isset($_SESSION['id'])){
        if($_SESSION['id'] != 0){
            $logged = $_SESSION['id'];
            echo "LOG CONFIRME : ".$_SESSION['id'];
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/header.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->
    <link href="CSS/footer.css" rel="stylesheet">

</head>
<body>
    <div class = "header">
>
            <img src="CSS/images/logo.png" alt="logo" class="logo">
            <h2>AGORA FRANCIA</h2>

        <div class = "menu">
            <button><a href ="index.php">Accueil</a> </button>
            <button><a href ="parcourir.php">Parcourir</a></button>
            <button><a href ="notification.php">Notifications</a></button>
            <button><a href ="panier.php">Panier</a></button>
            <button><a href ="compte.php">Votre Compte</a></button>
        </div>
        <div class = "droite">
        <img src="CSS/images/panier.png" alt="panier" class="panier">
        </div>



</div>


