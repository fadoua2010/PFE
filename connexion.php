<?php
require_once "inc/init.php";//pour inclure un fichier appelé "init.php" qui contient des initialisations nécessaires pour le fonctionnement du script.

$message = '';// pour afficher le message de déconnexion

// Déconnexion du membre

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){//vérifie si une action de déconnexion a été demandée en vérifiant si la variable $_GET['action'] est définie et égale à "deconnexion".
    unset($_SESSION['membre']);//Si la condition est remplie, cela signifie que l'utilisateur a demandé à se déconnecter, la ligne suivante utilise la fonction "unset()" pour supprimer la variable de session 'membre' pour déconnecter l'utilisateur.
    $message = '<div class="alert alert-info">Vous êtes déconnecté</div>';
    // affecte une valeur à la variable $message qui est un message d'information pour indiquer à l'utilisateur qu'il est déconnecté.
}


if (estConnecte()) { // on vérifie que le membre n'est pas déjà connecté. si'il est connecté on le redirige vers la page de profil ==> évite de passer outre en modifiant le lien url directement vers la page connexion car on sera automatiquement redirigé vers la page profil.php
    header('location:profil.php');
    exit;
}

// traitement

if (!empty($_POST)) { // on teste si le formulaire a été envoyé

    // on controle les champs de formulaire

    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) { //si le pseudo ou le mdp est vide //vérifie si les champs "pseudo" et "mdp" du formulaire sont vides en utilisant la fonction "empty()".//Si l'un des champs est vide, cela signifie que l'utilisateur n'a pas rempli tous les champs obligatoires, alors la ligne suivante ajoute un message d'erreur à la variable $contenu, indiquant que les identifiants sont obligatoires.
        $contenu .= '<div class="alert alert-danger">Les identifiants sont obligatoires !</div>';//Les messages d'erreur contenus dans $contenu seront affichés à l'utilisateur pour l'informer des erreurs dans le formulaire.
    }

    // si les champs sont remplis, on vérifie le pseudo puis le mot de passe en bdd
    if (empty($contenu)) { // si la variable est vide, c'est qu'il n'y a pas de message d'erreurs
        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

        if ($resultat->rowCount() == 1) { // s'il y a une ligne de résultat, c'est que le pseudo est en BDD : on peut alors vérifier le mdp
            $membre = $resultat->fetch(PDO::FETCH_ASSOC); // on fetch l'objet $resulat pour en extraire les données, sans boucle car le pseudo est unique en BDD
            // debug($membre);
            $mdp_Hash = $membre['mdp'];// variable qui stock mon mdp après le traitement de "hash"
            // debug($mdp_Hash);

            if (password_verify($_POST['mdp'], $mdp_Hash)) { // password_verify() retourne true si le hash de la bdd correspond au mdp du formulaire
                // true, on peut connecter le membre avec une session :

                $_SESSION['membre'] = $membre; // pour connecter le membre on crée une session appelée 'membre' avec toutes les infos du memebre qui viennent de la BDD
                header('location:profil.php'); // les identifiants étant corrects on redirige l'internaute vers la page profil.php
                exit; // et on quitte le script
            } else { // sinon c'est que le mdp est erroné
                $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants</div>';
            }
        } else { // sinon c'est que le pseudo n'est pas en bdd
            $contenu .= '<div class="alert alert-danger">Erreur sur les identifiants</div>';
        }
    }
}

require_once "inc/header.php";
?>

<h1>Connexion</h1>

<!-- insertion dans la page des messages d'erreur lors du controle des éléments du formulaire-->
<?php
echo $message;
echo $contenu;
?>

<form action="" method="POST"style="margin-left:25%;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;margin-right:20%;margin-bottom:12%;margin-top:12%;">
    <div><label for="pseudo"style="margin-left:43%; margin-top:2em;">Pseudo</label></div>
    <div><input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo"style="margin-left:35%; margin-top:1em;"></div>
    <!-- pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required" -->

    <div><label for="mdp"style="margin-left:41%; margin-top:1em;">Mot de passe</label></div>
    <div><input type="password" id="mdp" name="mdp"style="margin-left:35%; margin-top:1em;"></div>
    <!-- required="required" -->
    
   

    <div><input type="submit" value="Se connecter" class="btn btn-info"style="margin-left:35%; margin-top:2em;"></div>

</form>


<?php require_once "inc/footer.php";

