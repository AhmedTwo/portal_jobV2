<?php

class Company
{
    public $id;
    public $name;
    public $logo;
    public int $number_of_employees;
    public $industry;
    public $email;
    public $address;
    public $latitude;
    public $longitude;
    public $description;
    public $n_siret; // pas : public int $n_siret;
    public $status;
    private $pdo;

    public function __construct()
    {

        $dsn = "mysql:host=localhost;dbname=job_portal;charset=utf8";
        $username = "root";
        $password = "root";

        try {
            // tente si ca marche
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            // si jamais ca casse tu fait ca (intercepte l'erreur)
            echo "Connexion échouée!" . $e->getMessage();
        }
    }

    public function findAll()
    {
        $sql = "SELECT * FROM company ORDER BY id DESC";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute();
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($email)
    {
        $query = "SELECT * FROM company WHERE email_company = :email_company";
        $pdostmt = $this->pdo->prepare($query);
        $pdostmt->execute(['email_company' => $email]);
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCompanyByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM company WHERE email_company = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM company WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function readCompany()
    {

        $id = (int) $_GET['id']; // Nettoyage de l'ID pour éviter des injections SQL

        // recuperation du details de la compagnie
        $pdostmt = $this->pdo->prepare("
        SELECT * FROM company
        WHERE id = :id
        ");
        $pdostmt->execute([':id' => $id]);
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $id = (int) $id;

        $sql = "SELECT * FROM company WHERE id = :id";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->bindParam(':id', $id, PDO::PARAM_INT); // protège contre les injections SQL ou types inattendus.
        $pdostmt->execute();
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findOffersByCompanyId($companyId)
    {
        $sql = "
        SELECT j.*, c.name AS nom_company, c.logo AS company_logo
        FROM job_offers j
        JOIN company c ON j.id_company = c.id
        WHERE c.id = :id
        ";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute(['id' => $companyId]);
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCompanyIdByUserId($userId)
    {
        $sql = "SELECT company_id FROM users WHERE id = :id";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute([':id' => $userId]);
        return $pdostmt->fetchColumn();
    }

    public function addCompanys()
    {
        $query = "
        INSERT INTO company (
        name, number_of_employees, industry, address, email_company,  latitude, longitude, description, n_siret, logo, status )
        VALUES ( :nom, :nbEmploye, :domaine, :adresse, :email_company, :latitude, :longitude, :description, :n_siret, :logo, :status )";

        $pdostmt = $this->pdo->prepare($query);

        $pdostmt->execute([
            ":nom" => $_POST["inputNom"],
            ":logo" => $_POST["inputLogo"],
            ":nbEmploye" => $_POST["inputNbEmploye"],
            ":email_company" => $_POST["inputEmail"],
            ":domaine" => $_POST["inputDomaine"],
            ":adresse" => $_POST["inputAdresse"],
            ":latitude" => $_POST["inputLatitutde"],
            ":longitude" => $_POST["inputLongitude"],
            ":description" => $_POST["inputDescription"],
            ":n_siret" => $_POST["inputSiret"],
            ":status" => "pending",
        ]);

        return $this->pdo->lastInsertId(); // recup l'id créé

        // var_dump($this->pdo->lastInsertId());
        // die;
    }

    public function UpdateCompany($id)
    {
        if (!empty($id)) {
            $query = "
            SELECT *
            FROM company
            WHERE id = :id
            ";
            $pdostmt = $this->pdo->prepare($query);
            $pdostmt->execute(["id" => $id]);
            return $pdostmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function updateCompanyInDB($data)
    {
        $query = "
            UPDATE company SET
                name = :name,
                logo = :logo,
                number_of_employees = :nb_employees,
                industry = :industry,
                address = :address,
                latitude = :latitude,
                longitude = :longitude,
                description = :description,
                n_siret = :siret
            WHERE id = :id
            ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'name' => $data['inputNom'],
            'logo' => $data['inputLogo'],
            'nb_employees' => $data['inputNbEmploye'],
            'industry' => $data['inputDomaine'],
            'address' => $data['inputAdresse'],
            'latitude' => $data['inputLatitude'],
            'longitude' => $data['inputLongitude'],
            'description' => $data['inputDescription'],
            'siret' => $data['inputSiret'],
            'id' => $data['id']
        ]);
    }

    public function chooseContrat()
    {

        // Récupérer la liste des types de contrat
        $queryContrat = "SELECT name, id AS id_contrat FROM employment_type";
        $stmtContrat = $this->pdo->prepare($queryContrat);
        $stmtContrat->execute();
        return $stmtContrat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function chooseEntreprise()
    {

        // Récupérer la liste des entreprises
        $queryCompany = "SELECT name, id AS id_company FROM company";
        $stmtCompany = $this->pdo->prepare($queryCompany);
        $stmtCompany->execute();
        return $stmtCompany->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $newStatus)
    {
        $query = "UPDATE company SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            'status' => $newStatus,
            'id' => $id
        ]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }


    public function setName($title)
    {
        $this->name = $title;

        return $this;
    }

    public function getLogo()
    {
        return $this->name;
    }


    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    public function getNumber_of_employees()
    {
        return $this->number_of_employees;
    }


    public function setNumber_of_employees(int $number_of_employees)
    {
        $this->number_of_employees = $number_of_employees;

        return $this;
    }

    public function getIndustry()
    {
        return $this->industry;
    }

    public function setIndustry($industry)
    {
        $this->industry = $industry;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getAdress()
    {
        return $this->address;
    }

    public function setAdress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
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

    public function getNSiret()
    {
        return $this->n_siret;
    }

    public function setNSiret(int $n_siret)
    {
        $this->n_siret = $n_siret;
        return $this;
    }
}
