<?php

require_once '../model/ModelSpecialite.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelRdv.php';

class ControleurPraticien
{

    public static function rdvCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewInsertRdv.php';
        require($vue);
    }

    public static function afficherRdvDisponibles()
    {
        // Récupérer l'ID du praticien connecté
        $praticienId = $_SESSION['id'];
        $rdvsDisponibles = ModelRdv::getRdvDisponibles($praticienId);

        include 'config.php';
        $vue = $root . '/app/view/praticien/viewAllrdv.php';
        if (DEBUG)
            echo ("ControleurPraticien : afficherRdvDisponibles : vue = $vue");
        require($vue);
    }

    public static function rdvCreated()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datePost = $_POST["date"];
            $nombreRdv = $_POST["nombre_rdv"];
            // Récupérer l'ID du praticien connecté
            $praticienId = $_SESSION['id'];

            $nbRdvExisted = ModelRdv::countRdvByDate($datePost);
            if ($nombreRdv + $nbRdvExisted <= 9 && $nbRdvExisted < 9) {

                switch ($nbRdvExisted) {
                    case 0:
                        $date = $datePost . " à 10h00";
                        break;
                    case 1:
                        $date = $datePost . " à 11h00";
                        break;
                    case 2:
                        $date = $datePost . " à 12h00";
                        break;
                    case 3:
                        $date = $datePost . " à 13h00";
                        break;
                    case 4:
                        $date = $datePost . " à 14h00";
                        break;
                    case 5:
                        $date = $datePost . " à 15h00";
                        break;
                    case 6:
                        $date = $datePost . " à 16h00";
                        break;
                    case 7:
                        $date = $datePost . " à 17h00";
                        break;
                    case 8:
                        $date = $datePost . " à 18h00";
                        break;
                    default:
                        echo "Le nombre de rendez-vous est invalide.";
                        break;
                }

                // Ajouter une nouvelle disponibilité
                $results = ModelRdv::ajouterRdvDisponibles($praticienId, $date, $nombreRdv);

                //Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/praticien/viewInsertedRdv.php';
                require($vue);
            } else {
                //Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/praticien/viewRefusRdv.php';
                require($vue);
            }
        }
    }

    public static function listerRdvPraticien()
    {
        // Récupérer l'ID du praticien connecté
        $praticienId = $_SESSION['id'];
        // Récupérer tous les rendez-vous du praticien
        $rdvsPraticien = ModelRdv::getRdvByPraticien($praticienId);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewAllRdvPatient.php';
        require($vue);
    }

    public static function listerPatientPraticien()
    {
        // Récupérer l'ID du praticien connecté
        $praticienId = $_SESSION['id'];
        // Récupérer tous les rendez-vous du praticien
        $listePatients = ModelPersonne::listePatientsPraticien($praticienId);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewAllPatient.php';
        require($vue);
    }
}
