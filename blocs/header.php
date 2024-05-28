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
    echo "BASE " . $logged;
    if(isset($_SESSION['id'])){
        echo "EXIST BASE " . $logged;
        if($_SESSION['id'] != 0){
            echo "BON BASE " . $logged;
            $logged = $_SESSION['id'];
            echo "JHFIKVFOKJQFBGF : ".$logged;
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora Francia</title>
</head>
<body>