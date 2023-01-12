<?php

use Utilisateur as GlobalUtilisateur;

require_once(__DIR__ . '/../model/DAO.class.php');

class Utilisateur
{
    private string $email;
    private string $pseudo;
    private string $motDePasse;
    private string $nom;
    private string $prenom;
    //private DateTime $dateDeNaissance;
    private string $ville;
    private string $rue;
    private string $codePostal;

    private string $imgProfil;
    //private array $notes;

    public function __construct(string $email, string $pseudo, string $motDePasse, string $nom, string $prenom, string $ville, string $rue, string $codePostal)
    {
        $this->setEmail($email);
        $this->setPseudo($pseudo);
        $this->setMotDePasse($motDePasse);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setVille($ville);
        $this->setRue($rue);
        $this->setCodePostal($codePostal);
        
        // Autres initialisations
        //$this->setDate
        $this->setImgProfil("");

    }

    










    /******************** 
     * Getter and Setter
     *********************/

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
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

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getRue()
    {
        return $this->rue;
    }

    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
    
    public function getImgProfil()
    {
        return $this->imgProfil;
    }

    public function setImgProfil($imgProfil)
    {
        $this->imgProfil = $imgProfil;
    }

    /**
     * Récupère toutes les valeurs nécessaires pour un CREATE ou UPDATE
     * @return array
     */
    private function getData() : array {
        return array(
             "email" => $this->getEmail(),
             "pseudo" => $this->getPseudo(),
             "mot_de_passe" => $this->getMotDePasse(),
             "nom" => $this->getNom(),
             "prenom" => $this->getPrenom(),
             //"date_naissance" => $this->getDate_naissance(),
             "ville" => $this->getVille(),
             "rue" => $this->getRue(),
             "code_postal" => $this->getCodepostal(),
             "img_profil" => $this->getImgProfil()
        ); //Note ajouter + de valeur qu'il en faut résulte en l'erreur : SQLSTATE[HY000]: General error: 25 column index out of range
    }

    /******************** 
     * CRUD
     *********************/
    




    /////////////////////////// CREATE /////////////////////////////////////
    public function create()
    {
        $reqmail = "SELECT * FROM Utilisateur WHERE email = :email OR pseudo=:pseudo";
        $dao = DAO::get();
        $table->query($reqmail,$this->getData());
        // On compte le nombre de ligne en commun entre les adresses mail et les pseudo 
        // S'il n'y a pas 0 ligne c'est qu'il y a déjà une adresse mail/pseudo
        if (count($table) == 0) {
            // On peut créer l'utilisateur
            $query = "INSERT INTO Utilisateur(email, pseudo, mot_de_passe, nom, prenom, date_naissance, ville, rue, code_postal, img_profil)
                        Values(:email, :pseudo, :mot_de_passe, :nom, :prenom, :date_naissance, :ville, :rue, :code_postal, :img_profil)";
            $dao = DAO::get();
            $dao->exec($query,$this->getData());
        }  
        else {
            throw new Exception("L'adresse mail ou le pseudo existe déjà");
        }  
    }

    /////////////////////////// READ /////////////////////////////////////
    public static function read(string $emailOuPseudo): Utilisateur
    {
        $query = "SELECT *
                    FROM Utilisateur
                    WHERE (email =:emailOuPseudo OR pseudo=:emailOuPseudo)";
        $data = [
                ':emailOuPseudo' => $emailOuPseudo,
                ];

        $dao = DAO::get();
        $table = $dao->query($query,$data);

        

        if(count($table) != 1) {
            throw new Exception("L'utilisateur n'existe pas");
        }
        else {
            if(password_verify($motDePasse, $table['motDePasse'])) {
                echo "Connexion réussie !";
            }
            else {
                echo "Identifiants invalides";
            }
        }

        

        $ligne = $table[0];
        return new Utilisateur($ligne['email'], $ligne['pseudo'], $ligne['mot_de_passe'], $ligne['nom'], $ligne['prenom'], $ligne['ville'], $ligne['rue'], $ligne['code_postal']);
    }

    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        $query = "UPDATE Utilisateur
            set (email, pseudo, mot_de_passe, nom, prenom, date_naissance, ville, rue, code_postal, img_profil) 
                = (:email, :pseudo, :mot_de_passe, :nom, :prenom, :date_naissance, :ville, :rue, :code_postal, :img_profil)
            WHERE email = :email";

        $dao = DAO::get();
        $dao->exec($query,$this->getData());
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        $query = "DELETE FROM Utilisateur WHERE email = ?;";
        $data = [$this->getEmail()];

        $dao = DAO::get();
        $dao->exec($query,$data);
    }

    function egalUtilisateur(Utilisateur $autreUtilisateur) : bool
    
    {
        return $this->getEmail() == $autreUtilisateur->getEmail() && $this->getMotDePasse() == $autreUtilisateur->getMotDePasse() && $this->getPseudo() == $autreUtilisateur->getPseudo();
    }



}
