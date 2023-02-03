
<?php
require_once 'inc/init.php';
require_once "inc/header.php";


//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier'])) //Cette ligne vérifie si le formulaire d'ajout au panier a été soumis en vérifiant si la variable $_POST['ajout_panier'] est définie.
{   // debug($_POST);
    $resultat = executeRequete("SELECT * FROM plat WHERE id_plat='$_POST[id_plat]'");
    //Cette ligne exécute une requête SQL pour récupérer les informations du produit dans la base de données en utilisant la fonction "executeRequete()".
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);// Cette ligne récupère les données de la requête SQL sous forme de tableau associatif.
    ajouterProduitDansPanier($produit['titre'],$_POST['id_plat'],$_POST['quantite'],$produit['prix']);
    //Cette ligne utilise la fonction "ajouterProduitDansPanier()" pour ajouter le produit au panier en passant en paramètres le titre, l'id, la quantité et le prix du produit.
}

//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")//Cette ligne vérifie si l'action de vider le panier a été demandée en vérifiant si la variable $_GET['action'] est définie et égale à "vider".
{
    unset($_SESSION['panier']);//Si la condition est remplie, cela signifie que l'utilisateur a demandé à vider le panier, la ligne suivante utilise la fonction "unset()" pour supprimer la variable de session 'panier' pour vider le panier.
}
//--------------------------
if(isset($_POST['valider'])) {// Cette ligne vérifie si le formulaire de validation de commande a été soumis en vérifiant si la variable $_POST['valider'] est définie.
    // Cette ligne récupère les id des produits dans le panier à partir de la variable de session.(réquepération des donner)
    $id_produits = $_SESSION['panier']['id_produit'];
    $quantites = $_SESSION['panier']['quantite'];
    $prix_totaux = $_SESSION['panier']['prix'];// Cette ligne récupère les prix totaux des produits dans le panier à partir de la variable de session.
   

    // Récupération des informations de l'utilisateur connecté
    $id_membre = $_SESSION['membre']['id_membre'];
    $nom = $_SESSION['membre']['nom'];
    $prenom = $_SESSION['membre']['prenom'];
    $adresse = $_SESSION['membre']['adresse'];
    $ville = $_SESSION['membre']['ville'];
    $code_postal = $_SESSION['membre']['code_postal'];
    $email = $_SESSION['membre']['email'];

    
  // Insertion de la commande dans la base de données
  $resultat = executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement,  etat,numero_commande) VALUES ('$id_membre','".montantTotal()."', NOW(), 'en cours de traitement','".generateOrderNumber()."')");
  //Cette ligne insère les informations de la commande dans la base de données en utilisant la fonction "executeRequete()". Elle récupère également l'id de la commande générée.
    $id_commande = $resultat->fetch(PDO::FETCH_ASSOC);//Cette ligne récupère les données de la requête SQL sous forme de tableau associatif.
 

       // Insertion des détails de la commande dans la base de données
       //executeRequete Cette ligne insère les détails de la commande pour chaque produit dans la base de données en utilisant la fonction "executeRequete()".
       for($i = 1; $i < count($id_produits); $i++) {//Cette ligne débute une boucle qui va itérer à travers tous les produits dans le panier.
        executeRequete("INSERT INTO details_commande (id_commandes, id_produit, quantite, prix) VALUES ('$id_commande', '$id_produits[$i]', '$quantites[$i]', '$prix_totaux[$i]')");
    }

     //Vidage du panier
    unset($_SESSION['panier']);// Cette ligne utilise la fonction "unset()" pour supprimer la variable de session 'panier' pour vider le panier après la validation de la commande.

    // Affichage d'un message de confirmation
    $contenu .= "<div class='validation'>Votre commande a été validée. Un email de confirmation vous a été envoyé.</div>";
}

echo $contenu;

//--------------------------------- AFFICHAGE HTML ---------------------------------//

echo $contenu;
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Quantité</th><th>Prix Unitaire </th></tr>";
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) 
    {
        echo "<tr>";
        echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
        "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
        echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
        echo "</tr>";
    }
    echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " euros</td></tr>";
    if(estConnecte()) 
    {
        echo '<form method="post" action="">';
        echo '<tr><td colspan="5"><input type="submit" name="valider" value="Valider "></td></tr>';
        echo '</form>';   
    }
    else
    {
        echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
    }
    echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
   
}
echo "</table><br>";
echo "<i>Réglement uniquement par ecpéce</i><br>";
// echo "<hr>session panier:<br>"; debug($_SESSION);
        


?>

 <?php require_once "inc/footer.php"; ?>