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
    //private time $dateDeNaissance;
    private string $ville;
    private string $rue;
    private string $codePostal;

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
    

    private function getData() : array {
        return array(
             $this->getEmail(),
             $this->getPseudo(),
             $this->getMotDePasse(),
             $this->getNom(),
             $this->getPrenom(),
             "",//$this->getDate_naissance(),
             $this->getVille(),
             $this->getRue(),
             $this->getCodepostal()
        );
    }

    /******************** 
     * CRUD
     *********************/
    




    /////////////////////////// CREATE /////////////////////////////////////
    public function create()
    {
        $dao = DAO::get();
        $querry = "INSERT INTO Utilisateur(email,pseudo,mot_de_passe,nom,prenom,date_naissance,ville,rue,code_postal)
                        Values(?,?,?,?,?,?,?,?,?)";
        $dao->exec($querry,$this->getData());
        
    }

    /////////////////////////// READ /////////////////////////////////////
    public static function read(string $emailOuPseudo, string $motDePasse): Utilisateur
    {
        //TODO
        $dao = DAO::get();
        $querry = "SELECT *
                    FROM Utilisateur
                    WHERE (email =:emailOuPseudo OR pseudo=:emailOuPseudo) AND mot_de_passe=:motDePasse;";
        $data = [':emailOuPseudo' => $emailOuPseudo,
                   ':motDePasse'=> $motDePasse];
        $table = $dao->query($querry,$data);
        if(count($table) != 1) {
            throw new Exception("l'utilisateur n'existe pas");
        }
        $ligne = $table[0];
        
        return new Utilisateur($ligne['email'], $ligne['pseudo'], $ligne['mot_de_passe'], $ligne['nom'], $ligne['prenom'], $ligne['ville'], $ligne['rue'], $ligne['code_postal']);
    }

    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        //TODO
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        //TODO
        $dao = DAO::get();
        $query = "DELETE FROM Utilisateur WHERE email = ?;";
        $data = [$this->getEmail()];
        $dao->exec($query,$data);
    }

    function egalUtilisateur(Utilisateur $autreUtilisateur) : bool
    
    {
        return $this->getEmail() == $autreUtilisateur->getEmail() && $this->getMotDePasse() == $autreUtilisateur->getMotDePasse() && $this->getPseudo() == $autreUtilisateur->getPseudo();
    }



}
