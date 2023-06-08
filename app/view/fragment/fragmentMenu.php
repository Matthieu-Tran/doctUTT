<!-- ----- début fragmentCaveMenu -->
<?php
session_start();
?>
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f6b93b;">
  <div class="container-fluid">
    <a class="navbar-brand" href="router.php?action=Accueil">SCHULER-TRAN | <?php if (isset($_SESSION['login'])) {
                                                                              echo $_SESSION['statut'];
                                                                            } else {
                                                                              echo "";
                                                                            };
                                                                            ?> | <?php if (isset($_SESSION['login'])) {
                                                                                    $personne = $_SESSION['personne'];
                                                                                    echo $personne->getPrenom() . " " . $personne->getNom();
                                                                                  } else {
                                                                                    echo "";
                                                                                  }; ?> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ((isset($_SESSION['login'])) && ($_SESSION['statut'] == "Administrateur")) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrateur</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="">Liste des spécialités</a></li>
              <li><a class="dropdown-item" href="">Sélection d'une spécialité par son id</a></li>
              <li><a class="dropdown-item" href="">Insertion d'une nouvelle spécialité</a></li>
              <hr>
              <li><a class="dropdown-item" href="">Liste des praticiens avec leur spécialité</a></li>
              <li><a class="dropdown-item" href="">Nombre de praticiens par patient</a></li>
              <hr>
              <li><a class="dropdown-item" href="">Info</a></li>
            </ul>
          </li>
        <?php
        } else if ((isset($_SESSION['login'])) && ($_SESSION['statut'] == "Praticien")) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Praticien</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="">Liste de mes disponibilités</a></li>
              <li><a class="dropdown-item" href="">Ajout de nouvelles disponibilités</a></li>
              <hr>
              <li><a class="dropdown-item" href="">Liste des rendez-vous avec le nom des patients</a></li>
              <li><a class="dropdown-item" href="">Liste de mes patients (sans doublon)</a></li>
            </ul>
          </li>
        <?php
        } else if ((isset($_SESSION['login'])) && ($_SESSION['statut'] == "Patient")) { ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Patient</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="">MonCompte</a></li>
              <li><a class="dropdown-item" href="">Liste de mes rendez-vous</a></li>
              <li><a class="dropdown-item" href="">Prendre un RDV avec un praticien</a></li>
            </ul>
          </li>
        <?php
        } ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Innovations</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?">Proposez une fonctionnalité originale</a></li>
            <li><a class="dropdown-item" href="?">Proposez une amélioration du code MVC</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="router.php?action=connexion">Login</a></li>
            <li><a class="dropdown-item" href="router.php?action=inscription">Inscription</a></li>
            <li><a class="dropdown-item" href="router.php?action=deconnexion">Déconnexion</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- ----- fin fragmentCaveMenu -->