<?php
require_once '../inc/init.php';
require_once "../inc/header.php";

// On récupère les informations de la réservation
$resultat=executeRequete("SELECT * FROM reservation WHERE id_reservation = id_reservation");
// Cette ligne exécute une requête SQL pour sélectionner toutes les colonnes de la table "reservation" où l'ID de la réservation est égal à l'ID de la réservation. Les résultats sont stockés dans la variable "$resultat".
$row = $resultat->fetch(PDO::FETCH_ASSOC);//: Cette ligne récupère les données de la première ligne de la variable "$resultat" et les stocke dans un tableau associatif nommé "$row".

if(isset($_GET['id_reservation'])) {// Cette instruction vérifie si l'ID de la réservation a été transmis en utilisant le paramètre GET. Si c'est le cas, le code à l'intérieur des accolades est exécuté.
    // Récupération de l'ID de la réservation
    $id_reservation = intval($_GET['id_reservation']);//Cette ligne récupère la valeur de l'ID de la réservation transmis en utilisant le paramètre GET et la convertit en entier en utilisant la fonction "intval".
    if ($id_reservation <= 0) {//Cette instruction vérifie si l'ID de la réservation est inférieur ou égal à 0. Si c'est le cas, cela signifie que l'ID n'est pas valide, donc le code à l'intérieur des accolades est exécuté pour afficher un message d'erreur et quitter le script.
        echo "Invalid ID";
        exit();
    }
    // On met à jour le statut de la réservation
    $resultat=executeRequete("UPDATE reservation SET status = 0 WHERE id_reservation = id_reservation");// Cette ligne exécute une requête SQL pour mettre à jour la colonne "status" de la table "reservation" pour la réservation correspondante à l'ID transmis en utilisant le paramètre GET. La valeur 0 indique que la réservation est annulée.
    // On vérifie que la mise à jour a été effectuée avec succès
    if ($resultat) {//Cette instruction vérifie si la mise à jour a été effectuée avec succès. Si c'est le cas, le code à l'intérieur des accolades est exécuté.

       
            // on envoi un mail de notification à l'utilisateur
    $resultat = executeRequete("SELECT * FROM reservation WHERE id_reservation = id_reservation");//Cette ligne exécute une requête SQL pour sélectionner toutes les colonnes de la table "reservation" où l'ID de la réservation est égal à l'ID de la réservation transmis en utilisant le paramètre GET. Les résultats sont stockés dans la variable "$resultat".
    $row = $resultat->fetch(PDO::FETCH_ASSOC);//Cette ligne récupère les données de la première ligne de la variable "$resultat" et les stocke dans un tableau associatif nommé "$row".
    $to = $row['email'];// Cette ligne récupère l'adresse email de l'utilisateur à partir du tableau associatif "$row" et la stocke dans la variable "$to" pour utiliser dans l'envoi de mail.
    $subject = 'Annulation de votre réservation';//Cette ligne définit le sujet du mail de notification.
    $message = 'Bonjour ' . $row['nom'] . ', nous sommes désolés de vous informer que votre réservation pour le ' . date('d/m/Y H:i', strtotime($row['date'])) . ' a été annulée.';//Cette ligne compose le message à envoyer dans le mail de notification en utilisant des informations de la réservation tels que le nom de l'utilisateur, la date de la réservation, le message d'annulation.

echo 'Réservation annulée !<br>Un mail de notification a été envoyé à l\'utilisateur';
} else {
echo 'Erreur lors de l\'annulation de la réservation';
}
}




?>
 <?php require_once "../inc/footer.php"; ?>