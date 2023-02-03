<?php

require_once '../inc/init.php'; // on remonte vers le dossier parent avec ../

if (!estConnecteAdmin()) { //on vérifie que le membre est bien admin, sinon on le redirige vers la page de connexion :
    header('location:../connexion.php');
    exit;
}

if (!empty($_POST)) { // si le formulaire a été envoyé

    // ici il faudrait mettre les conditions de contrôle du formulaire

    $photo_bdd = ''; // le champ "photo" est vide par défaut en BDD

    if(isset($_POST['photo_actuelle'])){//si existe "photo_actuelle" dans $_POST, c'est que je suis en train de modifier le produit : je veux donc remettre le chemin de la photo en BDD
        $photo_bdd = $_POST['photo_actuelle'];//alors on affecte le chemin de la photo actuelle à la variable $photo_bdd qui est insérée en BDD
    }

    // $_FILES est une superglobale générée par le type="file" du champ "photo" du formulaire. Le premier indice de $_FILES correspond au "name" de cet input. A cet indice on trouve toujours un sous-tableau avec l'indice "name" qui contient le nom du fichier en cours d'upload, l'indice "type" qui contient le type du fichier (ici image), l'indice "size" qui contient sa taille en octets.
    if (!empty($_FILES['photo']['name'])) { 
      // si n'est pas vide le nom de la photo, c'est qu'un fichier est en cours d'upload
        $nom_fichier = $_FILES['photo']['name']; // on récupère le nom du fichier
        $photo_bdd = 'photo/' . $nom_fichier; // cette variable contient le chemin relatif de l'image que l'on insère en BDD (elle est dans le dossier photo/ et s'appelle $nom_fichier)
        copy($_FILES['photo']['tmp_name'], '../'. $photo_bdd); // on copie le fichier photo temporaire qui est dans $_FILES['photo']['tmp_name'] vers le répertoire dont le chemin est "../photo/nom_fichier".
    }

    //insertion du produit en BDD :
    //REPLACE fait un INSERT quand l'ID n'existe PAS en BDD (valeur 0)
    // REPLACE fait un UPDATE quand l'ID existe en BDD
    $succes = executeRequete(" REPLACE INTO plat (id_plat, reference, categorie, titre, description, photo, prix, stock ) VALUES (:id_plat, :reference, :categorie, :titre, :description, :photo, :prix, :stock)", array(
       
        'id_plat' =>$_POST['id_plat'],
        ':reference' =>$_POST['reference'],
        ':categorie' =>$_POST['categorie'],
        ':titre' =>$_POST['titre'],
        ':description' =>$_POST['description'],
        ':photo' =>$photo_bdd, // chemin de la photo uploadée qui est vide par défaut
        ':prix' => $_POST['prix'],
        ':stock' => $_POST['stock']
    ));

    if ($succes) { // si on a reçu un objet PDOStatement c'est que la requête a marché
        $contenu .= '<div class="alert alert-success">Le produit est enregistré</div>';
    } else { // sinon on a reçu false, la requête n'a pas marché
        $contenu .=  '<div class="alert alert-danger">Erreur à l\'enregistrement</div>';
    }
}

if (isset($_GET['id_plat'])) {// si 'id_produit' est dans l'URL, c'est qu'on a demandé la modification d'un produit

    $resultat = executeRequete("SELECT * FROM plat WHERE id_plat = :id_plat", array(':id_plat' => $_GET['id_plat']));
    $plat = $resultat->fetch(PDO::FETCH_ASSOC);//$produit est un tableau associatif dont on va mettre les valeurs dans les champs de formulaire
    //debug($plat);
}


require_once '../inc/header.php';

?>

<h1>Formulaire plat</h1>


<?= $contenu ?>

<form action="" method="post" enctype="multipart/form-data" style="margin-left:40%;">
    <!-- l'attribut enctype="multipart/form-data" spécifique que le formulaire envoie des données binaires (fichier) et du texte (champs du formulaire) : permet d'uploader un fichier (ici une photo). -->

    <input type="hidden" name="id_plat" value="<?php echo $plat['id_plat'] ?? 0; ?>"><!--le champs caché id_produit est nécessaire pour la MODIFICATION d'un produit (UPDATE) car on a besoin de récupérer l'ID du produit modifé pour la requête SQL "REPLACE INTO" Quand on crée un produit nouveu (INSERT) on met une valeur par défaut à 0 pour que "REPLACE INTO" se comporte comme un INSERT -->

    <div><label for="reference">Référence</label></div>
    <div><input type="text" name="reference" id="reference" value="<?php echo $plat['reference'] ?? ''; ?>"></div>

    <div><label for="categorie">Catégorie</label></div>
    <div><input type="text" name="categorie" id="categorie" value="<?php echo $plat['categorie'] ?? ''; ?>"></div>

    <div><label for="titre">Titre</label></div>
    <div><input type="text" name="titre" id="titre" value="<?php echo $plat['titre'] ?? ''; ?>"></div>

    <div><label for="description">Description</label></div>
    <div><textarea name="description" id="description" cols="30" rows="10"><?php echo $plat['description'] ?? ''; ?></textarea></div>

    <div><label for="photo">Photo</label></div>
    <div><input type="file" name="photo"></div><!-- le type="file" permet de remplir la superglobale $_FILES. Le name="photo" correspond à l'indice de $_FILES['photo']. Pour uploader 1 fichier, il ne faut pas oublier l'attribut enctype="multipart/form-data" sur la balise <form>. -->
<?php
    if(isset($plat['photo'])){//si existe $produit['photo'] c'est que nous sommes en train de modifier le produit
        echo '<div>Photo actuelle du plat</div>';
        echo '<div><img style="width:90px;" src="../'.$plat['photo'] .'  "></div>';// on affiche la photo actuelle dont le chemin est dans le champ"photo" de la BDD donc dans $produit
        echo '<input type="hidden" name="photo_actuelle" value="'.$plat['photo'].'">';// on créé ce champs caché pour remettre le chemin de la photo actuelle dans le formulaire, donc dans $_POST à l'indice 'photo_actuelle". Ainsi on ré-insère ce chemin en BDD lors de la modification
    }

?>

    <div><label for="prix">Prix</label></div>
    <div><input type="text" name="prix" id="prix" value="<?php echo $plat['prix'] ?? ''; ?>"></div>

    <div><label for="stock">Stock</label></div>
    <div><input type="text" name="stock" id="stock" value="<?php echo $plat['stock'] ?? ''; ?>"></div>

    <div><input type="submit" value="Enregistrer le produit" class="btn btn-info"style="margin-left:-1%;margin-top:2em;%;"></div>

</form>

<?php

