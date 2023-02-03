<?php
require_once "inc/init.php";



require_once "inc/header.php";
?>

<div id="page-blog" class="container-fluid">
            <div>
             <div style="background-image: url(photo/blog.jpg); background-size: cover;width: 100%; height: 100vh;">
                <div class="site-title">
                    <h1>THYM BLOG</h1>
                </div>
             </div> 
            </div>
             <div class="chef">
                <h2>Notre chef</h2>
             </div>
        </div>
        <div class="chefe ">
            <div><img src="photo/chef (1).jpg" alt="chef" class="img-chef"></div>
            <div class="parg-chef">
                <h3> À propos du Chef</h3>
                <hr>
                <hr>
                <p>Paragraphe. Vous pouvez le modifier et ajouter votre texte. Double-cliquez ici ou cliquez sur « Modifier le texte » pour ajouter votre contenu et personnaliser la police. Utilisez cet espace pour raconter une histoire et vous présenter à vos visiteurs. Vous pouvez le faire glisser-déposer où vous le souhaitez sur la page.</p>
                <h6>Tél : 01 23 45 67 89  |  E-mail : info@monsite.fr</h6>
            </div>
        </div>
        <div class="recettes">
            <h2 class="recette-tit">Quelque recettes</h2>
            <img src="photo/viande.webp" alt="viande">
            <h6>Les meilleurs plats de viande pour recevoir </h6>
            <p>Lorsque vous recevez, vous avez envie de régaler vos invités avec un bon morceau de viande et de passer le plus de temps possible avec eux sans vous stresser en cuisine. La recette de viande parfaite pour recevoir doit donc pouvoir être préparée à l’avance et simple à réaliser tout en étant raffinée. Nous en faisons notre affaire: Betty Bossi a réuni pour vous les meilleurs plats de viande pour recevoir. La plupart peuvent être préparés à l’avance, garnitures comprises. Nous vous donnons en prime de nombreux conseils malins pour la préparation, le service et le choix des garnitures.

                Plats de viande au four
                Les plats de viande au four sont l’idéal pour recevoir:
                
                Il peuvent être préparés à l’avance
                Beaucoup de plats de viande au four peuvent être préparés à l’avance. Il suffit de les sortir au bon moment du réfrigérateur et de les glisser au four.
                Ils vous laissent le temps de préparer tout le reste
                Selon le mode de cuisson, un rôti au four prend entre 45 et 90 minutes, ce qui vous laisse le temps de préparer sauce et garnitures, de dresser la table et éventuellement de vous changer. De quoi être parfaitement détendu(e) pour accueillir vos invités.
                Garnitures et sauce peuvent aussi être préparées à l’avance
                Beaucoup de garnitures comme la purée de pommes de terre, le risotto ou les spätzlis, même les sauces et les légumes, peuvent être préparés à l’avance. Vous avez ainsi encore plus de temps pour vos invités.
                Ils patientent au chaud
                La plupart des plats de viande peuvent patienter au four jusqu’à une heure, ce qui signifie zéro stress pour vous au cas où l’apéritif se prolonge et que les invités ne passent pas à table à l’heure prévue.
                Recettes de viande simples et rapides au four
                Betty Bossi vous propose aussi quantité de recettes de viande simples et rapides au four. Il ne vous faudra pas plus de 20 minutes pour préparer notre Carré d’agneau et poivrons par exemple.</p>
                <img src="photo/platviande.jpg" alt="platviande">
                <p>Travailler le beurre avec le zeste et le jus de citron env. 2 min avec les fouets du batteurmixeur. Couper l’avocat en deux, détacher la chair, écraser à la fourchette. Incorporer au beurre l’avocat et le persil, poivrer, remplir une poche à douille cannelée (Ø env. 11 mm). Dresser des rosettes sur une assiette recouverte d’une feuille, réserver env. 30 min au frais.
                    Bien chauffer le beurre à rôtir dans une poêle. Saisir la viande env. 3 min sur chaque face, saler, poivrer. Présenter avec le beurre d’avocat.</p>
         </div>
        
         <!--------------------------------------------------------->
         <div class="galeries">
            <h2>Galeries</h2>
            <div class="carousel-blog">
                <img class="carousel-image  active" src="photo/plat-2.jpg" alt="">
                <img class="carousel-image " src="photo/ENT-3.jpg" alt="">
                <img class="carousel-image " src="photo/ENT-1.jpg" alt="">
                <img class="carousel-image" src="photo/D-3.jpg" alt="">
                <img class="carousel-image" src="photo/D-1.jpg" alt="">
            </div>
            <button class="prev">Précédent</button>
            <button class="next">Suivant</button>
        </div>

        <h2 class="titre-avis">Avis de quelque clients</h2>
        <div id="carouselExampleControlsNoTouching" class="carousel slide-blog" data-bs-touch="false">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <h3 class="avis-tit">Un mot de nos clients</h3>
              <p class="avis-p">
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem aperiam eum elitdolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem dolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem ."
              </p>
              <p class="client">Nom de client</p>
            </div>
            <div class="carousel-item">
              <h3 class="avis-tit">Un mot de nos clients</h3>
              <p class="avis-p">
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem aperiam eum elitdolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem dolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem ."
              </p>
              <p class="client">Nom de client</p>
            </div>
            <div class="carousel-item">
              <h3 class="avis-tit">Un mot de nos clients</h3>
              <p class="avis-p">
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem aperiam eum elit."
              </p>
              <p class="client">Nom de client</p>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
        
      
         <?php require_once "inc/footer.php";