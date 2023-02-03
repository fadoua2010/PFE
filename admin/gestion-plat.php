<?php

require_once '../inc/init.php';

if (!estConnecteAdmin()) {// on vérifie que le membre est bien admin sinon on redirige vers la page de connexion
    header('location:../connexion.php');
    exit;
}

// suppression d'un produit
if(isset($_GET['id_plat'])){// Vérifie si l'ID du plat à supprimer est présent dans la requête GET.

    $resultat = executeRequete("DELETE FROM plat WHERE id_plat = :id_plat", //Exécute une requête DELETE pour supprimer le plat correspondant à l'ID spécifié dans la requête GET.
    array (':id_plat' => $_GET['id_plat']));

    if($resultat->rowCount() == 1){//: Vérifie si une ligne a été affectée par la requête DELETE. Si c'est le cas, cela signifie que le plat a été supprimé avec succès.
        $contenu .= '<div class="alert alert-success">Le plat a bien été supprimé</div>';
    }else{
        $contenu .= '<div class="alert alert-success">Le plat n\'a pas  été supprimé</div>';
    }
}


$resultat = executeRequete("SELECT * FROM plat");// on sélectionne tous les produits// Sélectionne tous les plats de la table "plat" pour les afficher dans le tableau.

$contenu .= 'Nombre de plats dans le restaurant : ' . $resultat->rowCount() .'<br>';

$contenu .= '<a class="btn btn-primary mt-2 mb-5" href="formulaire-plat.php">Ajouter un plat</a>';

$contenu .= '<table class="table">';
    $contenu .= '<tr>';
        $contenu .= '<th>ID</th>';
        $contenu .= '<th>Référence</th>';
        $contenu .= '<th>Catégorie</th>';
        $contenu .= '<th>Titre</th>';
        $contenu .= '<th>Description</th>';
        $contenu .= '<th>Photo</th>';
        $contenu .= '<th>Prix</th>';
        $contenu .= '<th>Stock</th>';
        $contenu .= '<th>Actions</th>'; //colonne pour les liens "modifier et "supprimer"
    $contenu .= '</tr>';

    //debug($resultat);

    while($plat = $resultat->fetch(PDO::FETCH_ASSOC)){//Boucle à travers chaque plat retourné par la requête SELECT.
        $contenu .= '<tr>';// on créé 1 ligne de table par platt
            foreach($plat as $indice => $information){//  Boucle à travers les différents champs de chaque plat.
                if($indice == 'photo'){// si l'indice se trouve sur le champ "photo", on affiche une balise img dans lequel on pourra mettre le chemin stocké en bdd// Vérifie si le champ en cours est la photo, si c'est le cas, on affiche une balise img.
                    $contenu .= '<td><img style="width:90px" src="../'.$information.'"</td>';// $information contient le chemin relatif de la photo vers le dossier "photo/" qui se trouve dans le dossier parent. on concatène donc "../".
                }else{// sinon on affiche les autres valeurs dasn une <td> seul
                    $contenu .= '<td>'.$information.'</td>';
                }
            }

            $contenu .= '<td>   <a class="btn btn-primary" href="formulaire-plat.php?id_plat='.$plat['id_plat'].'">Modifier</a>
                                <a class="btn btn-danger" href="?id_plat='.$plat['id_plat'].'">Supprimer</a>
                        </td>';// A gérer la suppression du produit => on envoie en GET l'id du produit
        $contenu .= '</tr>';   
    }
    $contenu .= '</table>';
    


    require_once "../inc/header.php";


echo $contenu;







