<!-- ----- debut Router1 -->
<?php
require('../controller/ControlerSite.php');
require('../controller/ControleurPraticien.php');
require('../controller/ControlerAdministrateur.php');
require('../controller/ControleurPatient.php');
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
require('../view/fragment/fragmentHeader.html');

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
  case "fonctionnalite":
  case "mvc":
    ControllerSite::$action();
    break;
  case "afficherInfosCompte":
  case "listerRdvPatient":
  case "listerRdvDispoPraticien":
  case "selectionnezRdv":
  case "updateRdv":
    ControleurPatient::$action($args);
    break;
    // Tache par défaut
  default:
    $action = "Accueil";
    ControllerSite::$action();
}
require('../view/fragment/fragmentFooter.html');
?>
<!-- ----- Fin Router1 -->