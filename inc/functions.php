<?php

//fonction pour l'aide au debug et verification du code lors de la construction du site
function debug($variable)
{
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
}

//fonction pour vérifier si l'internaute est connecté
function estConnecte(){// cette fonction indique si l'internaute est connecté
    if (isset($_SESSION['membre'])) {// si existe "membre" dans la session, c'est que l'internaute est passé par la page de connexion avec les bons identifiants et que nous avons rempli cette session avec ses identifiants
        return true;// il est connecté
    }else{
        return false;// il n'est pas connecté
    }
}

// fonction pour vérifier si l'internaute connecté est flaguée "admin"
function estConnecteAdmin(){// cette fonction indique si l'internaute est connecté ET est admin
    if (estConnecte() AND $_SESSION['membre']['statut'] == 1) {// si l'internaute est connecté ET que le statut du "membre" dans la session est égal à 1 c'est que l'internaute est admin
        return true;// il est admin
    }else{
        return false;// il n'est pas admin (ou n'est pas connecté)
    }
}



//----------------------------
// fonction qui exécute des requêtes

function executeRequete($requete, $param = array())
{// le paramètre $requete attend de recevoir une requête SQL sous forme de string. $param attend un array avec les marqueurs associés à leur valeur. Ce paramètre est optionnel car on lui a affecté un array() vide par défaut

    foreach ($param as $indice => $valeur) {
        $param[$indice] = htmlspecialchars($valeur);
    } // htmlspecialchars transforme les chevrons pour neutraliser les balises <script> et <style> Dans cette boucle on prend à chàque tour de boucle la valeur du tableau $param que l'on échappe et que l'on réaffecte à son emplacement d'origine 

    global $pdo; // on accède à la variable globale $pdo qui est déinit dans init.php à l'extérieur de cette fonction

    // requête préparée
    $resultat = $pdo->prepare($requete); // on prépare la requête envoyée à notre fonction
    $succes = $resultat->execute($param); // puis on exécute la requête en lui passant le tableau qui contient les marqueurs et leur valeurs pour faire les bindParam (cette opération est faite même si elle n'est pas écrite dans le code). On récupère dans la variable $succes true si la requête a marché sinon false

    if ($succes) {
        return $resultat; // si $succes contient true, la requête a marché, je retourne le résultat de ma requête
    } else {
        return false; // si la requête n'a pas marché on retourne false
    }
}

//fonction utilisée pour créer un nouveau panier d'achat pour l'utilisateur.
function creationDuPanier()
{
   if(!isset($_SESSION['panier']))//vérifier si une variable de session appelée "panier" a été définie. Si elle n'a pas été définie, le code à l'intérieur de l'instruction "si" sera exécuté.
   {
      $_SESSION['panier'] = array();//crée une nouvelle variable de session appelée "panier" et lui affecte un tableau vide.
      $_SESSION['panier']['titre'] = array();
      $_SESSION['panier']['id_produit'] = array();
      $_SESSION['panier']['quantite'] = array();
      $_SESSION['panier']['prix'] = array();
      //créent de nouveaux tableaux à l'intérieur de la variable de session "panier" pour stocker les différents types d'informations associées aux produits dans le panier, tels que le titre, l'ID, la quantité et le prix.
   }
}

