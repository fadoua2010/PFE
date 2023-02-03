<?php
require_once '../inc/init.php';
require_once "../inc/header.php";

// On exécute la requête pour récupérer les réservations
$resultat = executeRequete("SELECT * FROM reservation ");

// On vérifie qu'il y a des réservations
if ($resultat->rowCount() > 0) {
    echo '<table class="table">';
    echo '<tr>';
    echo '<th>Nom</th>';

    echo '<th>Prenom</th>';

    echo '<th>Telephone</th>';

    echo '<th>Email</th>';

    echo '<th>Date</th>';

    echo '<th>Heure</th>';

    echo '<th>Nombre de personne</th>';

    echo '<th>message</th>';

    echo '<th>Actions</th>';

    echo '</tr>';
    // On parcourt les résultats de la requête
    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr class="table">';
        echo '<td>' . $row['nom'] . '</td>';
        echo '<td>' . $row['prenom'] . '</td>';
        echo '<td>' . $row['telephone'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($row['date'])) . '</td>';
        echo '<td>' . date('H:i', strtotime($row['time'])) . '</td>';
        echo '<td>' . $row['nbr_personne'] . '</td>';
        echo '<td>' . $row['message'] . '</td>';
        echo '<td>'
        . '<a class="btn btn-primary" href="traitement_accepter.php?id_reservation=' . $row['id_reservation'] . '">Accepter</a>'
        . '<a class="btn btn-primary" href="traitement-annuler.php?id_reservation=' . $row['id_reservation'] . '">Annuler</a>'
        . '</td>';
   echo '</tr>';
}
echo '</table>';
} else {
echo 'Aucune réservation enregistrée';
}




    



?>
 <?php require_once "../inc/footer.php"; ?>