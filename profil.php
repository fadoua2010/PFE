<?php require_once "inc/init.php"; 


if(!estConnecte()){ //La fonction "estConnecte()" est utilisée pour vérifier si l'utilisateur est connecté. Si cette fonction renvoie false (non connecté), le code à l'intérieur des accolades suivantes sera exécuté./
    header('location:connexion.php');// on redirige le membre NON connecté vers la page connexion.php
    exit;//met fin à l'exécution du script 
}


require_once("inc/header.php"); 
?>

<h1>Profil</h1>
<h2>Bonjour <?= $_SESSION['membre']['prenom'] .' '. $_SESSION['membre']['nom'] ?></h2><!--On accède aux informations stockées en session -->
<!--Affiche un salut personnalisé en utilisant les informations de prénom et de nom de l'utilisateur stockées dans la variable $_SESSION.-->
<h3>Vos informations</h3>

<ul>
    <li>Email : <?= $_SESSION['membre']['email']?></li>
    <li>Adresse : <?= $_SESSION['membre']['adresse']?></li>
    <li>Code postal : <?= $_SESSION['membre']['code_postal']?></li>
    <li>Ville : <?= $_SESSION['membre']['ville']?></li>
</ul>

<?php require_once "inc/footer.php";