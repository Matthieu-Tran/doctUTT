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
            $date = $datePost . " " . "à 10h00";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";
            echo "test <br>";

            echo $date . ' ' . $praticienId . ' ' . $nombreRdv;

            // Ajouter une nouvelle disponibilité
            $results = ModelRdv::ajouterRdvDisponibles($praticienId, $date, $nombreRdv);
            foreach ($results as $res) {
                echo ("<li>idRdv = " . $res . "</li>");
                echo ("<ul>");
                echo ("<li>date = " . $_POST['date'] . "</li>");
                echo ("</ul>");
            }
            // ----- Construction chemin de la vue
            // include 'config.php';
            // $vue = $root . '/app/view/praticien/viewInsertedRdv.php';
            // require($vue);
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
