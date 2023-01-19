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

    public function setDateEvenement(dateTime $dateEvenement)
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
        // requête préparée
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
        // requête préparée
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
        // requête préparée
        $table = $dao->query($query, [$titrePattern]);
        return Article::obtenirArticlesAPartirTable($table);
    }


    /////////////////////////// ReadPage /////////////////////////////////////

    /**
     * Barre de recherche, recherche uniquement en fonction de l'artiste et du titre
     * @param string $page
     * @param int $pageSize
     * @param string $titreArtistePattern
     * @return array
     */
    public static function readPageLike(string $page,int $pageSize, string $titreArtistePattern): array
    {
        $query = "SELECT *
                    FROM ENCHERE_TOUT_EN_COURS_VIEW
                    WHERE titre like '%' ||:titreArtiste ||'%' COLLATE NOCASE
                        OR artiste like '%' ||:titreArtiste ||'%' COLLATE NOCASE
                    ORDER BY num_article
                    LIMIT :pageSize OFFSET :articleOffset ;";

        $data = [
            "titreArtiste" => $titreArtistePattern,
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize
        ];

        $dao = DAO::get();
        // Requêté préparée
        $table = $dao->query($query,$data);

        return Article::obtenirArticlesAPartirTable($table);
    }

    /**
     * Pour factoriser du code lorsqu'on veut uniquement chercher sans condition
     * @param string $page
     * @param int $pageSize
     * @param string $query
     * @return array
     */
    public static function readUniquementPage(string $page, int $pageSize, string $query)
    {
        $data = [
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize
        ];
        $dao = DAO::get();

        // Requêté préparée avec le DAO
        try {
            $table = $dao->query($query, $data);
            return Article::obtenirArticlesAPartirTable($table);
        } catch (Exception $e) {
            // var_dump($query);
            throw new Exception("Erreur lors de la récupération des articles");
        }
    }

    /**
     * Pour factoriser du code lorsqu'on veut avoir les articles de l'utilisateur
     * @param string $page
     * @param int $pageSize
     * @param string $query
     * @param int $numUtilisateur
     * @throws Exception
     * @return array
     */
    public static function readUniquementPageEtUtilisateur(string $page, int $pageSize, string $query, int $numUtilisateur)
    {
        $data = [
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize,
            "num_utilisateur" => $numUtilisateur
        ];
        
        $dao = DAO::get();

        // Requêté préparée avec le DAO
        try {
            $table = $dao->query($query, $data);
            return Article::obtenirArticlesAPartirTable($table);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des articles");
        }
    }



    /**
     * 
     * Pour lire les articles les plus populaire
     * @param string $page
     * @param int $pageSize
     * @return array
     */
    public static function readPageALaUne(string $page, int $pageSize): array
    {
        $query = "select *,sum(CASE est_like when TRUE then 1 WHEN false then -1 WHEN est_like is Null then 0 END) as compteurLike 
        FROM ARTICLE natural join CONCERNE natural join ENCHERE natural left join like_dislike 
        WHERE num_enchere IN (SELECT num_enchere FROM ENCHERE WHERE date_debut BETWEEN datetime(DATE(), '-6 DAYS') AND DATE())
        group by num_enchere order by CAST(compteurLike as SIGNED) DESC LIMIT :pageSize OFFSET :articleOffset ;";
        return Article::readUniquementPage($page, $pageSize, $query);
    }


    /**
     * Pour rechercher les favoris de l'utilisateur
     * @param string $page
     * @param int $pageSize
     * @param int $numUtilisateur
     * @return array
     */
    public static function readPageFavoris(string $page, int $pageSize,int $numUtilisateur): array
    {
        $query = "select *
        FROM ARTICLE natural join CONCERNE natural join ENCHERE natural left join favorise
        WHERE num_utilisateur=:num_utilisateur
        group by num_enchere order by date_debut DESC LIMIT :pageSize OFFSET :articleOffset ;";
        return Article::readUniquementPageEtUtilisateur($page, $pageSize, $query,$numUtilisateur);
    }

    /**
     * Pour obtenir toutes les enchères gagnées par l'utilisateur
     * @param string $page
     * @param int $pageSize
     * @param int $numUtilisateur
     * @return array
     */
    public static function readPageGagne(string $page, int $pageSize,int $numUtilisateur): array
    {
        $query = "select *
        FROM ARTICLE natural join CONCERNE natural join ENCHERE natural left join GAGNE_VIEW
        WHERE num_utilisateur=:num_utilisateur
        group by num_enchere order by date_debut DESC LIMIT :pageSize OFFSET :articleOffset ;";
        return Article::readUniquementPageEtUtilisateur($page, $pageSize, $query,$numUtilisateur);
    }



    /**
     * 
     * Pour lire tous les articles pour l'accueil
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public static function readPage(int $page, int $pageSize)
    {     
        $query = "select *,sum(CASE est_like when TRUE then 1 WHEN false then -1 WHEN est_like is Null then 0 END) as compteurLike 
                FROM ARTICLE natural join CONCERNE natural join ENCHERE natural left join like_dislike 
                WHERE num_enchere IN (SELECT num_enchere FROM ENCHERE WHERE date_debut BETWEEN datetime(DATE(),'-6 DAYS') AND datetime(DATE(), '-6 DAYS'))
                group by num_enchere order by CAST(compteurLike as SIGNED) DESC LIMIT :pageSize OFFSET :articleOffset ;";
        return Article::readUniquementPage($page, $pageSize, $query);
    }
    




    // WhiteList pour éviter une injection SQL sur les attributs mais en même temps pouvoir changer les attributs
    private const WHITELIST_NOM_ATTRIBUT = ["num_article"=>"num_article", "num_vendeur" => "num_vendeur","titre"=>"titre","prix_min"=>"prix_min","description_article"=>"description_article","artiste"=>"artiste","etat"=>"etat","categorie"=>"categorie","taille"=>"taille","date_evenement"=>"date_evenement","lieu"=>"lieu","style"=>"style", "1" => "1","date_debut" => "date_debut","est_lot" => "est_lot","prix_actuel" => "prix_actuel"];
    private const WHITELIST_ORDER_BY = ["ASC" => "ASC", "DESC" => "DESC"];

    /**
     * Permet la recherche avec plusieurs paramètres en une seule fonction
     * @param int $page
     * @param int $pageSize
     * @param array $choixEtvaleurs
     * @param mixed $choixObligatoire
     * @param mixed $choixObligatoireValeur
     * @param string $orderByChoix
     * @param string $orderBy
     * @return array
     */
    public static function readPagePlusieursChoix(int $page,int $pageSize, array $choixEtvaleurs, array $choixObligatoiresEtvaleurs, string $orderByChoix ="date_debut",string $orderBy="ASC"){
        // Je définis moi même la table pour éviter une injection 
        if (!isset($choixObligatoiresEtvaleurs['num_vendeur'])) {
            $ma_table_que_je_definis_et_que_l_utilisateur_ne_peut_pas_toucher = "ENCHERE_TOUT_EN_COURS_VIEW";  
        } else {
            $ma_table_que_je_definis_et_que_l_utilisateur_ne_peut_pas_toucher = "ENCHERE_TOUT_VIEW";
        }
        
        /********************* La requête *********************/
        $query = "SELECT * FROM $ma_table_que_je_definis_et_que_l_utilisateur_ne_peut_pas_toucher "
             . Article::generationDynamiqueQuery($choixEtvaleurs,$choixObligatoiresEtvaleurs)  // Génération dynamique de la requête, vulnérabilité d'injection potentielle
            . " ORDER BY ". self::WHITELIST_NOM_ATTRIBUT[$orderByChoix] ." " . self::WHITELIST_ORDER_BY[$orderBy]
            ." LIMIT :pageSize OFFSET :articleOffset ;";

        /********************* Les données *********************/
        $data = [
            "articleOffset" => ($page - 1) * $pageSize,
            "pageSize" => $pageSize,
        ];

        Article::generationDynamiqueData($data, $choixEtvaleurs, $choixObligatoiresEtvaleurs);
        
        /********************* La requête préparée pour les données entrées par l'utilisateur *********************/
        $dao = DAO::get();
        $table = $dao->query($query, $data);
        
        return Article::obtenirArticlesAPartirTable($table);
    }





    /**
     *  Génére dynamiquement la requête
     * @param string $query la requête sql
     * @param array $choixEtvaleurs
     * @return string
     */
    private static function generationDynamiqueQuery(array $choixEtvaleurs, array $choixObligatoiresEtvaleurs) {
        $query = "";
        $liste = [0 => [0 => $choixEtvaleurs, 1 => "OR"], 1 => [ 0 => $choixObligatoiresEtvaleurs, 1 => "AND"]];
        $i = 0; // L'index de valeurChoix
        for ($j = 0; $j < 2; $j++) {
            foreach($liste[$j][0] as $choix => $choixValeurs) {
                foreach($choixValeurs as $choixValeur) { // Juste pour la lisibilité de la boucle
                    /*Certaines variables mises directement pour éviter les '', 
                    j'utilise une whiteListe pour éviter l'injection SQL, cependant la vulnérabillité existe toujours*/        
                    $query .= ($i == 0 ? "WHERE " : $liste[$j][1]) . " " .self::WHITELIST_NOM_ATTRIBUT[$choix] . 
                    ( $j==0 ? " like '%' ||:valeurChoix$i||'%' " : "=:valeurChoix$i "); 
                    $i++;
                }
            }

        }
        return $query;
    }




    /**
     *  Génére dynamiquement les données à utiliser avec generationDynamiqueQuery
     * @param array $data Les valeurs des choix
     * @param array $choixEtvaleurs
     * @return void
     */
    private static function generationDynamiqueData(array &$data, array $choixEtvaleurs, array $choixObligatoiresEtvaleurs) {
        $liste = [0 => [0 => $choixEtvaleurs], 1 => [ 0 => $choixObligatoiresEtvaleurs]];
        $i = 0; // L'index de valeurChoix
        for ($j = 0; $j < 2; $j++) {
            foreach($liste[$j][0] as $choix => $choixValeurs) {  // Juste pour la lisibilité de la boucle
                foreach($choixValeurs as $choixValeur) {
                    $data["valeurChoix$i"] = $choixValeur;
                    $i++;
                }
            }

        }
    }

    





    /**
     * Retourne le nombre d'articles total avec la barre de recherche
     * @param string $titreArtiste
     * @return mixed
     */
    public static function nombreArticlesLike(string $titreArtiste){
        $query = "SELECT COUNT(*)
                    FROM ENCHERE_TOUT_VIEW
                    WHERE titre like '%' ||:titreArtiste ||'%'
                        OR artiste like '%' ||:titreArtiste ||'%'";
        $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, ["titreArtiste" =>$titreArtiste]);
        if (empty($tableContenantLeNombre)) {
            return 0;
        }
        return $tableContenantLeNombre[0][0];
    }


    /**
     * Retouurne le nombre d'article total
     * @return mixed
     */
    public static function nombreArticlesTotal(){
        $query = "SELECT COUNT(*)
                    FROM ENCHERE_TOUT_VIEW";
                    $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, array());
        if (empty($tableContenantLeNombre)) {
            return 0;
        }
        return $tableContenantLeNombre[0][0];
    }

    /**
     * Retourne le nombre d'article en favoris de l'utilisateur
     * @return mixed
     */
    public static function nombreArticlesFavoris(int $numUtilisateur){
        $query = "SELECT COUNT(*)
                    FROM ARTICLE natural join CONCERNE natural join ENCHERE natural left join favorise
                    WHERE num_utilisateur=:num_utilisateur
                    group by num_enchere";
                    $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, [$numUtilisateur]);
        if (empty($tableContenantLeNombre)) {
            return 0;
        }
        //var_dump($tableContenantLeNombre);
        return $tableContenantLeNombre[0][0];
    }

    /**
     * Retourne le nombre d'article remportés par l'utilisateur
     * @return mixed
     */
    public static function nombreArticlesGagne(int $numUtilisateur){
        $query = "SELECT COUNT(*)
            FROM ARTICLE natural join CONCERNE natural join ENCHERE natural left join GAGNE_VIEW
            WHERE num_utilisateur=:num_utilisateur group by num_enchere";
                    $dao = DAO::get();
        
        $tableContenantLeNombre = $dao->query($query, [$numUtilisateur]);
        if (empty($tableContenantLeNombre)) {
            return 0;
        }
        return $tableContenantLeNombre[0][0];
    }


    public static function nombreArticlesPlusieursChoix( array $choixEtvaleurs, array $choixObligatoiresEtvaleurs) { 
        // Je définis moi même la table pour éviter une injection 
        if (!isset($choixObligatoiresEtvaleurs['num_vendeur'])) {
            $ma_table_que_je_definis_et_que_l_utilisateur_ne_peut_pas_toucher = "ENCHERE_TOUT_EN_COURS_VIEW";  
        } else {
            $ma_table_que_je_definis_et_que_l_utilisateur_ne_peut_pas_toucher = "ENCHERE_TOUT_VIEW";
        }


        /*génération dynamique, j'utilise une whiteListe cependant il y'a potentiellement une vulnérabilité*/
        $query = "SELECT COUNT(*)
                    FROM $ma_table_que_je_definis_et_que_l_utilisateur_ne_peut_pas_toucher  " 
                    . Article::generationDynamiqueQuery($choixEtvaleurs, $choixObligatoiresEtvaleurs);
        $data = array();
        Article::generationDynamiqueData($data, $choixEtvaleurs,$choixObligatoiresEtvaleurs);

        $dao = DAO::get();
        $tableContenantLeNombre = $dao->query($query, $data);
        if (empty($tableContenantLeNombre)) {
            return 0;
        }
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