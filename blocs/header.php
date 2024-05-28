<?php 

    $database = "agorafrancia";
    $db_handle = mysqli_connect('localhost', 'root', '' );
    $db_found = mysqli_select_db($db_handle, $database);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia</title>
</head>
<body>
    <header>
        <?php $alert = "bonjour"?>
        agorafrancia
        <button><a href ="index.php">Accueil</a></button>
        <button><a href ="parcourir.php">Parcourir</button>
        <button><a href ="notification.php">Notifications</button>
        <button><a href ="panier.php">Panier</button>
        <button><a href ="compte.php">Votre Compte</button>
        <button><a href ="compte.php">NOM DE COMPTE</button>

    </header>


