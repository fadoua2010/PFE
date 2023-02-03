<?php
require_once "inc/init.php";
//debug($_POST);
if (!empty($_POST)) {//Cette ligne vérifie si la variable $_POST n'est pas vide, ce qui signifie que le formulaire a été soumis.
 // on controle les champs de formulaire


 if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
  //Cette ligne vérifie si le champ "nom" du formulaire est défini, si sa longueur est inférieure à 2 ou supérieure à 20 caractères. Si c'est le cas, un message d'erreur est affiché
  $contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 20 caractères</div>';
}

if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
  //Cette ligne vérifie si le champ "prenom" du formulaire est défini, si sa longueur est inférieure à 2 ou supérieure à 20 caractères. Si c'est le cas, un message d'erreur est affiché
  $contenu .= '<div class="alert alert-danger">Le prenom doit contenir entre 2 et 20 caractères</div>';
}
if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  // Cette ligne vérifie si le champ "email" du formulaire est défini, et s'il est valide en utilisant la fonction filter_var() pour valider l'adresse email. Si c'est le cas, un message d'erreur est affiché
  $contenu .= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';
}
if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
  // Cette ligne vérifie si le champ "telephone" du formulaire est défini, et s'il est valide en utilisant une expression régulière pour vérifier qu'il est composé de 10 chiffres. Si c'est le cas, un message d'erreur est affiché
  $contenu .= '<div class="alert alert-danger">Le téléphone doit comporter 10 chiffres</div>';
} 

if (!isset($_POST['nbr_personne']) > 50) {
  //Cette ligne vérifie si le champ "nbr_personne" du formulaire est défini, et s'il est supérieur à 50. Si c'est le cas, un message d'erreur est affiché
  $contenu .='<div class="alert alert-danger">Désolé, nous ne pouvons pas accueillir autant de personnes.</div>';
}

$date_regex='/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

if (!isset($_POST['date'])||!preg_match($date_regex, $_POST['date'])) {//Cette ligne vérifie si le champ "date" du formulaire est défini, et s'il est valide en utilisant une expression régulière pour vérifier le format de la date entrée. Si c'est le cas, un message d'erreur est affiché
  $contenu .= '<div class="alert alert-danger">Veuillez entrer une date au format MM/JJ/AA</div>';
} 
$time_regex = '/^([0-1][0-9]|2[0-3]):[0-5][0-9]$/';
if (!isset($_POST['time'])||!preg_match($time_regex, $_POST['time'])) {
  //Cette ligne vérifie si le champ "time" du formulaire est défini, et s'il est valide en utilisant une expression régulière pour vérifier le format de l'heure entrée. Si c'est le cas, un message d'erreur est affiché 10.
  $contenu .='<div class="alert alert-danger">Veuillez entrer une heure au format HH:MM.</div>';
}  
if (!isset($_POST['message']) || strlen($_POST['message']) < 2 || strlen($_POST['message']) > 100) {
  //Cette ligne vérifie si le champ "message" du formulaire est défini, si sa longueur est inférieure à 2 ou supérieure à 100 caractères. Si c'est le cas, un message d'erreur est affiché
  $contenu .= '<div class="alert alert-danger">Le message doit contenir entre 2 et 100 caractères</div>';
}
if (empty($contenu)) { // si la variable est vide, c'est qu'il n'y a pas de message d'erreurs
  $resultat = executeRequete(
    "SELECT * FROM reservation WHERE nom = :nom",// Cette ligne effectue une requête SQL pour vérifier si il existe déjà une réservation avec le même nom.
    array(':nom' => $_POST['nom'])
);
  //debug($resultat);
  if ($resultat->rowcount() > 0) {
    //Cette ligne vérifie le nombre de lignes affectées par la requête SQL précédente. Si le nombre est supérieur à 0, cela signifie qu'il existe déjà une réservation avec le même nom, un message d'erreur est affiché.
    $contenu .= '<div>ce nom a déja a une reservation </div>';
  } else {
    $succes = executeRequete(// Cette ligne insère les données du formulaire dans la base de données si toutes les vérifications précédentes ont été passées avec succès.
      "INSERT INTO reservation (nom, prenom, telephone, email,  nbr_personne, date, time, message) VALUES ( :nom, :prenom, :telephone, :email, :nbr_personne, :date, :time, :message)",
      array(
        ':nom' => $_POST['nom'],
        ':prenom' => $_POST['prenom'],
        ':telephone' => $_POST['telephone'],
        ':email' => $_POST['email'],
        ':nbr_personne' => $_POST['nbr_personne'],
        ':date' => $_POST['date'],
        ':time' => $_POST['time'],
        ':message' => $_POST['message'],
      )
    );
    if ($succes) {
      $contenu .= '<div class="alert alert-success">Votre reservation est bien envoyer';
    } else {
      $contenu .= '<div class="alert alert-danger">Une erreur est survenue ...</div>';
    }
  }
}
}




