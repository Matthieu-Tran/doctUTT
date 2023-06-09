<?php
require_once '../model/ModelSpecialite.php';
require_once '../model/ModelPersonne.php';
require_once '../model/ModelRdv.php';

class ControleurAdministrateur
{
    // Liste des spécialités
    public static function specialiteListe()
    {
        $results = ModelSpecialite::getAll();
        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewListe.php';
        require($vue);
    }

    // Affiche un formulaire pour sélectionner une spécialité par son id
    public static function specialiteSelectionId($args)
    {
        $results = ModelSpecialite::getAllId();

        // Passage du nom de la méthode cible pour le champ action du formulaire
        $target = $args['target'];

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewSelectionId.php';
        require($vue);
    }

    // Affiche une spécialité particulière (id)
    public static function specialiteAfficher()
    {
        $specialite_id = $_GET['id'];
        $results = ModelSpecialite::getById($specialite_id);

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewListeSpecialites.php';
        require($vue);
    }

    // Affiche le formulaire de création d'une spécialité
    public static function specialiteCreer()
    {
        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewCreer.php';
        require($vue);
    }

    // Insère une nouvelle spécialité
    public static function specialiteInserer()
    {
        // Ajouter une validation des informations du formulaire
        $label = htmlspecialchars($_GET['label']);
        $results = ModelSpecialite::getLabelbyLabel($label);
        if ($results !== NULL) {
            echo '<script>window.location.href = "router.php?action=specialiteCreer&label_err=true";</script>';
            die();
        }
        $results = ModelSpecialite::insertSpecialite(
            htmlspecialchars($_GET['label'])
        );

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewInserer.php';
        require($vue);
    }

    // Liste des praticiens avec leurs spécialités
    public static function praticienListeSpecialite()
    {
        $results = ModelSpecialite::getPraticiensParSpecialite();
        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewListePraticiensParSpecialite.php';
        require($vue);
    }

    // Donne le nombre de praticiens par patient
    public static function nombrePraticiensParPatient()
    {
        $results = ModelRdv::getNombrePraticiensParPatient();
        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewNombrePraticiensParPatient.php';
        require($vue);
    }

    // Liste des spécialités
    public static function listeSpecialites()
    {
        $results = ModelSpecialite::getAll();

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/viewListeSpecialites.php';
        require($vue);
    }

    // Liste des praticiens
    public static function listePraticiens()
    {
        $results = ModelPersonne::getMany("SELECT * FROM personne WHERE statut = " . ModelPersonne::PRATICIEN);

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewListePraticiens.php';
        require($vue);
    }

    // Liste des patients
    public static function listePatients()
    {
        $results = ModelPersonne::getMany("SELECT * FROM personne WHERE statut = " . ModelPersonne::PATIENT);

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewListePatients.php';
        require($vue);
    }

    // Liste des administrateurs
    public static function listeAdministrateurs()
    {
        $results = ModelPersonne::getMany("SELECT * FROM personne WHERE statut = " . ModelPersonne::ADMINISTRATEUR);

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewListeAdministrateurs.php';
        require($vue);
    }

    // Liste de tous les rendez-vous
    public static function listeRendezVous()
    {
        $results = ModelRdv::getAll();

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewListeRendezVous.php';
        require($vue);
    }

    // Liste des spécialités, praticiens, patients, administrateurs, rendez-vous
    public static function infoAdmin()
    {
        $listeSpecialites = ModelSpecialite::getAll();
        $listePraticiens = ModelPersonne::getMany("SELECT id, nom, prenom, adresse  FROM personne WHERE statut = " . ModelPersonne::PRATICIEN);
        $listePatients = ModelPersonne::getMany("SELECT id, nom, prenom, adresse FROM personne WHERE statut = " . ModelPersonne::PATIENT);
        $listeAdministrateurs = ModelPersonne::getMany("SELECT id, nom, prenom, adresse FROM personne WHERE statut = " . ModelPersonne::ADMINISTRATEUR);
        $listeRendezVous = ModelRdv::getAll();

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/administrateur/infoAdmin.php';
        require($vue);
    }
}
