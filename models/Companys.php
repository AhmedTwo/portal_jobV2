<?php

class Company
{
    public $id;
    public $name;
    public $logo;
    public int $number_of_employees;
    public $industry;
    public $adress;
    public $latitude;
    public $longitude;
    public $description;
    public int $n_siret;

    public function findAll($pdo)
    {
        $sql = "SELECT * FROM company";
        $pdostmt = $pdo->prepare($sql);
        $pdostmt->execute();
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readCompany($pdo)
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

    public function findById($pdo, $id)
    {
        $id = (int) $_GET['id'];

        $sql = "SELECT * FROM company WHERE id = :id";
        $pdostmt = $pdo->prepare($sql);
        $pdostmt->bindParam(':id', $id, PDO::PARAM_INT); // protège contre les injections SQL ou types inattendus.
        $pdostmt->execute();
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCompany($pdo)
    {
        $query = "
        INSERT INTO company (
        name, number_of_employees, industry, address,  latitude, longitude, description, n_siret, logo )
        VALUES ( :nom, :nbEmploye, :domaine, :adresse, :latitude, :longitude, :description, :n_siret, :logo )";

        $pdostmt = $pdo->prepare($query);

        return $pdostmt->execute([
            ":nom" => $_POST["inputNom"],
            ":logo" => $_POST["inputLogo"],
            ":nbEmploye" => $_POST["inputNbEmploye"],
            ":domaine" => $_POST["inputDomaine"],
            ":adresse" => $_POST["inputAdresse"],
            ":latitude" => $_POST["inputLatitutde"],
            ":longitude" => $_POST["inputLongitude"],
            ":description" => $_POST["inputDescription"],
            ":n_siret" => $_POST["inputSiret"]
        ]);
    }

    public function UpdateCompany($pdo)
    {
        if (!empty($_GET["idC"])) {
            $query = "
        SELECT *
        FROM company
        WHERE id = :id
        ";
            $pdostmt = $pdo->prepare($query);
            $pdostmt->execute(["id" => $_GET["idC"]]);
            return $pdostmt->fetch(PDO::FETCH_ASSOC);
        }
    }


    public function updateCompanyInDB($pdo, $data)
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
        email_company = :email,
        n_siret = :siret
    WHERE id = :id
    ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'name' => $data['inputNom'],
            'logo' => $data['inputLogo'],
            'nb_employees' => $data['inputNbEmploye'],
            'industry' => $data['inputDomaine'],
            'address' => $data['inputAdresse'],
            'latitude' => $data['inputLatitude'],
            'longitude' => $data['inputLongitude'],
            'description' => $data['inputDescription'],
            'email' => $data['inputEmail'],
            'siret' => $data['inputSiret'],
            'id' => $data['myid']
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

    public function getAdress()
    {
        return $this->adress;
    }

    public function setAdress($adress)
    {
        $this->adress = $adress;
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
