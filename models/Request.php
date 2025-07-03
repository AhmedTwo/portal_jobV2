<?php
require_once dirname(__DIR__) . '/config/database.php';

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
    public $company_id;

    public function __construct(
        $title = null,
        $description = null,
        $type = null,
        $status = null,
        $created_at = null,
        $user_id = null,
        $company_id = null,
        $id = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->user_id = $user_id;
        $this->company_id = $company_id;
        $this->id = $id;
    }

    public function addRequest($pdo)
    {
        $query = '
            INSERT INTO request (title, description, type, status, created_at, user_id, company_id)
            VALUES (:title, :description, :type, :status, :created_at, :user_id, :company_id)
        ';
        $pdostmt = $pdo->prepare($query);

        return $pdostmt->execute([
            ":title" => $this->title,
            ":description" => $this->description,
            ":type" => $this->type,
            ":status" => $this->status,
            ":created_at" => $this->created_at,
            ":user_id" => $this->user_id,
            ":company_id" => $this->company_id,
        ]);
    }

    public function getAll($pdo)
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
                r.company_id,
                u.nom AS user_firstname,
                u.prenom AS user_lastname,
                u.photo AS user_photo,
                c.logo AS company_photo,
                c.name AS company_name
            FROM request r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN company c ON r.company_id = c.id
            ORDER BY r.created_at DESC
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of company_id
     */
    public function getCompany_id()
    {
        return $this->company_id;
    }

    /**
     * Set the value of company_id
     *
     * @return  self
     */
    public function setCompany_id($company_id)
    {
        $this->company_id = $company_id;

        return $this;
    }
}
