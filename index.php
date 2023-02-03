<?php
require_once "inc/init.php";

require_once "inc/header.php";

?>

<div id="pargre-1" class="pargre-1 container-fluid ">
    <h2>Frais, sain, fait avec amour</h2>
    <div class="img-1">
      <img src="photo/head.webp" alt="" class="img-head">
    </div>
    <div class="order"><a href="<?= RACINE_SITE ?>menu.php"><span><span class="bot-order">Order</span><br>
          <span class="bot-order">Now</span></span>
      </a>
    </div>
    <p class="servons">Nous servons des plats délicieux et nourrissants,
      en restant fidèle à notre engagement à utiliser local,
      produits durables et biologiques fidèle à notre engagement fidèle à notre engagement plats délicieux et
      nourrissants.</p>
    <button type="submit" class="button">MENU</button>
  </div>
  <!--                               -->
  <div id="section-2" class="d-flex container-fluid">
    <div class="ferme">
      <div class="text">
     <h4 class="titre-1"> De la ferme à la table 
        <h4 class="titre-1-2"> Avec une torsion </h4>
        <p class="pargraphe-1"> Lorem ipsum dolor sit amet consectetur, adipisicing elit.
          Voluptatibus inventore veniam odit! Deserunt
          ipsum consequatur officia ad voluptatibus recusandae.</p>
        <button type="submit" class="button-2"> Voir Plus </button>
      </div>
      <div>
        <img src="photo/img-1.webp" alt="" class="imgRoasted">
      </div>
    </div>
  </div>
  <!--                               -->
  <div id="nos-Promotions">
    <div class="container-fluid">
      <h3 class="promo">Nos promosions </h3>
      <p class="promos"> Obtenez 10 % de réduction sur votre première reservation </p>
    </div>
  </div>
  <!--                               -->
  <div id="reservation">

  </div>
  <!--                               -->
  <div id="section-3" class="container-fluid">
    <div class="speciale">
      <div class="texte">
        <h4 class="titre-2"> Spécial chou frisé</h4>
        <h4 class="titre-2-2"> Le menu est activé !</h4>
        <p class="pargraphe-2"> Lorem ipsum dolor sit amet consectetur, adipisicing elit.
          Voluptatibus inventore veniam odit! Deserunt
          ipsum consequatur officia ad voluptatibus recusandae.</p>
      </div>
      <div class="img-2">
        <img src="photo/img-2.webp" alt="">
      </div>
    </div>
  </div>

  <div class="box d-flex">
  <div data-aos="zoom-in">
      <div class="card ">
       <a href="<?= RACINE_SITE ?>reservation.php">Reserver</a>
      </div></div> 
      <div data-aos="zoom-in">
      <div class="card ">
     <a href="<?= RACINE_SITE ?>contact.php">Contacter</a>
      </div>
    </div> 
  </div>
 

 <div class="container-fluid avis">
  <img src="photo/img-3.webp" alt="" class="img-3" >
  <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <h3 class="avis-tit">Un mot de nos clients</h3>
        <p class="avis-p">
          "Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dignissimos, illo voluptatem aperiam eum elit."
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
    
    <?php require_once "inc/footer.php"; ?>