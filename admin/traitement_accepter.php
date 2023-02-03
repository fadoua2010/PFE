<?php
require_once '../inc/init.php';
require_once "../inc/header.php";


if(isset($_GET['id_reservation'])) {//Le code démarre une instruction if qui vérifie si la variable "id_reservation" est présente dans l'URL en utilisant la fonction "isset()"
    // Récupération de l'ID de la réservation
    $id_reservation = intval($_GET['id_reservation']);//Cette ligne récupère la valeur de l'ID de la réservation transmis en utilisant le paramètre GET et la convertit en entier en utilisant la fonction "intval". La fonction intval() convertit la valeur passée en argument en entier. Elle retourne 0 si l'argument n'est pas un entier.
    if ($id_reservation <= 0) {//Cette instruction vérifie si la valeur de la variable "id_reservation" est inférieure ou égale à 0. Si c'est le cas, cela signifie que l'ID n'est pas valide, donc le code à l'intérieur des accolades est exécuté.
        echo "Invalid ID";
        exit();
    }//À l'intérieur de l'instruction if, le code récupère la valeur de la variable "id_reservation" et la convertit en entier en utilisant la fonction "intval()". Il assigne cette valeur entière à la variable "id_reservation
   // On met à jour le statut de la réservation/Le code vérifie si "id_reservation" est supérieur à 0, s'il ne l'est pas, il affiche "Invalid ID" et sort du script en utilisant la fonction "exit()".

   $resultat=executeRequete("UPDATE reservation SET status = 1 WHERE id_reservation = id_reservation");//Le code exécute une requête SQL en utilisant la fonction "executeRequete()", pour mettre à jour le statut de la réservation dans la base de données. En définissant le statut de la réservation à 1.
   // On vérifie que la mise à jour a été effectuée avec succès
   if ($resultat) {

    
            // on envoi un mail de notification à l'utilisateur
            $resultat = executeRequete("SELECT * FROM reservation WHERE id_reservation = id_reservation");
            $row = $resultat->fetch(PDO::FETCH_ASSOC);//Cette ligne récupère les données de la première ligne de la variable "$resultat" et les stocke dans un tableau associatif nommé "$row".
            $to = $row['email'];
            $subject = 'acceptation de votre réservation';
            $message = 'Bonjour ' . $row['nom'] . ', nous sommes désolés de vous informer que votre réservation pour le ' . date('d/m/Y H:i', strtotime($row['date'])) . ' a été accepter.';

        echo 'Réservation accepter !<br>Un mail de notification a été envoyé à l\'utilisateur';
        } else {
        echo 'Erreur lors de l\'acceptation de la réservation';
        }
  
}



?>
 <?php require_once "../inc/footer.php"; ?>