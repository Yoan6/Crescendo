<?php

require_once(__DIR__ . '/../model/DAO.class.php');
require_once(__DIR__ . '/../model/Enchere.class.php');
require_once(__DIR__ . '/../model/Utilisateur.class.php');

class Article
{
    private int $numArticle;
    private string $titre;
    private string $description;
    private string $urlImage;
    private string $artiste;
    private int $prixMin;

    private array $encheres = array();


    private string $etat;
    private string $categorie;
    private string $taille;
    private DateTime $dateEvenement;
    private string $lieu;
    private string $style;

    private Utilisateur $vendeur;



    public function __construct(Utilisateur $vendeur, string $titre,string $description, string $urlImage, int $prixMin, string $artiste, 
                                    string $etat="", string $categorie ="", string $taille="", string $lieu="", string $style="", DateTime $dateEvenement = new DateTime())
    {
        // Initialisation obligatoire
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setUrlImage($urlImage);
        $this->setPrixMin($prixMin);
        $this->setArtiste($artiste);

        // Autres initialisations par défaut
        $this->setEtat($etat);
        $this->setCategorie($categorie);
        $this->setTaille($taille);
        $this->setLieu($lieu);
        $this->setStyle($style);
        $this->setDateEvenement($dateEvenement);
        $this->setNumArticle(-1);

        $enchere = new Enchere([$this]);
        $this->ajouterEnchere($enchere);
        $this->setVendeur($vendeur);
    }


    /******************** 
     * Getter and Setter
     *********************/


    public function getNumArticle()
    {
        return $this->numArticle;
    }

    private function setNumArticle($numArticle)
    {
        $this->numArticle = $numArticle;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getUrlImage()
    {
        return $this->urlImage;
    }

    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;
    }

    public function getArtiste()
    {
        return $this->artiste;
    }

    public function setArtiste($artiste)
    {
        $this->artiste = $artiste;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getTaille()
    {
        return $this->taille;
    }

    public function setTaille($taille)
    {
        $this->taille = $taille;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function getPrixMin()
    {
        return $this->prixMin;
    }

    public function setPrixMin($prixMin)
    {
        $this->prixMin = $prixMin;
    }


    public function getDateEvenement() : string
    {
        return $this->dateEvenement->format('d/m/y');
    }

    private function setDateEvenement(dateTime $dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;
    }





    public function getEncheres() : array
    {
        return $this->encheres;
    }


    public function ajouterEnchere(Enchere $enchere){
        array_push($this->encheres,$enchere);
    }
    
    public function getVendeur() : Utilisateur
    {
        return $this->vendeur;
    }

    public function setVendeur(Utilisateur $vendeur)
    {
        $this->vendeur = $vendeur;
    }






    /**
     * Récupère toutes les valeurs nécessaires pour un CREATE ou UPDATE
     * @return array
     */
    private function getData() : array {
        return array(
            'titre' => $this->getTitre(),
            'description_article' => $this->getDescription(),
            'img_url' => $this->getUrlImage(),
            'prix_min' => $this->getPrixMin(),
            'artiste' => $this->getArtiste(),
            'date_evenement' => $this->getDateEvenement(),
            'etat' => $this->getEtat(),
            'categorie' => $this->getCategorie(),
            'taille' => $this->getTaille(),
            'lieu' => $this->getLieu(),
            'style' => $this->getStyle(),
        ); //Note : ajouter + de valeur qu'il en faut résulte en l'erreur : SQLSTATE[HY000]: General error: 25 column index out of range
    }


    /******************** 
     * CRUD
     *********************/


    /////////////////////////// CREATE /////////////////////////////////////
    /*
    * Création d'un article
    * Note : Un article ne peut avoir le même titre et description
    */
    public function create()
    {
        $query = "INSERT INTO ARTICLE(titre, img_url, prix_min, description_article, artiste, 
                                    etat, categorie, taille, lieu, style, date_evenement)
                        VALUES(:titre, :img_url, :prix_min, :description_article, :artiste, 
                                    :etat, :categorie, :taille, :lieu, :style, :date_evenement)";

        $dao = DAO::get();
        $dao->exec($query, $this->getData());

        // Récupérer le bon num_article
        $dernierNum = $dao->query("SELECT max(num_article) FROM ARTICLE;", array())[0]['max(num_article)'];
        $this->setNumArticle($dernierNum);

        // Lier l'utilisateur à l'article
        $queryVend = "INSERT INTO VEND(num_utilisateur,num_article)
                                VALUES(:num_utilisateur,:num_article)";
        $dao->exec($queryVend,[$this->getVendeur()->getNumUtilisateur(),$this->getNumArticle()]);
    }



    /////////////////////////// READ /////////////////////////////////////
    public static function read(string $titre, string $description): Article
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE titre = ? AND description_article = ? ;";

        $dao = DAO::get();
        $table = $dao->query($query,[$titre, $description]);
        return Article::obtenirArticlesAPartirTable($table)[0];
    }

    public static function readNum(int $num_article): Article
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE num_article = ? ;";

        $dao = DAO::get();
        $table = $dao->query($query,[$num_article]);
        return Article::obtenirArticlesAPartirTable($table)[0];
    }

    /**
     * @return array retourne un tableau d'objet Article
     */
    public static function readLike(string $titrePattern): array {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE titre like concat('%',?,'%');";

        $dao = DAO::get();
        $table = $dao->query($query,[$titrePattern]);
        return obtenirArticlesAPartirTable($table);
    }


        /**
     * Retourne un tableau d'article à partir de la table
     * @return array 
     */
    private static function obtenirArticlesAPartirTable($table) : array
    {
        if(count($table) == 0) {throw new Exception("l'article n'existe pas");} 
        $dao = DAO::get();
        $query = "SELECT num_utilisateur FROM VEND WHERE num_article = ?";
        
        $lesArticles = array();
        foreach($table as $ligne) {
            // Récupérer le numéro d'utilisateur du Vendeur à partir de la table VEND
            $numUtilisateur = $dao->query($query,[$ligne['num_article']])[0]['num_utilisateur'];

            // Obtenir l'article sous forme d'objet 
            $article = new Article(Utilisateur::readNum($numUtilisateur),$ligne['titre'], $ligne['description_article'], $ligne['img_url'], $ligne['prix_min'], $ligne['artiste'], 
                                $ligne['etat'], $ligne['categorie'], $ligne['taille'], $ligne['lieu'], $ligne['style']);
            $article->setNumArticle($ligne['num_article']);
            array_push($lesArticles,$article);
        }
        return $lesArticles;
    } 

    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        $query = "UPDATE ARTICLE
            set (titre, img_url, prix_min, description_article, artiste, 
                    etat, categorie, taille, date_evenement, lieu, style)
              = (:titre, :img_url, :prix_min, :description_article, :artiste, 
                    :etat, :categorie, :taille, :date_evenement, :lieu, :style)
            WHERE num_article = :num_article;";

        $dao = DAO::get();
        $dao->exec($query,$this->getData());
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        $query = "DELETE FROM ARTICLE WHERE titre = ? AND description_article = ?;"; // Des triggers feront des DELETE dans les autres tables
        
        $dao = DAO::get();
        $dao->exec($query,[$this->getTitre(),$this->getDescription()]);
    }

    function egalArticle(Article $autreArticle) : bool
    {
        return $this->getTitre() == $autreArticle->getTitre() && $this->getDescription() == $autreArticle->getDescription();
    }

}
?>