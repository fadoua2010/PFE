<?php
require_once '../inc/init.php';
require_once "../inc/header.php";

// On exécute la requête pour récupérer les réservations
$resultat = executeRequete("SELECT * FROM commande ");//Cette ligne récupère tous les enregistrements de la table "commande" en utilisant la fonction executeRequete, qui est probablement une fonction 
// Affichage de la liste des commandes

echo "<table border='1'  style=margin-left:30%;border-collapse: collapse ' cellpadding='7'>";
echo "<tr><td colspan='6'>Liste des commandes</td></tr>";
echo "<tr><th>Numéro de commande</th><th>Id client</th><th>Montant</th><th>Actions</th></tr>";
while ($commande = $resultat->fetch(PDO::FETCH_ASSOC)) {//Cette ligne démarre une boucle while qui parcourt les résultats stockés dans la variable $resultat. La méthode fetch est utilisée pour récupérer la prochaine ligne de données du jeu de résultats et renvoie un tableau de données avec les noms de colonne comme clés.
    //var_dump($commande);
    echo '<tr>';
    echo '<td>' . $commande['id_commande'] . '</td>';
    echo '<td>' . $commande['id_membre'] . '</td>';
    echo '<td>' . $commande['montant'] . ' €</td>';
   
  
    
    echo "<td> <a href='?action=accepter&id_commande=". $commande['id_commande'] ."'>Accepter</a><br> <a href='?action=annuler&id_commande=". $commande['id_commande'] ."'>Annuler</a></td>";//Cette ligne crée deux hyperliens, l'un pour accepter la commande, et l'autre pour annuler la commande, et ajoute l'id de commande à la chaîne de requête.
  
   
    echo "</tr>";
   
}
echo "</table>";

if(isset($_GET['id_commande']) && isset($_GET['action'])) {//Cette ligne vérifie s'il existe des paramètres id_commande et action dans la chaîne de requête, et s'ils sont définis.
    $id_commande = (int) $_GET['id_commande'];//Cette ligne récupère la valeur de l'id_commande dans la chaîne de requête et la convertit en entier.
    $action = $_GET['action'];//Cette ligne récupère la valeur de l'action dans la chaîne de requête.
    // Mise à jour de l'état de la commande en fonction de l'action demandée
    if($action == 'accepter') {//Cette ligne vérifie si l'action demandée est "accepter"
       // $resultat=executeRequete =("UPDATE commande SET etat = 1 WHERE id_commande = '$id_commande'");
       $resultat=executeRequete("UPDATE commande SET etat = 1 WHERE id_commande = id_commande");// Cette ligne met à jour l'état de la commande en 1 dans la base de données.
      
        if($resultat){//Cette ligne vérifie si la mise à jour s'est bien déroulée
            echo "Commande acceptée avec succès";
        } else {
            echo "Une erreur s'est produite lors de l'acceptation de la commande";
        }
    } elseif($action == 'annuler') {
        $resultat=executeRequete("UPDATE commande SET etat = 0 WHERE id_commande = id_commande");//Cette ligne met à jour l'état de la commande en 0 dans la base de données.
        if($resultat){
            echo "Commande annulée avec succès";
        } else {
            echo "Une erreur s'est produite lors de l'annulation de la commande";
        }
    }
}













?>