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
        $vue = $root . '/app/view/specialite/viewSelectionId.php';
        require($vue);
    }

    // Affiche une spécialité particulière (id)
    public static function specialiteAfficher()
    {
        $specialite_id = $_GET['id'];
        $results = ModelSpecialite::getById($specialite_id);

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewListe.php';
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
        $results = ModelSpecialite::insertSpecialite(
            htmlspecialchars($_GET['nom'])
        );

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/specialite/viewInserer.php';
        require($vue);
    }

    // Liste des praticiens avec leurs spécialités
    public static function praticienListeSpecialite()
    {
        $results = ModelPersonne::getMany("SELECT * FROM personne WHERE statut = " . ModelPersonne::PRATICIEN);

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewListeSpecialite.php';
        require($vue);
    }

    // Donne le nombre de praticiens par patient
    public static function nombrePraticiensParPatient()
    {
        $results = ModelPersonne::getMany("SELECT COUNT(*) AS nb_praticiens, specialite_id FROM personne WHERE statut = " . ModelPersonne::PRATICIEN . " GROUP BY specialite_id");

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/praticien/viewNombrePraticiensParPatient.php';
        require($vue);
    }

    // Liste des spécialités
    public static function listeSpecialites()
    {
        $results = ModelSpecialite::getAll();

        // Construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewListeSpecialites.php';
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
}
