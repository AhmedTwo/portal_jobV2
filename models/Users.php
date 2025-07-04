<?php

class Users
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $password;
    public $role;
    public $telephone;
    public $ville;
    public $code_postal;
    public $cv_pdf;
    public $qualification;
    public $preference;
    public $disponibilite;
    public $photo;

    public function __construct(
        $nom = null,
        $prenom = null,
        $email = null,
        $password = null,
        $role = null,
        $telephone = null,
        $ville = null,
        $code_postal = null,
        $cv_pdf = null,
        $qualification = null,
        $preference = null,
        $disponibilite = null,
        $photo = null,
        $id = null
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->telephone = $telephone;
        $this->ville = $ville;
        $this->code_postal = $code_postal;
        $this->cv_pdf = $cv_pdf;
        $this->qualification = $qualification;
        $this->preference = $preference;
        $this->disponibilite = $disponibilite;
        $this->photo = $photo;
        $this->id = $id;
    }

    public function findAll($pdo)
    {
        $sql = "SELECT * FROM users";
        $pdostmt = $pdo->prepare($sql);
        $pdostmt->execute();
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUsers($pdo)
    {
        $query = '
            INSERT INTO users (nom, prenom, email, password, role, telephone, ville, code_postal, cv_pdf, qualification, preference, disponibilite, photo)
            VALUES (:nom, :prenom, :email, :password, :role, :telephone, :ville, :code_postal, :cv_pdf, :qualification, :preference, :disponibilite, :photo)
        ';
        $stmt = $pdo->prepare($query);

        $stmt->execute([
            ":nom" => $this->nom,
            ":prenom" => $this->prenom,
            ":email" => $this->email,
            ":password" => $this->password,
            ":role" => $this->role,
            ":telephone" => $this->telephone,
            ":ville" => $this->ville,
            ":code_postal" => $this->code_postal,
            ":cv_pdf" => $this->cv_pdf,
            ":qualification" => $this->qualification,
            ":preference" => $this->preference,
            ":disponibilite" => $this->disponibilite,
            ":photo" => $this->photo
        ]);

        return $stmt->rowCount() > 0;
    }

    public function readProfil($pdo, $id)
    {
        $query = '
        SELECT nom, prenom, email, role, telephone, ville, code_postal, cv_pdf, qualification, preference, disponibilite, photo
        FROM users
        WHERE id = :id
    ';

        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function UpdateUser($pdo)
    {
        if (!empty($_GET["idU"])) {
            $query = "
    SELECT *
    FROM users 
    WHERE id = :id
    ";
            $pdostmt = $pdo->prepare($query);
            $pdostmt->execute(["id" => $_GET["idU"]]);
            return $pdostmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function chooseContrat($pdo)
    {

        // Récupérer la liste des types de contrat
        $queryContrat = "SELECT name, id AS id_contrat FROM employment_type";
        $stmtContrat = $pdo->prepare($queryContrat);
        $stmtContrat->execute();
        return $stmtContrat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getCodePostal()
    {
        return $this->code_postal;
    }

    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    public function getCvPdf()
    {
        return $this->cv_pdf;
    }

    public function setCvPdf($cv_pdf)
    {
        $this->cv_pdf = $cv_pdf;
    }

    public function getQualification()
    {
        return $this->qualification;
    }

    public function setQualification($qualification)
    {
        $this->qualification = $qualification;
    }

    public function getPreference()
    {
        return $this->preference;
    }

    public function setPreference($preference)
    {
        $this->preference = $preference;
    }

    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}
