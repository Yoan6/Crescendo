<?php

use Utilisateur as GlobalUtilisateur;

require_once(__DIR__ . '/../model/DAO.class.php');

class Utilisateur
{
    private int $numUtilisateur;
    private string $email;
    private string $pseudo;
    private string $motDePasse;
    private string $nom;
    private string $prenom;
    private DateTime $dateDeNaissance;
    private string $ville;
    private string $rue;
    private string $codePostal;

    private string $imgProfil;
    //private DateTime $dateCreation;
    //private array $notes;

    public function __construct(string $email, string $pseudo, string $motDePasse, string $nom, string $prenom, string $ville, string $rue, string $codePostal,DateTime $dateDeNaissance)
    {
        $this->setEmail($email);
        $this->setPseudo($pseudo);
        $this->setMotDePasse($motDePasse);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setVille($ville);
        $this->setRue($rue);
        $this->setCodePostal($codePostal);
        $this->setDateDeNaissance($dateDeNaissance);
        //$this->setDateCreation($dateCreation);

        // Autres initialisations
        $this->setImgProfil("");
        $this->setNumUtilisateur(-1);
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

    public function getNom() : string 
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom() : string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getVille() : string
    {
        return $this->ville;
    }

    public function setVille(string $ville)
    {
        $this->ville = $ville;
    }

    public function getRue() : string
    {
        return $this->rue;
    }

    public function setRue(string $rue)
    {
        $this->rue = $rue;
    }

    public function getCodePostal() : string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal)
    {
        $this->codePostal = $codePostal;
    }

    public function getPseudo() : string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }
    
    public function getImgProfil() : string
    {
        return $this->imgProfil;
    }

    public function setImgProfil(string $imgProfil)
    {
        $this->imgProfil = $imgProfil;
    }

    public function getNumUtilisateur() : int
    {
        return $this->numUtilisateur;
    }

    private function setNumUtilisateur(int $numUtilisateur)
    {
        $this->numUtilisateur = $numUtilisateur;
    }

    public function getDateDeNaissance() : string
    {
        return $this->dateDeNaissance->format('Y-m-d'); // Format ISO pour la base de données
    }

    private function setDateDeNaissance(dateTime $dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /*
    public function getDateCreation() : string {
        return $this->dateCreation->format('y-m-d');
    }

    public function setDateCreation(dateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
    }
    */


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
             "date_naissance" => $this->getDateDeNaissance(),
             "ville" => $this->getVille(),
             "rue" => $this->getRue(),
             "code_postal" => $this->getCodepostal(),
             "img_profil" => $this->getImgProfil()
             //"dateCreation" => $this->getDateCreation()
        ); //Note ajouter + de valeur qu'il en faut résulte en l'erreur : SQLSTATE[HY000]: General error: 25 column index out of range
    }

    /******************** 
     * CRUD
     *********************/
    




    /////////////////////////// CREATE /////////////////////////////////////
    /**
     * Fonction pour créer l'utilisateur en base de donnée
     * Un doublon d'email n'est pas accepté
     */
    public function create()
    {
        try {
            $query = "INSERT INTO Utilisateur(email, pseudo, mot_de_passe, nom, prenom, date_naissance, ville, rue, code_postal, img_profil)
                        Values(:email, :pseudo, :mot_de_passe, :nom, :prenom, :date_naissance, :ville, :rue, :code_postal, :img_profil)";


            $dao = DAO::get();
            $dao->exec($query, $this->getData());

            // Récupérer le bon num_utilisateur
            $dernierNum = $dao->query("SELECT max(num_utilisateur) FROM UTILISATEUR;", array())[0][0];
            $this->setNumUtilisateur($dernierNum);
        }
        catch (Exception $e) {
            throw new Exception("L'adresse mail ou le pseudo existe déjà");
        }  
    }

    /////////////////////////// READ /////////////////////////////////////
    public static function read(string $emailOuPseudo, string $motDePasse): Utilisateur
    {
        $query = "SELECT *
                    FROM Utilisateur
                    WHERE (email =:emailOuPseudo OR pseudo=:emailOuPseudo) AND mot_de_passe=:motDePasse;";
        $data = [
                ':emailOuPseudo' => $emailOuPseudo,
                ':motDePasse'=> $motDePasse
                ];

        $dao = DAO::get();
        $table = $dao->query($query,$data);
        return Utilisateur::obtenirUtilisateurAPartirTable($table)[0];
    }

    public static function readNum(int $num_utilisateur): Utilisateur
    {
        $query = "SELECT *
                    FROM Utilisateur
                    WHERE num_utilisateur = :num_utilisateur";

        $dao = DAO::get();
        $table = $dao->query($query,[$num_utilisateur]);
        return Utilisateur::obtenirUtilisateurAPartirTable($table)[0];
    }

    public static function readHash(string $emailOuPseudo): Utilisateur
    {
        $query = "SELECT *
                    FROM Utilisateur
                    WHERE (email =:emailOuPseudo OR pseudo=:emailOuPseudo);";
        $data = [
                ':emailOuPseudo' => $emailOuPseudo
                ];

        $dao = DAO::get();
        $table = $dao->query($query,$data);
        return Utilisateur::obtenirUtilisateurAPartirTable($table)[0];
    }



    private static function obtenirUtilisateurAPartirTable($table) : array
    {
        if(count($table) == 0) {throw new Exception("L'utilisateur n'existe pas");}

        $lesUtilisateurs = array();
        foreach($table as $ligne) {
            $utilisateur = new Utilisateur($ligne['email'], $ligne['pseudo'], $ligne['mot_de_passe'], $ligne['nom'], $ligne['prenom'], 
                                            $ligne['ville'], $ligne['rue'], $ligne['code_postal'],
                                            DateTime::createFromFormat('Y-m-d',$ligne['date_naissance']) 
                                        );                                
            // Mettre le bon num d'utilisateur
            $utilisateur->setNumUtilisateur($ligne['num_utilisateur']);
            array_push($lesUtilisateurs,$utilisateur);
        }
        return $lesUtilisateurs;
    } 


    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        $query = "UPDATE Utilisateur
            set (email, pseudo, mot_de_passe, nom, prenom, date_naissance, ville, rue, code_postal, img_profil, date_creation) 
                = (:email, :pseudo, :mot_de_passe, :nom, :prenom, :date_naissance, :ville, :rue, :code_postal, :img_profil, :date_creation)
            WHERE email = :email";

        $dao = DAO::get();
        $dao->exec($query,$this->getData());
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        $query = "DELETE FROM Utilisateur WHERE num_utilisateur = ?;"; // Des triggers feront des DELETE dans les autres tables
        $data = [$this->getNumUtilisateur()];

        $dao = DAO::get();
        $dao->exec($query,$data);
    }

    function egalUtilisateur(Utilisateur $autreUtilisateur) : bool
    {
        return $this->getEmail() == $autreUtilisateur->getEmail() && $this->getMotDePasse() == $autreUtilisateur->getMotDePasse() && $this->getPseudo() == $autreUtilisateur->getPseudo();
    }

    /******************** 
     * Autres méthodes
     *********************/

}
