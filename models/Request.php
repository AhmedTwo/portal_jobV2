<?php
class Request
{
    public $id;
    public $title;
    public $description;
    public $type;
    public $status;
    public $created_at;
    public $updated_at;
    public $user_id;
    public $pdo;

    public function __construct(
        $title = null,
        $description = null,
        $type = null,
        $status = null,
        $created_at = null,
        $user_id = null,
        $id = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->user_id = $user_id;
        $this->id = $id;

        $dsn = "mysql:host=localhost;dbname=job_portal;charset=utf8";
        $username = "root";
        $password = "root";

        try {
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            echo "Connexion échouée! " . $e->getMessage();
        }
    }

    public function addRequest()
    {
        $query = '
            INSERT INTO request (title, description, type, status, created_at, user_id)
            VALUES (:title, :description, :type, :status, :created_at, :user_id)
        ';
        $pdostmt = $this->pdo->prepare($query);

        return $pdostmt->execute([
            ":title" => $this->title,
            ":description" => $this->description,
            ":type" => $this->type,
            ":status" => $this->status,
            ":created_at" => $this->created_at,
            ":user_id" => $this->user_id,
        ]);
    }

    public function getAll()
    {
        $query = "
            SELECT 
                r.id,
                r.title,
                r.description,
                r.type,
                r.status,
                r.created_at,
                r.user_id,
                u.nom AS user_firstname,
                u.prenom AS user_lastname,
                u.photo AS user_photo
            FROM request r
            LEFT JOIN users u ON r.user_id = u.id
            ORDER BY r.created_at DESC
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "
            SELECT *
            FROM request r
            LEFT JOIN users u ON r.user_id = u.id
            WHERE r.user_id = :id
            ORDER BY r.created_at DESC
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM request WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function updateStatus($id, $newStatus)
    {
        $query = "UPDATE request SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'status' => $newStatus,
            'id' => $id
        ]);
    }

    // Getters / Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }
}
