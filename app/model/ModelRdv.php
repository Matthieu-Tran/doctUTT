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
    private $practicien_id;
    private $rdv_date;

    public function __construct($id = NULL, $patient_id = NULL, $practicien_id = NULL, $rdv_date = NULL)
    {
        if (!is_null($id) && !is_null($patient_id) && !is_null($practicien_id) && !is_null($rdv_date)) {
            $this->id = $id;
            $this->patient_id = $patient_id;
            $this->practicien_id = $practicien_id;
            $this->rdv_date = $rdv_date;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPatientId()
    {
        return $this->patient_id;
    }

    public function getPracticienId()
    {
        return $this->practicien_id;
    }

    public function getRdvDate()
    {
        return $this->rdv_date;
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous";
            $stmt = $database->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rdvs = [];
            foreach ($results as $result) {
                $rdvs[] = new ModelRdv($result['id'], $result['patient_id'], $result['praticien_id'], $result['rdv_date']);
            }
            return $rdvs;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de tous les rendez-vous: " . $e->getMessage());
        }
    }

    public static function getRdvByPraticien($praticienId)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous WHERE praticien_id = :praticienId";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':praticienId', $praticienId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rdvs = [];
            foreach ($results as $result) {
                $rdv = new ModelRdv(
                    $result['id'],
                    $result['patient_id'],
                    $result['praticien_id'],
                    $result['rdv_date']
                );
                $rdvs[] = $rdv;
            }
            return $rdvs;
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
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rdvs = [];
            foreach ($results as $result) {
                $rdv = new ModelRdv(
                    $result['id'],
                    $result['patient_id'],
                    $result['praticien_id'],
                    $result['rdv_date']
                );
                $rdvs[] = $rdv;
            }
            return $rdvs;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des rendez-vous pour le patient: " . $e->getMessage());
        }
    }

    public static function getRdvDisponibles($practicienId)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM rendezvous WHERE praticien_id = :practicienId AND patient_id = 0";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':practicienId', $practicienId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rdvs = [];
            foreach ($results as $result) {
                $rdv = new ModelRdv(
                    $result['id'],
                    $result['patient_id'],
                    $result['praticien_id'],
                    $result['rdv_date']
                );
                $rdvs[] = $rdv;
            }
            return $rdvs;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des rendez-vous disponibles pour le praticien: " . $e->getMessage());
        }
    }

    public static function addRdv($patientId, $practicienId, $rdvDate)
    {
        try {
            $database = Model::getInstance();
            $query = "INSERT INTO rendezvous (patient_id, praticien_id, rdv_date) VALUES (:patientId, :practicienId, :rdvDate)";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':patientId', $patientId, PDO::PARAM_INT);
            $stmt->bindParam(':practicienId', $practicienId, PDO::PARAM_INT);
            $stmt->bindParam(':rdvDate', $rdvDate);
            $stmt->execute();
            return $database->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du rendez-vous: " . $e->getMessage());
        }
    }
}
?>
<!-- ----- fin ModelRdv -->