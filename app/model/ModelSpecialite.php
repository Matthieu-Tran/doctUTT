<!-- ----- debut ModelSpecialite -->

<?php
require_once 'Model.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelSpecialite extends Model
{
    private $id;
    private $label;

    public function __construct($id = NULL, $label = NULL)
    {
        if (!is_null($id) && !is_null($label)) {
            $this->id = $id;
            $this->label = $label;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM specialite";
            $stmt = $database->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $specialites = [];
            foreach ($results as $result) {
                $specialites[] = new ModelSpecialite($result['id'], $result['label']);
            }
            return $specialites;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de toutes les spécialités: " . $e->getMessage());
        }
    }

    public static function getAllId()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT id FROM specialite";
            $stmt = $database->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $results;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération de tous les IDs de spécialité: " . $e->getMessage());
        }
    }


    public static function insertSpecialite($label)
    {
        try {
            $database = Model::getInstance();
            $query = "INSERT INTO specialite (label) VALUES (:label)";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':label', $label);
            $stmt->execute();
            return $database->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'insertion de la spécialité: " . $e->getMessage());
        }
    }

    public static function deleteSpecialite($id)
    {
        try {
            $database = Model::getInstance();
            $query = "DELETE FROM specialite WHERE id = :id";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la spécialité: " . $e->getMessage());
        }
    }

    public static function getById($id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT * from specialite where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelSpecialite");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getLabelById($id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT label FROM specialite WHERE id = :id";
            $stmt = $database->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['label'];
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du label de la spécialité par ID: " . $e->getMessage());
        }
    }
}
?>
<!-- ----- fin ModelSpecialite -->