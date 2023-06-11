<!-- ----- debut ModelRdv -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelRdv extends Model
{
    private $id;
    private $patient_id;
    private $praticien_id;
    private $rdv_date;

    public function __construct($id = NULL, $patient_id = NULL, $praticien_id = NULL, $rdv_date = NULL)
    {
        if (!is_null($id) && !is_null($patient_id) && !is_null($praticien_id) && !is_null($rdv_date)) {
            $this->id = $id;
            $this->patient_id = $patient_id;
            $this->praticien_id = $praticien_id;
            $this->rdv_date = $rdv_date;
        }
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPatientId($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function setPraticienId($praticien_id)
    {
        $this->praticien_id = $praticien_id;
    }

    public function setRdvDate($rdv_date)
    {
        $this->rdv_date = $rdv_date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPatientId()
    {
        return $this->patient_id;
    }

    public function getPraticienId()
    {
        return $this->praticien_id;
    }

    public function getRdvDate()
    {
        return $this->rdv_date;
    }

    public static function getOne($idRdv)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous WHERE id = :id";
            $statement = $database->prepare($query);
            $statement->bindParam(':id', $idRdv, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchObject(self::class);
            return $result;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous";
            $stmt = $database->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de tous les rendez-vous: " . $e->getMessage());
        }
    }

    public static function getRdvByPraticien($praticienId)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous WHERE praticien_id = :praticienId AND patient_id > 0";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':praticienId', $praticienId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des rendez-vous du praticien : " . $e->getMessage());
        }
    }




    public static function getByPatientId($patientId)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous WHERE patient_id = :patientId";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des rendez-vous pour le patient: " . $e->getMessage());
        }
    }

    public static function getRdvDisponibles($praticienId)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous WHERE praticien_id = :praticienId AND patient_id = 0";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':praticienId', $praticienId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des rendez-vous disponibles pour le praticien: " . $e->getMessage());
        }
    }

    public static function addRdv($patientId, $praticienId, $rdvDate)
    {
        try {
            $database = Model::getInstance();
            $query = "INSERT INTO rendezvous (patient_id, praticien_id, rdv_date) VALUES (:patientId, :praticienId, :rdvDate)";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->bindParam(':praticienId', $praticienId, PDO::PARAM_INT);
            $stmt->bindParam(':rdvDate', $rdvDate);
            $stmt->execute();
            return $database->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du rendez-vous: " . $e->getMessage());
        }
    }

    public static function getNombrePraticiensParPatient()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT CONCAT(nom, ' ', prenom) AS patient_name, COUNT(DISTINCT praticien_id) AS nombre_praticiens
                      FROM rendezvous
                      INNER JOIN personne ON rendezvous.patient_id = personne.id
                      WHERE personne.statut = 2
                      GROUP BY personne.id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $data = array(
                'patient_name' => array_column($results, 'patient_name'),
                'nombre_praticiens' => array_column($results, 'nombre_praticiens')
            );
            return $data;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    public static function updateRdv($rdvId, $patientId)
    {
        try {
            $database = Model::getInstance();
            // Requête de mise à jour
            $query = "UPDATE rendezvous SET patient_id = :patientId WHERE id = :rdvId";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->bindParam(':rdvId', $rdvId, PDO::PARAM_INT);

            // Exécution de la requête
            $stmt->execute();

            // Vérification du succès de la mise à jour
            if ($stmt->rowCount() > 0) {
                return true; // La modification a été effectuée avec succès
            } else {
                return false; // La modification a échoué
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du rendez-vous: " . $e->getMessage());
        }
    }

    public static function ajouterRdvDisponibles($praticienId, $date, $nombreRdv)
    {
        try {
            $database = Model::getInstance();

            // Recherche de la valeur de la clé = max(id) + 1
            $query = "SELECT MAX(id) FROM rendezvous";
            $stmt = $database->query($query);
            $tuple = $stmt->fetch();
            $id = $tuple[0];
            $id++;

            // Récupérer l'heure entre le "à" et le "h"
            $heure = substr($date, strpos($date, "à") + 2, strpos($date, "h") - strpos($date, "à") - 2);

            // Incrémenter le chiffre de l'heure de 1
            $nouvelleHeure = intval($heure);

            // Mettre à jour la date avec la nouvelle heure
            $nouvelleDate = str_replace($heure . "h", " " . str_pad($nouvelleHeure, 2, "0", STR_PAD_LEFT) . "h", $date);

            // Insérer les nouveaux rendez-vous
            $query = "INSERT INTO rendezvous (id, praticien_id, rdv_date) VALUES (:id, :praticienId, :date)";
            $stmt = $database->prepare($query);


            for ($i = 0; $i < $nombreRdv; $i++) {
                $ids[] = $id;
                $stmt->execute([
                    'id' => $id,
                    'praticienId' => $praticienId,
                    'date' => $nouvelleDate
                ]);

                // Incrémenter le chiffre de l'heure pour les prochains rendez-vous
                $nouvelleHeure++;
                $nouvelleDate = str_replace(" " . str_pad($nouvelleHeure - 1, 2, "0", STR_PAD_LEFT) . "h", " " . str_pad($nouvelleHeure, 2, "0", STR_PAD_LEFT) . "h", $nouvelleDate);
                $id++;
            }

            return  $ids;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout des rendez-vous : " . $e->getMessage());
        }
    }
}
?>
<!-- ----- fin ModelRdv -->