<!-- ----- debut Router1 -->
<?php
require('../controller/ControllerSite.php');

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

  case "inscription":
  case "connexion":
  case "inscription_traitement":
  case "connection_traitement":
    ControllerSite::$action();
    // Tache par défaut
  default:
    $action = "Accueil";
    ControllerSite::$action();
}
require('../view/fragment/fragmentFooter.html');
?>
<!-- ----- Fin Router1 -->