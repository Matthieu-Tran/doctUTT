<?php
require_once '../model/ModelSpecialite.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelRdv.php';

class ControleurPatient
{
    public static function afficherInfosCompte()
    {
        //$patienId = $_SESSION['id'];
        $patientId = 201;

        $results = ModelPersonne::getInformationsCompte($patientId);
        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/patient/viewInfoCompte.php';
        require($vue);
    }

    public static function listerRdvPatient()
    {
        //$patienId = $_SESSION['id'];
        $patientId = 205;
        $results = ModelPersonne::listeRdvPatient($patientId);

        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/patient/viewListRdv.php';
        require($vue);
    }

    public static function listerRdvDispoPraticien()
    {

        $praticiens = ModelPersonne::getAllPraticiens();

        //Construction de la vue
        include 'config.php';
        $vue = $root . '/app/view/patient/viewFormListPraticien.php';
        require($vue);
    }

    public static function selectionnezRdv()
    {
        if (isset($_POST['praticien'])) {
            $praticienId = $_POST['praticien'];
            $rdvDisponibles = ModelRdv::getRdvDisponibles($praticienId);
            $praticien = ModelPersonne::getOne($praticienId);
            //Construction de la vue
            include 'config.php';
            $vue = $root . '/app/view/patient/viewFormRdvDispo.php';
            if (DEBUG)
                echo ("ControleurPraticien : afficherRdvDisponibles : vue = $vue");
            require($vue);
        }
    }

    public static function updateRdv()
    {
        if (isset($_POST['rdv'])) {
            $rdvId = $_POST['rdv'];
            //$patienId = $_SESSION['id'];
            $patientId = 205;
            $result = ModelRdv::updateRdv($rdvId, $patientId);
            $rdv = ModelRdv::getOne($rdvId);

            //Construction de la vue
            include 'config.php';
            $vue = $root . '/app/view/patient/viewUpdatedRdv.php';
            if (DEBUG)
                echo ("ControleurPraticien : afficherRdvDisponibles : vue = $vue");
            require($vue);
        }
    }
}
