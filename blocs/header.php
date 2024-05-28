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
    <link href="../CSS/styles.css" rel="stylesheet"> <!-- Inclusion du fichier CSS personnalisé -->
</head>
</head>
<body>
    <header>
        
        agorafrancia
        <button><a href ="index.php">Accueil</a></button>
        <button><a href ="parcourir.php">Parcourir</a></button>
        <button><a href ="notification.php">Notifications</a></button>
        <button><a href ="panier.php">Panier</a></button>
        <button><a href ="compte.php">Votre Compte</a></button>
        <button><a href ="compte.php">NOM DE COMPTE</a></button>

    </header>


