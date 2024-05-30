<?php
function definirCookieAvecTableau($nomCookie, $tableau, $duree) {
    // Sérialiser le tableau
    $array_serialized = serialize($tableau);

    // Définir le cookie (nom du cookie, valeur sérialisée, durée de vie du cookie)
    setcookie($nomCookie, $array_serialized, time() + $duree); // Durée en secondes

    // Message de confirmation
    echo "Le cookie a été défini.<br>";
}
function ajouter_element_panier($id_produit, $type_vente) {
    // Récupérer le panier actuel s'il existe
    $panier = isset($_COOKIE['mon_panier']) ? unserialize($_COOKIE['mon_panier']) : array();

    // Ajouter l'élément au panier avec son type de vente
    if (isset($panier[count($panier)])) {
        // Si le produit existe déjà dans le panier, ajouter un nouveau type de vente
        array_push($panier[count($panier)], $id_produit,$type_vente);
    } else {
        // Sinon, créer une nouvelle entrée dans le panier
        $panier[count($panier)] = array($id_produit,$type_vente);
    }

    // Définir le cookie avec le nouveau panier
    setcookie('mon_panier', serialize($panier), time() + 36000); // Cookie valide pour 1 heure

    // Rediriger vers la page d'origine après l'ajout
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}


// Fonction pour supprimer un élément du panier par son identifiant
function supprimer_element_panier($id_produit, $type_vente) {
    // Récupérer le panier actuel s'il existe
    $panier = isset($_COOKIE['mon_panier']) ? unserialize($_COOKIE['mon_panier']) : array();
    for ($i=0; $i < count($panier); $i++) { 
        if($id_produit==$panier[$i][0] && $type_vente==$panier[$i][1]){
            for ($j=$i; $j <count($panier)-1; $j++) { 
                $panier[($j)][0]=$panier[($j+1)][0];
                $panier[($j)][1]=$panier[($j+1)][1];
            }
            
            unset($panier[count($panier)-1]);
            break;
        }
    }
    

    // Définir le cookie avec le nouveau panier
    setcookie('mon_panier', serialize($panier), time() + 3600); // Cookie valide pour 1 heure

    // Rediriger vers la page d'origine après la suppression
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
function recherche_panier(){
    $panier = isset($_COOKIE['mon_panier']) ? unserialize($_COOKIE['mon_panier']) : array();
    
    for($i = 0; $i < count($panier); $i++){
        if(intval($panier[$i]) == $article){
            for($j = 1; $j < count($panier[$i]); $j++){
                if($panier[$i] == $type_compte){
                    return 1;

                }
            }
        }
    }
    return 0;
}
    $panier = isset($_COOKIE['mon_panier']) ? unserialize($_COOKIE['mon_panier']) : array();
    
    for($i = 0; $i < count($panier); $i++){
        if(intval($panier[$i]) == $article){
            for($j = 1; $j < count($panier[$i]); $j++){
                if($panier[$i] == $type_compte){
                    return 1;

                }
            }
        }
    }
    return 0;
}


?>