<?php

class User
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
    private $pdo;

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

    public function findOne($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $pdostmt = $this->pdo->prepare($query);
        $pdostmt->execute(['email' => $email]);
        return $pdostmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM users order by id DESC;";
        $pdostmt = $this->pdo->prepare($sql);
        $pdostmt->execute();
        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUsers($companyId = null) // rendre le param optionnel 
    {
        $query = '
                INSERT INTO users (nom, prenom, email, password, role, telephone, ville, code_postal, cv_pdf, qualification, preference, disponibilite, photo, company_id)
                VALUES (:nom, :prenom, :email, :password, :role, :telephone, :ville, :code_postal, :cv_pdf, :qualification, :preference, :disponibilite, :photo, :company_id)
                    ';
        $stmt = $this->pdo->prepare($query);

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
            ":photo" => $this->photo,
            ":company_id" => $companyId
        ]);

        return $stmt->rowCount() > 0;
    }

    public function readProfil($id)
    {
        $query = '
        SELECT *
        FROM users
        WHERE id = :id
        ';

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        if (!empty($id)) {
            $query = "SELECT * FROM users WHERE id = :id";
            $pdostmt = $this->pdo->prepare($query);
            $pdostmt->execute(["id" => $id]);
            return $pdostmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getUserByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByCompanyId(int $companyId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE company_id = ?");
        $stmt->execute([$companyId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserInDB($data)
    {
        $query = "
                UPDATE users SET
                    nom = :nom,
                    prenom = :prenom,
                    telephone = :telephone,
                    ville = :ville,
                    code_postal = :code_postal,
                    disponibilite = :disponibilite
                WHERE id = :id
                ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'nom' => $data['inputNom'],
            'prenom' => $data['inputPrenom'],
            'telephone' => $data['inputTel'],
            'ville' => $data['inputCity'],
            'code_postal' => $data['inputZipcode'],
            'disponibilite' => $data['inputDispo'],
            'id' => $data['id'],
        ]);

        if ($stmt->rowCount() === 0) {
            error_log("⚠️ Aucun utilisateur mis à jour. ID=" . $data['id']);
        }
    }

    public function updateUserInDbById($data, $id)
    {
        $query = "
                UPDATE users SET
                    nom = :nom,
                    prenom = :prenom,
                    telephone = :telephone,
                    ville = :ville,
                    code_postal = :code_postal
                WHERE id = :id
                ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'nom' => $data['inputNom'],
            'prenom' => $data['inputPrenom'],
            'telephone' => $data['inputTel'],
            'ville' => $data['inputCity'],
            'code_postal' => $data['inputZipcode'],
            'id' => $id,
        ]);

        if ($stmt->rowCount() === 0) {
            error_log("⚠️ Aucun utilisateur mis à jour. ID=" . $id);
        }
    }

    public function chooseContrat()
    {

        // Récupérer la liste des types de contrat
        $queryContrat = "SELECT name, id AS id_contrat FROM employment_type";
        $stmtContrat = $this->pdo->prepare($queryContrat);
        $stmtContrat->execute();
        return $stmtContrat->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function updatePassword($data, $id)
    {
        // On hash le mot de passe avant de l'enregistrer
        $hashedPassword = password_hash($data['inputPassword'], PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'password' => $hashedPassword,
            'id' => $id,
        ]);
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
        if ($cv_pdf) {
            $this->cv_pdf = $cv_pdf;
        } else {
            return null;
        }
    }

    public function getQualification()
    {
        return $this->qualification;
    }

    public function setQualification($qualification)
    {
        if ($qualification) {
            $this->qualification = $qualification;
        } else {
            return null;
        }
    }

    public function getPreference()
    {
        return $this->preference;
    }

    public function setPreference($preference)
    {
        if ($preference) {
            $this->preference = $preference;
        } else {
            return null;
        }
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