require_once "inc/header.php";
?>
<?= $contenu; ?>
    <div id="page-contact" class="container-fluid">
      <div>
        <h1>Reservation</h1>
      </div>


      <div class="reservation " id="reservation">


        <h2 class="titre_reservation">Réserver une table</h2>


        <form action="#" method="post" class="reservation-form">
         <div class=" d-flex rev-1" >
          <label for="nom" style="display: inline-block; margin-bottom: 15px;margin-left: 15px;">Nom</label>
      
          <input type="text" id="nom" name="nom" placeholder="votre nom" class="cadre"><br><br><br>
          
          <label for="prenom" style="display: inline-block; margin-bottom: 15px;">Prénom</label><br>
          <input type="text" id="prenom" name="prenom" placeholder="votre prénom" class="cadre"><br><br>
        </div>
        <div class="d-flex  rev-1" >
          <label for="email">Email</label><br>
          <input type="email" id="email" name="email" placeholder="exemple@gmail.com" class="cadre"><br><br>

          <label for="telephone">Telephone</label><br>
          <input id="telephone" name="telephone" type="tel" placeholder="06 23 45 67 89" size="10"
            class="cadre"><br><br>
        </div>
        <div class=" entit-2 " >
          <label for="Nombre de personne " class="titre-rev-2">Nombre de personne</label><br>
          <select name="nbr_personne" class="cadre-2">
            <option value="1">For 1 person</option>
            <option value="2">For 2 person</option>
            <option value="3">For 3 person</option>
            <option value="4">For 4 person</option>
            <option value="1">For 5 person</option>
            <option value="2">For 6 person</option>
            <option value="3">For 7 person</option>
            <option value="4">For 8 person</option>
            <option value="1">For 9 person</option>
            <option value="2">For 10 person</option>
            <option value="3">For 11 person</option>
            <option value="4">For 12 person</option>
            <option value="1">For 13 person</option>
            <option value="2">For 14 person</option>
            <option value="3">For 15 person</option>
            <option value="4">For 16 person</option>
            <option value="1">For 17 person</option>
            <option value="2">For 18 person</option>
            <option value="3">For 19 person</option>
            <option value="4">For 20 person</option>
            <option value="2">For 21 person</option>
            <option value="3">For 22 person</option>
            <option value="4">For 23 person</option>
            <option value="1">For 24 person</option>
            <option value="2">For 25 person</option>
            <option value="3">For 26 person</option>
            <option value="4">For 27 person</option>
            <option value="1">For 28 person</option>
            <option value="2">For 29 person</option>
            <option value="3">For 30 person</option>
          </select><br><br><br>
          
          <label for="Date "  class="titre-rev-3">Date de reservation</label><br>
          <input type="date" name="date" id="Date-de-reservation" class="cadre-3 "><br><br><br>
        </div>

         <div class="time-reser">
          <label for="time"class="time-label">Heure de reservation</label><br>
          <input type="time" name="time">
         </div>
         <div class=" message-reser">
          <label for="message">Message</label><br>
          <textarea id="message" name="message" class="cadre"></textarea><br><br><br>
         </div>
         <div class="btn-revservation"><input type="submit" value="RESERVER" class="btn "></div>
        </form>


      </div>



    </div>
  


    <?php require_once "inc/footer.php";?>