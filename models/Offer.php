<?php
require_once dirname(__DIR__) . '/config/database.php';

class Offer
{
    private $id;
    private $title;
    private $description;
    private $mission;
    private $location;
    private $category;
    private $employment_type_id;
    private $technologies;
    private $benefits;
    private int $participants_count;
    private $created_at;
    private $image_url;
    private $id_company;


    public function findAll($pdo)
    {
        // Récupération des offres
        $sql = "
    SELECT job_offers.*,
       c.id AS id_company, c.logo AS company_logo,
       e.name AS contrat
    FROM job_offers 
    JOIN company AS c ON job_offers.id_company = c.id
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    ORDER BY id asc
    ";
        $pdostmt = $pdo->prepare($sql);
        $pdostmt->execute();
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find3($pdo)
    {
        $sql = "
        SELECT job_offers.*,
               c.id AS id_company,
               c.logo AS company_logo,
               e.name AS contrat
        FROM job_offers 
        JOIN company AS c ON job_offers.id_company = c.id
        JOIN employment_type e ON job_offers.employment_type_id = e.id
        ORDER BY id DESC LIMIT 3
    ";
    
    $pdostmt = $pdo->prepare($sql);
    $pdostmt->execute();
    return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOfferCompany($pdo)
    {

        $id = (int) $_GET['id']; // Nettoyage de l'ID pour éviter des injections SQL

        // recuperation du details de la compagnie
        $pdostmt = $pdo->prepare("
    SELECT * FROM company
    WHERE id = :id
    ");
        $pdostmt->execute([':id' => $id]);
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function offerDetailCompany($pdo, $id)
    {

        // recuperation du details des offres de la compagnie
        $pdostmt = $pdo->prepare("
    SELECT job_offers.*, e.name AS contrat 
    FROM job_offers
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    WHERE id_company = :id
    ");
        $pdostmt->execute([':id' => $id]);
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($pdo, $id)
    {
        $sql = "
    SELECT job_offers.*, e.name AS contrat, c.name AS nom_company
    FROM job_offers
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    JOIN company c ON job_offers.id_company = c.id
    WHERE job_offers.id = :id
    ";
        $pdostmt = $pdo->prepare($sql);
        $pdostmt->execute(['id' => $id]);
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addOffers($pdo)
    {
        $query = "
        INSERT INTO job_offers (title, description, mission, location, category, id_company, employment_type_id, technologies_used, benefits, created_at, image_url)
        VALUES ( :titre, :description, :mission, :adresse, :poste, :id_company, :contrat, :technologie, :positif, :dateCreation, :imageUrl)";

        $pdostmt = $pdo->prepare($query);

        return $pdostmt->execute([
            ":titre" => $this->title,
            ":description" => $this->description,
            ":mission" => $this->mission,
            ":adresse" => $this->location,
            ":poste" => $this->category,
            ":id_company" => $this->id_company,
            ":contrat" => $this->employment_type_id,
            ":technologie" => $this->technologies,
            ":positif" => $this->benefits,
            ":dateCreation" => $this->created_at,
            ":imageUrl" => $this->image_url
        ]);
    }

    public function UpdateOffer($pdo)
    {
        if (!empty($_GET["idO"])) {
            $query = "
            SELECT job_offers.*, e.name AS contrat
            FROM job_offers 
            JOIN employment_type e ON job_offers.employment_type_id = e.id
            WHERE job_offers.id = :id
            ";
            $pdostmt = $pdo->prepare($query);
            $pdostmt->execute(["id" => $_GET["idO"]]);
            return $pdostmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function updateOfferInDB($pdo, $data)
    {
        $query = "
        UPDATE job_offers SET
            title = :title,
            category = :category,
            location = :location,
            employment_type_id = :employment_type_id,
            mission = :mission,
            description = :description,
            technologies_used = :technologies_used,
            benefits = :benefits,
            participants_count = :participants_count,
            created_at = :created_at,
            image_url = :image_url
        WHERE id = :id
    ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'title' => $data['inputTitre'],
            'category' => $data['inputPoste'],
            'location' => $data['inputAdresse'],
            'employment_type_id' => $data['inputContrat'], // attention : doit être l’ID
            'mission' => $data['inputMission'],
            'description' => $data['inputDescription'],
            'technologies_used' => $data['inputTechnologie'],
            'benefits' => $data['inputPositif'],
            'participants_count' => $data['inputNombreParticipant'],
            'created_at' => $data['inputDateCreation'],
            'image_url' => $data['inputImage'],
            'id' => $data['myid'],
        ]);
    }

    public function chooseContrat($pdo)
    {

        // Récupérer la liste des types de contrat
        $queryContrat = "SELECT name, id AS id_contrat FROM employment_type";
        $stmtContrat = $pdo->prepare($queryContrat);
        $stmtContrat->execute();
        return $stmtContrat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function chooseEntreprise($pdo)
    {

        // Récupérer la liste des entreprises
        $queryCompany = "SELECT name, id AS id_company FROM company";
        $stmtCompany = $pdo->prepare($queryCompany);
        $stmtCompany->execute();
        return $stmtCompany->fetchAll(PDO::FETCH_ASSOC);
    }

    public function offerApply($pdo, $id)
    {

        // Récupère l'offre en question
        $id = (int) $_GET['id'];


        // Récupération des détails de l'offre
        $query = "
    SELECT job_offers.*, e.name AS contrat, c.name AS company_name 
    FROM job_offers
    JOIN employment_type e ON job_offers.employment_type_id = e.id
    LEFT JOIN company c ON job_offers.id_company = c.id
    WHERE job_offers.id = :id
    ";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute(['id' => $id]);
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function moreOne($pdo)
    {

        if (!isset($_GET['id'])) {
            die("Offre introuvable !");
        }

        $id = (int) $_GET['id'];

        // ✅ Incrémentation du nombre de participants
        $updateSql = "UPDATE job_offers SET participants_count = participants_count + 1 WHERE id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        return $updateStmt->execute(['id' => $id]);
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
     * Get the value of mission
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set the value of mission
     *
     * @return  self
     */
    public function setMission($mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of employment_type_id
     */
    public function getEmployment_type_id()
    {
        return $this->employment_type_id;
    }

    /**
     * Set the value of employment_type_id
     *
     * @return  self
     */
    public function setEmployment_type_id($employment_type_id)
    {
        $this->employment_type_id = $employment_type_id;

        return $this;
    }

    /**
     * Get the value of technologies
     */
    public function getTechnologies()
    {
        return $this->technologies;
    }

    /**
     * Set the value of technologies
     *
     * @return  self
     */
    public function setTechnologies($technologies)
    {
        $this->technologies = $technologies;

        return $this;
    }

    /**
     * Get the value of benefits
     */
    public function getBenefits()
    {
        return $this->benefits;
    }

    /**
     * Set the value of benefits
     *
     * @return  self
     */
    public function setBenefits($benefits)
    {
        $this->benefits = $benefits;

        return $this;
    }

    /**
     * Get the value of participants_count
     */
    public function getParticipants_count()
    {
        return $this->participants_count;
    }

    /**
     * Set the value of participants_count
     *
     * @return  self
     */
    public function setParticipants_count($participants_count)
    {
        $this->participants_count = $participants_count;

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
     * Get the value of image_url
     */
    public function getImage_url()
    {
        return $this->image_url;
    }

    /**
     * Set the value of image_url
     *
     * @return  self
     */
    public function setImage_url($image_url)
    {
        $this->image_url = $image_url;

        return $this;
    }

    /**
     * Get the value of id_company
     */
    public function getId_company()
    {
        return $this->id_company;
    }

    /**
     * Set the value of id_company
     *
     * @return  self
     */
    public function setId_company($id_company)
    {
        $this->id_company = $id_company;

        return $this;
    }
}
