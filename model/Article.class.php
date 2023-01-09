<?php

require_once(__DIR__ . '/../model/DAO.class.php');
require_once(__DIR__ . '/../model/Enchere.class.php');

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
    //private DateTime $date;
    private string $lieu;
    private string $style;





    public function __construct(string $titre,string $description, string $urlImage, int $prixMin, string $artiste, 
                                    string $etat="", string $categorie ="", string $taille="", string $lieu="", string $style="")
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
        $this->setNumArticle(-1);

        $enchere = new Enchere([$this]);
        $this->ajouterEnchere($enchere);
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

    public function getEncheres() : array
    {
        return $this->encheres;
    }
    public function ajouterEnchere(Enchere $enchere){
        array_push($this->encheres,$enchere);
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
            //$this->getDate(),
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
                                        etat, categorie, taille, lieu, style)
                            VALUES(:titre, :img_url, :prix_min, :description_article, :artiste, 
                                        :etat, :categorie, :taille, :lieu, :style)";

            $dao = DAO::get();
            $dao->exec($query, $this->getData());

            // Récupérer le bon num_article
        $dernierNum = $dao->query("SELECT max(num_article) FROM ARTICLE;", array())[0]['max(num_article)'];
        $this->setNumArticle($dernierNum);
    }

    /////////////////////////// READ /////////////////////////////////////
    public static function read(string $titre, string $description): Article
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE titre = ? AND description_article = ? ;";

        $dao = DAO::get();
        $table = $dao->query($query,[$titre, $description]);
        return Article::obtenirArticleAPartirTable($table);
    }

    public static function readNum(int $num_article): Article
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE num_article = ? ;";

        $dao = DAO::get();
        $table = $dao->query($query,[$num_article]);
        return Article::obtenirArticleAPartirTable($table);
    }

    private static function obtenirArticleAPartirTable($table) : Article
    {
        if(count($table) == 0) {throw new Exception("l'article n'existe pas");} 
        
        $ligne = $table[0];
        $article = new Article($ligne['titre'], $ligne['description_article'], $ligne['img_url'], $ligne['prix_min'], $ligne['artiste'], 
                            $ligne['etat'], $ligne['categorie'], $ligne['taille'], $ligne['lieu'], $ligne['style']);
        $article->setNumArticle($ligne['num_article']);
        return $article;
    } 

    public static function readLike(string $titrePattern): array {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE titre like concat('%',?,'%');";

        $dao = DAO::get();
        return $dao->query($query,[$titrePattern]);
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
        $query = "DELETE FROM ARTICLE WHERE titre = ? AND description_article = ?;";
        
        $dao = DAO::get();
        $dao->exec($query,[$this->getTitre(),$this->getDescription()]);
    }

    function egalArticle(Article $autreArticle) : bool
    {
        return $this->getTitre() == $autreArticle->getTitre() && $this->getDescription() == $autreArticle->getDescription();
    }

}
?>