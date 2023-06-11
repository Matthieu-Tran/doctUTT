<!-- ----- debut Router1 -->
<?php
require('../controller/ControlerSite.php');
require('../controller/ControleurPraticien.php');
<<<<<<< HEAD
require('../controller/ControllerAdministrateur.php');
=======
require('../controller/ControlerAdministrateur.php');
require('../controller/ControleurPatient.php');
>>>>>>> featureInit
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// --- On supprime l'élément action de la structure 
unset($param['action']);

// --- tout ce qui reste sont des arguments 
$args = $param;
<<<<<<< HEAD
require('../view/fragment/fragmentHeader.html');
=======
>>>>>>> featureInit

// --- Liste des méthodes autorisées
require('../view/fragment/fragmentMenu.php');
switch ($action) {
  case "listerRdvPraticien":
  case "afficherRdvDisponibles":
  case "ajouterDisponibilite":
  case "rdvCreate":
  case "rdvCreated":
  case "listerPatientPraticien":
    ControleurPraticien::$action($args);
    break;
<<<<<<< HEAD
  case "listeSpecialites":
  case "specialiteSelectionId":
  case "specialiteAfficher":
  case "specialiteCreer":
  case "specialiteInserer":
  case "praticienListeSpecialite":
  case "nombrePraticiensParPatient":
  case "infoAdmin":
    ControleurAdministrateur::$action($args);
    break;
  case "inscription":
  case "connexion":
  case "deconnexion";
  case "inscription_traitement":
  case "connection_traitement":
    ControllerSite::$action();
    break;
=======
  case "afficherInfosCompte":
  case "listerRdvPatient":
  case "listerRdvDispoPraticien":
  case "selectionnezRdv":
  case "updateRdv":
    ControleurPatient::$action($args);
>>>>>>> featureInit
    // Tache par défaut
  default:
    $action = "Accueil";
    ControllerSite::$action();
}
<<<<<<< HEAD

require('../view/fragment/fragmentFooter.html');
=======
>>>>>>> featureInit
?>
<!-- ----- Fin Router1 -->