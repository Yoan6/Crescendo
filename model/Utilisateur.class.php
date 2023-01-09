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
        $query = "INSERT INTO Utilisateur(email, pseudo, mot_de_passe, nom, prenom, date_naissance, ville, rue, code_postal, img_profil)
                        Values(:email, :pseudo, :mot_de_passe, :nom, :prenom, :date_naissance, :ville, :rue, :code_postal, :img_profil)";


        $dao = DAO::get();
        $dao->exec($query,$this->getData());
        
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
        if(count($table) != 1) {throw new Exception("l'utilisateur n'existe pas");}

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
