<?php

require_once(__DIR__ . '/../model/DAO.class.php');
require_once(__DIR__ . '/../model/Enchere.class.php');
require_once(__DIR__ . '/../model/Utilisateur.class.php');

class Article
{
    private int $numArticle;
    private string $titre;
    private string $description;
    private array $nomImages;
    private string $artiste;
    private int $prixMin;


    private string $etat;
    private string $categorie;
    private string $taille;
    private DateTime $dateEvenement;
    private string $lieu;
    private string $style;

    private Utilisateur $vendeur;
    private const LOCALURL = "../data/imgArticle/";

    // WhiteList pour éviter une injection SQL
    private const WHITELIST_NOM_ATTRIBUT = ["num_article"=>"num_article", "num_vendeu" => "num_vendeu","titre"=>"titre","prix_min"=>"prix_min","description_article"=>"description_article","artiste"=>"artiste","etat"=>"etat","categorie"=>"categorie","taille"=>"taille","date_evenement"=>"date_evenement","lieu"=>"lieu","style"=>"style"];
    private const WHITELIST_ORDER_BY = ["Asc" => "ASC", "DESC" => "DESC"];

    public function __construct(
        Utilisateur $vendeur, string $titre, string $description, array $nomImgages, int $prixMin, string $artiste,
        string $etat = "", string $categorie = "", string $taille = "", string $lieu = "", string $style = "",
        DateTime $dateEvenement = null // Il faut php8 pour initialiser par défaut les Objets dans les paramètres 
    )
    {
        // Initialisation obligatoire
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->ajouterNomsImg($nomImgages);
        $this->setPrixMin($prixMin);
        $this->setArtiste($artiste);

        // Autres initialisations par défaut
        $this->setEtat($etat);
        $this->setCategorie($categorie);
        $this->setTaille($taille);
        $this->setLieu($lieu);
        $this->setStyle($style);
        $this->setDateEvenement($dateEvenement ?? new DateTime()); // Support fonctionnel avant php8
        $this->setNumArticle(-1);
        $this->setVendeur($vendeur);
    }


    /******************** 
     * Getter and Setter
     *********************/

    /**
     * Pour récupèrer le type article quand on utilise une array
     * @param array $articles
     * @param int $num_dans_array
     * @return Article
     */
    public static function getTypeArticleFromArray(array $articles, int $num_dans_array): Article
    {
        return $articles[$num_dans_array];
    }


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

    /**
     * Retourne les images avec le chemin vers le répertoire de stockage des images
     */
    public function getImagesURL(): array
    {
        $imagesURL = array();
        foreach ($this->nomImages as $nomImage) {
            array_push($imagesURL, self::LOCALURL . $nomImage);
        }
        return $imagesURL;
    }

    /**
     * 
     */
    public function getImages(): array
    {
        return $this->nomImages;
    }

    public function ajouterNomsImg(array $nomImages)
    {
        $this->nomImages = $nomImages;
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


    public function getDateEvenement(): string
    {
        return $this->dateEvenement->format('Y-m-d'); // Format ISO pour la base de données
    }

    private function setDateEvenement(dateTime $dateEvenement)
    {
        $this->dateEvenement = $dateEvenement;
    }






    public function getVendeur(): Utilisateur
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
    private function getData(): array
    {
        return array(
            'titre' => $this->getTitre(),
            'description_article' => $this->getDescription(),

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
        $query = "INSERT INTO ARTICLE(titre, prix_min, description_article, artiste, 
                                    etat, categorie, taille, lieu, style, date_evenement, num_vendeur)
                        VALUES(:titre, :prix_min, :description_article, :artiste, 
                                    :etat, :categorie, :taille, :lieu, :style, :date_evenement, :num_vendeur)";

        $dao = DAO::get();
        $dao->exec($query, array_merge($this->getData(), ["num_vendeur" => $this->getVendeur()->getNumUtilisateur()]));

        // Récupérer le bon num_article
        $dernierNum = $dao->query("SELECT max(num_article) FROM ARTICLE;", array())[0][0];
        $this->setNumArticle($dernierNum);

        // Insérer l'image
        $queryImage = "INSERT INTO IMAGE_ARTICLE(num_article,nom_image) values (:num_article,:nom_image);";
        $data = [
            'num_article' => $this->getNumArticle(),
            'nom_image' => ""
        ];
        foreach ($this->getImages() as $image) {
            $data['nom_image'] = $image;
            $dao->exec($queryImage, $data);
        }
    }



    /////////////////////////// READ /////////////////////////////////////
    /**
     * 
     * Récupérer un article à partir de sa description et de son titre
     * @param string $titre
     * @param string $description
     * @return Article
     */
    public static function read(string $titre, string $description): Article
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE titre = ? AND description_article = ? ;";

        $dao = DAO::get();
        $table = $dao->query($query, [$titre, $description]);
        return Article::obtenirArticlesAPartirTable($table)[0];
    }

