<!Doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Thym</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" lang="fr" content="DESCRIPTION DU SITE">
  <meta name="author" content="fadoua">
  <meta name="robots" content="index, follow">
  <link rel="stylesheet" href="<?= RACINE_SITE ?>style.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"><!--AOS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,900italic,900,700italic,700,500italic,500,400italic,300italic,300,100italic,100" rel="stylesheet" type="text/css">
</head>

<body>
  <header >
    <nav class="navbar navbar-expand-lg "id="navigations">
      <div class="container-fluid">
        <img src="<?= RACINE_SITE; ?>photo/logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?= RACINE_SITE ?>index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE ?>menu.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE ?>blog.php">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE ?>reservation.php">Réservation</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE ?>contact.php">Contact</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img style="width:22px;height:22px;" src="<?= RACINE_SITE ?>photo/connexion.png" alt="connexion" class="connexion">
              </a>
              <ul class="dropdown-menu">
                <?php
                if (!estConnecte()) { ?>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>connexion.php">Login</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>inscription.php">Inscription</a></li>

                <?php
                } else { ?>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>panier.php">Voir Panier</a></li>
                  <li><a class="dropdown-item" href=" <?= RACINE_SITE ?>connexion.php?action=deconnexion">Deconnexion</a></li>
                <?php } ?>
                <?php
                if (estConnecteAdmin()) { ?>
                    <li><a class="dropdown-item" href="<?= RACINE_SITE ?>admin/formulaire-plat.php">formulaire-plat</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>admin/gestion-plat.php">gestion-plat</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>admin/gestion-reservation.php">gestion-reservation</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>admin/gestion-commande.php">gestion-commande</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>admin/traitement_accepter.php">traitement_accepter</a></li>
                  <li><a class="dropdown-item" href="<?= RACINE_SITE ?>admin/traitement_annuler.php">traitement_annuler</a></li>
               
                <?php } ?>
              </ul>
            </li>
        </div>
        </li>
        </ul>
      </div>
      </div>
      <div>

    </nav>


  </header>
  <!--                               -->
  <main>