//------------------------------------
function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix)
//cette fonction  utilisée pour ajouter un produit au panier d'achat de l'utilisateur. La fonction prend quatre paramètres: $titre, $id_produit, $quantite et $prix, qui représentent le titre, l'ID, la quantité et le prix du produit qui est ajouté au panier.
{
    creationDuPanier(); 
    //appelle la fonction "creationDuPanier()" pour s'assurer que la variable de session du panier existe avant de tenter d'y ajouter des produits.
    $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
    //la fonction "array_search()" pour rechercher l'ID du produit dans le tableau "id_produit" de la variable de session "panier". Si l'ID du produit est trouvé, la position du produit dans le tableau est stockée dans la variable $position_produit.
    if($position_produit !== false)
    // une instruction if pour vérifier si l'ID du produit a été trouvé dans le tableau "id_produit". Si c'est le cas, le code à l'intérieur de l'instruction if est exécuté.
    {
         $_SESSION['panier']['quantite'][$position_produit] += $quantite ;// augmente la quantité du produit existant dans le panier de la quantité spécifiée dans l'appel de la fonction.
    }
    else//l'instruction "else" pour gérer le cas où l'ID du produit n'a pas été trouvé dans le tableau "id_produit".
    {
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
        //ajoutent le titre, l'ID, la quantité et le prix du nouveau produit aux tableaux correspondants dans la variable de session "panier".
    }
}
//------------------------------------
function montantTotal()
// une fonction appelée "montantTotal()", qui est utilisée pour calculer le montant total des articles dans le panier d'achat de l'utilisateur.
{
   $total=0;//déclare une variable $total et la initialise à 0, qui servira à stocker le montant total.
   for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
   //une boucle "for" pour parcourir les différents produits dans le panier. La variable $i est utilisée comme compteur pour la boucle et est définie comme étant égale à 0. La condition de la boucle est que $i est inférieur au nombre d'éléments dans le tableau "id_produit" de la variable de session "panier". Le $i est incrémenté à chaque tour de boucle.
   {
      $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
      //tilise l'opérateur d'addition pour ajouter le produit (quantité x prix) de chaque produit dans le panier au total.
   }
   return round($total,2); // utilise la fonction "round()" pour arrondir le total à 2 chiffres après la virgule. l'instruction "return" pour retourner la valeur calculée de total.
}
//------------------------------------
function retirerProduitDuPanier($id_produit_a_supprimer)
//La fonction "retirerProduitDuPanier()" prend en paramètre l'identifiant du produit à supprimer.

{
    $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
    //La variable "position_produit" est définie en utilisant la fonction "array_search()" pour trouver la position du produit dans le tableau "id_produit" de la session "panier".
    if ($position_produit !== false)//La condition "if ($position_produit !== false)" vérifie si le produit a été trouvé dans le panier. Si c'est le cas, on entre dans la condition.
    {
        //La fonction "array_splice()" est utilisée pour supprimer les éléments correspondant au produit dans les tableaux "titre", "id_produit", "quantité" et "prix" de la session "panier".
        array_splice($_SESSION['panier']['titre'], $position_produit, 1);
        array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);
        /*La fonction array_splice() prend 3 paramètres :
    Le premier est le tableau cible
    Le deuxième est l'index de l'élément à supprimer
    Le troisième est le nombre d'éléments à supprimer à partir de l'index donné
    La fonction se termine une fois que tous les éléments du produit ont été retirés du pani*/
    }
}

//----------------------------------------------------------------------------------
function generateOrderNumber()// une fonction nommée "generateOrderNumber" qui ne prend pas d'arguments.qui génère un numéro de commande unique en combinant un horodatage (l'heure actuelle en secondes depuis l'époque Unix) et un nombre aléatoire entre 1000 et 9999. Lorsque la fonction est appelée, elle affecte le numéro de commande généré à la variable $unique_order_number.
{
    $timestamp = time();//crée une variable locale appelée $timestamp qui est égale à la fonction "time()", qui retourne le temps actuel en secondes
    $random_number = rand(1000,9999);// crée une variable locale appelée $random_number qui est égale à un nombre aléatoire compris entre 1000 et 9999 en utilisant la fonction "rand(1000,9999)".
    $orderNumber = $timestamp . $random_number;//crée une variable locale appelée $orderNumber qui est égale à la concaténation de la variable $timestamp et de la variable $random_number.
    return $orderNumber;// la fonction "return" pour renvoyer la valeur de la variable $orderNumber.
}

$unique_order_number = generateOrderNumber();//appelle la fonction generateOrderNumber() et stock le retour de la fonction dans la variable $unique_order_number.