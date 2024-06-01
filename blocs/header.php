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
            $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
            $result = mysqli_query($db_handle, $requete);
            $occ = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $occ += 1;
            }
            if($occ != 1){
                $logged = 0;
            }
        }
    }

    /*NOTIFICATION*/
    $requete = "SELECT * FROM utilisateurs WHERE id = " . $logged;
    $result = mysqli_query($db_handle, $requete);
    $str = "";
    while ($data = mysqli_fetch_assoc($result)) {
        $str = $data['notification'];
    }
    $result = base64_decode($str);
    $array = explode("'", $result);
    if(count($array) >= 2){
        $occ = 0;
        $array[1]=base64_decode($array[1]);
        $result=$array[0]."(".$array[1].")".$array[2];
        $array2 = explode("titre = ", $result);
        $array3 = explode(" AND (categorie",$array2[1]);
        $result=$array2[0]."titre LIKE '%". $array3[0]. "%' AND (categorie".$array3[1].")";
        $fin_nego = mysqli_query($db_handle, $result);
        while ($data = mysqli_fetch_assoc($fin_nego)) {
            $occ += 1;
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="icon" href="CSS/images/logo.ico" type="image/x-icon">
</head>

<body>
    <div class = "header">
            <a href="index.php"><img src="CSS/images/logo.png" alt="logo" class="logo"></a>
            <h2>AGORA FRANCIA</h2>

        <div class = "menu">
            <button><a href ="index.php">Accueil</a> </button>
            <button><a href ="parcourir.php?categorie=3&type_achat=tout ">Parcourir</a></button>
            <button><a href ="notification.php">Notifications</a></button>
            <button><a href ="panier.php">Panier</a></button>
            <button><a href ="mon_compte.php">Votre Compte</a></button>
        </div>
        <a href="afficher_notif.php"><div class="notif" width=160 style="font-size: 15px;"><?php echo " nombre notification :" . $occ;?></div></a>
        <div class = "droite">
        <a href="panier.php"><img src="CSS/images/panier.png" alt="panier" class="panier"></a>
        </div>



</div>
<div class="contenu">


