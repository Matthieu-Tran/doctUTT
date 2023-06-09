<!-- ----- debut ModelPersonne -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelPersonne
{
    private $id, $nom, $prenom, $adresse, $login, $password, $statut, $specialite_id;
    const ADMINISTRATEUR = 0;
    const PRATICIEN = 1;
    const PATIENT = 2;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL, $login = NULL, $password = NULL, $statut = NULL, $specialite_id = NULL)
    {
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->login = $login;
            $this->password = $password;
            $this->statut = $statut;
            $this->specialite_id = $specialite_id;
        }
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function setSpecialiteId($specialite_id)
    {
        $this->specialite_id = $specialite_id;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getSpecialiteId()
    {
        return $this->specialite_id;
    }

    public static function getStatusLabel($statut)
    {
        switch ($statut) {
            case self::ADMINISTRATEUR:
                return "Administrateur";
            case self::PRATICIEN:
                return "Praticien";
            case self::PATIENT:
                return "Patient";
            default:
                return "";
        }
    }

    public static function getAllId()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT id FROM personne";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getPraticiensAvecRdvDisponibles()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT p.*
                  FROM personne AS p
                  INNER JOIN rendezvous AS rdv ON rdv.praticien_id = p.id
                  WHERE p.statut = :statut
                  AND rdv.patient_id = 0";
            $stmt = $database->prepare($query);
            $stmt->bindValue(':statut', ModelPersonne::PRATICIEN, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function getMany($query)
    {
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $result = $statement->fetchObject(self::class);
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getUser($login)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE login = :login";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function listePatientsPraticien($praticienId)
    {
        try {
            $database = Model::getInstance();

            // Sélectionner les rendez-vous distincts pour le praticien
            $query = "SELECT DISTINCT personne.id, personne.nom, personne.prenom, personne.adresse
                  FROM personne
                  INNER JOIN rendezvous ON personne.id = rendezvous.patient_id
                  WHERE rendezvous.praticien_id = :praticienId AND personne.id > 0";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':praticienId', $praticienId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");

            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de la liste des patients : " . $e->getMessage());
        }
    }

    public static function listeRdvPatient($patientId)
    {
        try {
            $database = Model::getInstance();

            // Requête pour récupérer les rendez-vous du patient avec les informations du praticien
            $query = "SELECT rdv.id, rdv.rdv_date, p.nom, p.prenom
          FROM rendezvous AS rdv
          INNER JOIN personne AS p ON rdv.praticien_id = p.id
          WHERE rdv.patient_id = :patientId";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des rendez-vous du patient : " . $e->getMessage());
        }
    }

    public static function getInformationsCompte($patientId)
    {
        try {
            $database = Model::getInstance();

            // Requête pour récupérer les informations du compte patient
            $query = "SELECT * FROM personne WHERE id = :patientId";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des informations du compte patient : " . $e->getMessage());
        }
    }



    public static function insert($nom, $prenom, $adresse, $login, $password, $statut, $specialite_id)
    {
        try {
            $database = Model::getInstance();

            // Recherche de la valeur de la clé = max(id) + 1
            $query = "SELECT MAX(id) FROM personne";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // Ajout d'un nouveau tuple
            $query = "INSERT INTO personne VALUE (:id, :nom, :prenom, :adresse, :login, :password, :statut, :specialite_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'adresse' => $adresse,
                'login' => $login,
                'password' => $password,
                'statut' => $statut,
                'specialite_id' => $specialite_id
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function delete($id)
    {
        try {
            $database = Model::getInstance();
            $query = "DELETE FROM personne WHERE id=:id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
<!-- ----- fin ModelPersonne -->