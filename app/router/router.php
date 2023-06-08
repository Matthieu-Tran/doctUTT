<!-- ----- debut Router1 -->
<?php
require('../controller/ControllerSite.php');
require('../controller/ControleurPraticien.php');
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
switch ($action) {
  case "listerRdvPraticien":
    ControleurPraticien::$action($args);
    // Tache par défaut
  default:
    $action = "Accueil";
    ControllerSite::$action();
}
require('../view/fragment/fragmentFooter.html');
?>
<!-- ----- Fin Router1 -->