<?php
require_once "inc/init.php";


//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$resultat = executeRequete("SELECT DISTINCT categorie FROM plat");

$contenu .= '<div class="categorie">';
$contenu .= "<ul>";
while ($cat = $resultat->fetch(PDO::FETCH_ASSOC)) {

    $contenu .= "<li class='categorie-titre'><a href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li>";
    $contenu .= '<hr class="hr-1">
     <hr class="hr-2">';
}
$contenu .= "</ul>";
$contenu .= '</div>';



//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="d-flex produit">';
if (isset($_GET['categorie'])) {
    $resultat = executeRequete("SELECT * from plat where categorie='$_GET[categorie]'");
    while ($plat =  $resultat->fetch(PDO::FETCH_ASSOC)) {
        $contenu .= '<div style="margin-bottom:5em;">';
        $contenu .= "<img  class='plat-img'src=\"$plat[photo]\" =\"250\" height=\"170\">";
        $contenu .= "<h2 class='tit-pro'>$plat[titre]</h2>";
        $contenu .= "<p class='pargr'>Lorem ipsum dolor sit amet consectetur 
        adipisicing elit. Ullam, sint alias
        qudistinct providentftsx obcaecati amet consectetura consectetura dipisicing elit. Ullam, sint alias.</p>";
        $contenu .= "<p class='prix'>$plat[prix] €</p>";

        if ($plat['stock'] > 0) {

            $contenu .= '<form method="post" action="panier.php" class="formula-menu">';
            $contenu .= "<input type='hidden' name='id_plat'value='$plat[id_plat]''></input>";
            $contenu .= '<label for="quantite"> Quantité : </label>';
            $contenu .= '<select id="quantite" name="quantite">';
            for ($i = 1; $i <= $plat['stock'] && $i <= 5; $i++) {
                $contenu .= "<option>$i</option>";
            }
            $contenu .= '</select>';
            $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
            $contenu .= '</form>';
        } else {
            $contenu .= 'Rupture de stock !';
        }

        $contenu .= '</div>';
    }
}

require_once "inc/header.php";
?>
<div id="page-menu" class="container-fluid">
    <h1> MENU</h1>
    <div>
        <img src="photo/img-menu.webp" class="img-menu" alt="">
        <figure>
            <figcaption>
                <h2 class="dej">Menu Déjeuner</h2>
            </figcaption>
        </figure>
    </div>
    <span>
        <h3>Servi tous les jours de midi à 00h00</h3>
    </span>

    <?= $contenu; ?>



    <?php require_once "inc/footer.php";
