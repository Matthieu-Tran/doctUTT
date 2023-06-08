<?php

require_once '../model/ModelSpecialite.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelRdv.php';

class ControleurPraticien
{
    public function afficherRdvDisponibles()
    {
        // Récupérer l'ID du praticien connecté
        $praticienId = $_SESSION['praticien_id'];

        // Récupérer les rendez-vous disponibles du praticien
        $rdvsDisponibles = ModelRdv::getRdvDisponibles($praticienId);

        // Afficher les rendez-vous disponibles
        foreach ($rdvsDisponibles as $rdv) {
            echo "Rendez-vous disponible - Date: " . $rdv->getRdvDate() . " - Nombre de places disponibles: " . $rdv->getNombrePlacesDisponibles() . "<br>";
        }
    }

    /*public function ajouterDisponibilite($date, $nombreRdv)
    {
        // Récupérer l'ID du praticien connecté
        $praticienId = $_SESSION['praticien_id'];

        // Ajouter une nouvelle disponibilité
        ModelRdv::ajouterDisponibilite($praticienId, $date, $nombreRdv);

        echo "La disponibilité a été ajoutée avec succès.";
    }*/

    public static function listerRdvPraticien()
    {
        // Récupérer l'ID du praticien connecté
        //$praticienId = $_SESSION['praticien_id'];
        $praticienId = 50;
        // Récupérer tous les rendez-vous du praticien
        $rdvsPraticien = ModelRdv::getRdvByPraticien($praticienId);

        // Afficher les rendez-vous avec les noms des patients
        foreach ($rdvsPraticien as $rdv) {
            $patientNom = ModelPersonne::getOne($rdv->getPatientId());
            $rdvDate = $rdv->getRdvDate();
            echo "Rendez-vous avec " . $patientNom->getPrenom() . " - Date: " . $rdvDate . "<br>";
        }
    }
}
