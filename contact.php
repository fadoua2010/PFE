<?php
require_once "inc/init.php";




//debug($_POST);
if (!empty($_POST)) { //si ce qui est contenu dans la variable "post" n'est pas vide (donc si le formulaire a été envoyé) on entre dans le traitement ci-dessous


  // on controle les champs de formulaire

  if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {// vérifie si le champ "nom" du formulaire a été rempli en utilisant la fonction "isset()". vérifie si la longueur du contenu du champ "nom" est inférieure à 2 caractères en utilisant la fonction "strlen()". vérifie si la longueur du contenu du champ "nom" est supérieure à 20 caractères en utilisant la fonction "strlen()".Si la première ou la deuxième ou la troisième condition est remplie, cela signifie que la longueur du nom n'est pas valide, alors la ligne suivante ajoute un message d'erreur à la variable $contenu, indiquant que la longueur du nom doit contenir entre 2 et 20 caractères.
    $contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 20 caractères</div>';
    //Les messages d'erreur contenus dans $contenu seront affichés à l'utilisateur pour l'informer des erreurs dans le formulaire.
  }

  if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
    $contenu .= '<div class="alert alert-danger">Le prenom doit contenir entre 2 et 20 caractères</div>';
  }

  if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $contenu .= '<div class="alert alert-danger">L\'email n\'est pas valide</div>';
  }
  if (!isset($_POST['Objet']) || strlen($_POST['Objet']) < 2 || strlen($_POST['Objet']) > 20) {
    $contenu .= '<div class="alert alert-danger">L\'objet doit contenir entre 2 et 20 caractères</div>';
  }
  if (!isset($_POST['message']) || strlen($_POST['message']) < 2 || strlen($_POST['message']) > 100) {
    $contenu .= '<div class="alert alert-danger">Le message doit contenir entre 2 et 100 caractères</div>';
  }
  if (empty($contenu)) { // si la variable est vide, c'est qu'il n'y a pas de message d'erreurs, vérifie si la variable $contenu est vide en utilisant la fonction "empty()".Si la variable est vide, cela signifie qu'il n'y a pas de message d'erreur dans le formulaire, alors la ligne suivante utilise une fonction appelée "executeRequete()" pour exécuter une requête SQL de sélection de tous les enregistrements de la table "contact" où le nom est égal à celui saisi dans le formulaire.
    $resultat = executeRequete(//La requête SQL utilise un paramètre nommé pour protéger contre les injections SQL, en remplaçant la valeur saisie par l'utilisateur avec un marqueur de paramètre (:nom).
      "SELECT * FROM contact WHERE nom = :nom",//Le résultat de la requête est stocké dans la variable $resultat.
      array(':nom' => $_POST['nom'])//La requête SQL retourne un résultat dans $resultat qui sera par la suite utilisé pour vérifier si les informations saisies par l'utilisateur sont valides.
    );
    //debug($resultat);
    if ($resultat->rowcount() > 0) {// vérifie si le nombre de lignes retournées par la requête stockée dans la variable $resultat est supérieur à 0 en utilisant la méthode rowCount() de l'objet PDO.Si le nombre de lignes est supérieur à 0, cela signifie qu'un enregistrement existe déjà dans la base de données avec le même nom, alors un message d'erreur est ajouté à la variable $contenu indiquant que ce nom a déjà envoyé un message
      $contenu .= '<div>ce nom a déja envoyer un message </div>';
    } else {//Sinon, la fonction executeRequete() est utilisée pour exécuter une requête d'insertion pour ajouter les informations du formulaire dans la table contact. La requête utilise des marqueurs de paramètres pour protéger contre les injections SQL
      $succes = executeRequete(//La variable $succes est utilisée pour vérifier si la requête d'insertion s'est déroulée avec succès. Si c'est le cas, un message de succès est ajouté à la variable $contenu, sinon un message d'erreur est ajouté.
        "INSERT INTO contact (nom, prenom, email, Objet, date_enregistrement, message) VALUES ( :nom, :prenom, :email, :Objet, NOW(), :message)",
        array(
          ':nom' => $_POST['nom'],
          ':prenom' => $_POST['prenom'],
          ':email' => $_POST['email'],
          ':Objet' => $_POST['Objet'],
          ':message' => $_POST['message'],
        )
      );
      if ($succes) {
        $contenu .= '<div class="alert alert-success">Votre message est bien envoyer';
      } else {
        $contenu .= '<div class="alert alert-danger">Une erreur est survenue ...</div>';
      }
    }
  }
  $resultat = "DELETE FROM contact WHERE date_enregistrement < DATEADD(year, -1, GETDATE())";// effectue une requête "DELETE" qui supprime les enregistrements de la table "contact" où la date d'enregistrement est antérieure à un an. Cette requête permet de nettoyer la base de données en supprimant les enregistrements qui ne sont plus pertinents.
}

require_once "inc/header.php";

?>

<?= $contenu; ?>
<div id="page-contact" class="container-fluid">
  <div>
    <h1>Contact</h1>
  </div>
  <div style="background-image: url(<?= RACINE_SITE ?>photo/imgcontact.jpg);background-repeat: no-repeat; background-size: cover; height: 250vh;margin-top: 6em;font-family: 'Italianno', cursive;">
 

    <div class="contact " id="contact">


      <h2 class="titre_contact">Nous apprécions
        votre retour</h2>


      <form action="#" method="post" class="contact-form">
        <div class=" d-flex cont-1">
          <label for="nom" class="nom">Nom</label><br><br>

          <input type="text" id="nom" name="nom" class="cadre-cont"><br><br><br>

          <label for="prenom" class="prenom">Prénom</label><br>
          <input type="text" id="prenom" name="prenom" class="cadre-cont"><br><br>
        </div>

        <label for="email" class="email">E-mail</label><br>
        <input type="email" id="email" name="email" class="cadre-cont card"><br><br>

        <div class="objet-contact">
          <label for="Objet">Objet</label><br>
          <input type="text" name="Objet" class="obj-cont">
        </div>
        <div class=" message-contact">
          <label for="message">Laissez-nous un message...</label><br>

          <textarea id="message" name="message" class="cadre"></textarea><br><br><br>
        </div>
        <div><input type="submit" value="ENVOYER" class="btn-contact"></div>
      </form>


    </div>



  </div>
</div>



<?php require_once "inc/footer.php"; ?>