    /**
     * 
     * Récupérer un article à partir de son numéro
     * @param int $num_article
     * @return Article
     */
    public static function readNum(int $num_article): Article
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE num_article = ? ;";

        $dao = DAO::get();
        $table = $dao->query($query, [$num_article]);
        return Article::obtenirArticlesAPartirTable($table)[0];
    }

    /**
     * Cherche des articles, s'ils contiennent le pattern
     * @param string $titrePattern
     * @return array retourne un tableau d'objet Article
     */
    public static function readLike(string $titrePattern): array
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE titre like '%' ||? ||'%';";

        $dao = DAO::get();
        $table = $dao->query($query, [$titrePattern]);
        return Article::obtenirArticlesAPartirTable($table);
    }

    public static function readCategorie(string $categorieName): array
    {
        $query = "SELECT *
                    FROM ARTICLE
                    WHERE categorie like '%' ||?||'%';";

        $dao = DAO::get();
        $table = $dao->query($query, [$categorieName]);
        return Article::obtenirArticlesAPartirTable($table);
    }

    /////////////////////////// ReadPage /////////////////////////////////////


    public static function readPageLike(string $page,int $pageSize, string $titreArtistePattern): array
    {
        $query = "SELECT *
                    FROM ARTICLE natural join CONCERNE
                    WHERE titre like '%' ||:titreArtiste ||'%'
                        OR artiste like '%' ||:titreArtiste ||'%'
                    ORDER BY num_article
                    LIMIT :pageSize OFFSET :articleOffset ;";

        $data = [
            "titreArtiste" => $titreArtistePattern,
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize
        ];

        
        $dao = DAO::get();
        $table = $dao->query($query,$data);

        return Article::obtenirArticlesAPartirTable($table);
    }

    public static function readPageChoix(int $page,int $pageSize, string $choix, string $valeurChoix, string $orderByChoix ="num_article",string $orderBy="Asc"){
        
        
        
        /*Certaines variables mises directement pour éviter les '', j'utilise une whiteListe donc normalement il n y a pas d'injection sql possible*/        
        $query = "SELECT *
                    FROM ARTICLE natural join CONCERNE
                    WHERE ". self::WHITELIST_NOM_ATTRIBUT[$choix] ." like '%' ||:valeurChoix||'%' 
                    ORDER BY ". self::WHITELIST_NOM_ATTRIBUT[$orderByChoix] ." " . self::WHITELIST_ORDER_BY[$orderBy] ."                   
                    LIMIT :pageSize OFFSET :articleOffset ;";

        $data = [
            "valeurChoix" => $valeurChoix,
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize
        ];

        $dao = DAO::get();
$table = $dao->query($query, $data);
        return Article::obtenirArticlesAPartirTable($table);
    }


    
    
    public static function readPage(int $page, int $pageSize)
    {
        /*Certaines variables mises directement pour éviter les '', l'utilisateur ne peut normalement pas manipuler ces données*/      
        $query = "SELECT *
                    FROM ARTICLE natural join CONCERNE
                    ORDER BY num_article               
                    LIMIT :pageSize OFFSET :articleOffset ;";
                    
                    $data = [
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize
        ];
        $dao = DAO::get();
        try {
            $table = $dao->query($query, $data);
            return Article::obtenirArticlesAPartirTable($table);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des articles");
        }
    }
    
    public static function nombreArticlesParChoix(string $choix, string $valeurChoix){
        /*L'attribut mis directement pour éviter les '', j'utilise une whiteListe donc normalement il n y a pas d'injection sql possible*/ 
        $query = "SELECT COUNT(*)
                    FROM ARTICLE natural join CONCERNE
                    WHERE ". self::WHITELIST_NOM_ATTRIBUT[$choix] ." like '%' ||?||'%';";
        $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, [$valeurChoix]);
        return $tableContenantLeNombre[0][0];
    }

    public static function nombreArticlesLike(string $titreArtiste){
        $query = "SELECT COUNT(*)
                    FROM ARTICLE natural join CONCERNE
                    WHERE titre like '%' ||:titreArtiste ||'%'
                        OR artiste like '%' ||:titreArtiste ||'%'";
        $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, ["titreArtiste" =>$titreArtiste]);
        return $tableContenantLeNombre[0][0];
    }


    public static function nombreArticlesTotal(){
        $query = "SELECT COUNT(*)
                    FROM ARTICLE  natural join CONCERNE";
                    $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, array());
        return $tableContenantLeNombre[0][0];
    }
    
    /**
     * Retourne un tableau d'article à partir de la table
     * @return array 
     */
    private static function obtenirArticlesAPartirTable($table): array
    {
        if (count($table) == 0) {
            throw new Exception("l'article n'existe pas");
        }
        $dao = DAO::get();

        $lesArticles = array();
        foreach ($table as $ligne) {

            // Obtenir l'article sous forme d'objet 
            $article = new Article(
                Utilisateur::readNum($ligne['num_vendeur']), $ligne['titre'], $ligne['description_article'],
                array(), $ligne['prix_min'], $ligne['artiste'],
                $ligne['etat'], $ligne['categorie'], $ligne['taille'], $ligne['lieu'], $ligne['style']
            );
            $article->setNumArticle($ligne['num_article']);
            $article->ajouterNomsImg(Article::obtenirImagesAPartirTable($ligne['num_article']));
            array_push($lesArticles, $article);
        }
        return $lesArticles;
    }


    /**
     * Récupérer les images des articles
     */
    private static function obtenirImagesAPartirTable(string $num_article): array
    {
        $dao = DAO::get();
        $query = "SELECT nom_image from IMAGE_ARTICLE WHERE num_article = ?;";
        $table = $dao->query($query, [$num_article]);

        $lesImages = array();
        foreach ($table as $ligne) {
            array_push($lesImages, $ligne['nom_image']);
        }
        return $lesImages;
    }

    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        $query = "UPDATE ARTICLE
            set (titre, prix_min, description_article, artiste, 
                    etat, categorie, taille, date_evenement, lieu, style)
              = (:titre, :prix_min, :description_article, :artiste, 
                    :etat, :categorie, :taille, :date_evenement, :lieu, :style)
            WHERE num_article = :num_article;";

        $dao = DAO::get();
        $dao->exec($query, array_merge($this->getData(), ["num_article" => $this->getNumArticle()]));
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        $query = "DELETE FROM ARTICLE WHERE titre = ? AND description_article = ?;"; // Des triggers feront des DELETE dans les autres tables

        $dao = DAO::get();
        $dao->exec($query, [$this->getTitre(), $this->getDescription()]);
    }

    function egalArticle(Article $autreArticle): bool
    {
        return $this->getTitre() == $autreArticle->getTitre() && $this->getDescription() == $autreArticle->getDescription();
    }

}
?>