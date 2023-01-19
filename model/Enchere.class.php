<?php

require_once(__DIR__ . '/../model/DAO.class.php');
require_once(__DIR__ . '/../model/Article.class.php');

class Enchere
{
    private int $numEnchere;
    private const DUREE_MAX = 7;

    private DateTime $dateDebut;

    private array $articles = array(); // Si ce n'est pas un lot, alors une enchère est toujours reliée à un article
    private bool $estLot;

    private string $nomLot;


    public function __construct(array $articles)
    {
        if (count($articles) == 1) {
            $this->ajouterArticle($articles[0]);
            $this->setEstLot(false);
        } else {
            $this->setEstLot(true);
            $this->faireLot($articles);
        }
        // Autres initialisation
        $this->setNumEnchere(-1);
        $this->setDateDebut(new DateTime()); // N'est pas mis en paramètre dans le constructeur car le lot prendra le minimun des dates des enchères des articles
    }




    /******************** 
     * Getter and Setter
     *********************/

    public function getNumEnchere()
    {
        return $this->numEnchere;
    }

    private function setNumEnchere(int $numEnchere)
    {
        $this->numEnchere = $numEnchere;
    }


    public function getEstLot(): bool
    {
        return $this->estLot;
    }

    private function setEstLot(bool $estLot)
    {
        $this->estLot = $estLot;
    }

    /**
     * Récupère une array d'article' Article (à coupler avec getTypeArticleFromArray de Article pour récupérer le type)
     * @return array Article
     */
    public function getArticles(): array
    {
        return $this->articles;
    }




    /**
     * Ajoute des articles (pour les lots)
     * @param Article $article
     * @return void
     */
    public function ajouterArticle(Article $article)
    {
        array_push($this->articles, $article);
    }

    public function enleverArticle(Article $articles)
    {
        if ($this->estLot) {
            foreach ($articles as $article) {
                unset($this->articles[$article]);
            }
        }
    }

    public function faireLot(array $articles)
    {
        if ($this->estLot) {
            foreach ($articles as $article) {
                $this->ajouterArticle($article);
            }
        }
    }

    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }

    public function getDateFin(): DateTime
    {
        return ($this->dateDebut->modify('+ 7day'));
    }

    public function setDateDebut(dateTime $dateDebut)
    {
        $this->dateDebut = $dateDebut; // Format ISO pour la base de données;
    }



    /**
     * Récupère toutes les valeurs nécessaires pour un CREATE ou UPDATE
     * @return array
     */
    private function getData(): array
    {
        return array(
            'date_debut' => $this->getDateDebut()->format('Y-m-d'),
            'est_lot' => (int) $this->getEstLot(), // postgresql n'accepte pas les bool des PHP, donc on fait une conversion en int
        ); //Note : ajouter + de valeur qu'il en faut résulte en l'erreur : SQLSTATE[HY000]: General error: 25 column index out of range
    }


    /******************** 
     * CRUD
     *********************/

    /////////////////////////// CREATE /////////////////////////////////////
    public function create()
    {
        $dao = DAO::get();
        // Insérer les enchères dans la base 
        $queryEnchere = "INSERT INTO ENCHERE(est_lot,date_debut) Values(:est_lot,:date_debut)";
        $dao->exec($queryEnchere, $this->getData());


        //assigner le bon numéro à cet objet, car c'est la base qui le génère
        $num_enchere_serial = $dao->query("SELECT max(num_enchere) FROM ENCHERE;", array())[0][0];
        $this->setNumEnchere($num_enchere_serial);


        // Lier l'enchères aux articles dans la base
        foreach ($this->getArticles() as $article) {
            $queryEnchereArticle = "INSERT INTO CONCERNE(num_article, num_enchere) Values(?,?)";
            $dao->exec($queryEnchereArticle, [$article->getNumArticle(), $this->getNumEnchere()]);
        }

    }

    /////////////////////////// READ /////////////////////////////////////
    /**
     * Récupère une enchère à partir de son numéro, puis récupère les articles de l'enchères (un si c'est pour objet, plusieurs si c'est un lot)
     * @param int $numEnchere
     * @throws Exception
     * @return Enchere
     */
    public static function read(int $numEnchere): Enchere
    {
        $query = "SELECT *
                    FROM ENCHERE e natural left join CONCERNE c
                    WHERE num_enchere = ?;";

        $dao = DAO::get();
        $table = $dao->query($query, [$numEnchere]);
        if (count($table) < 1) {
            throw new Exception("l'enchère $numEnchere n'existe pas");
        }

        // Récupérer les articles
        $articles = array();
        foreach ($table as $ligne) {
            array_push($articles, Article::readNum($ligne["num_article"]));
        }

        // Avoir l'enchère et mettre le bon numéro
        $enchere = new Enchere($articles);
        $enchere->setNumEnchere($numEnchere); // La base de donnée attribue le numéro
        $enchere->setDateDebut(new DateTime($ligne["date_debut"]));
        return $enchere;
    }

    /**
     * Rechercher les Enchères ayant des articles avec des titres contenant le pattern
     * @param string $titrePattern
     * @return array
     */
    public static function readLike(string $titrePattern): array
    {
        // Chercher les articles ayants ces noms
        $articles = Article::readLike($titrePattern);
        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);
    }





    /////////////////////////// ReadPage /////////////////////////////////////
    /**
     * Chercher avec la barre de recherche
     * @param int $page
     * @param int $pageSize
     * @param string $titreArtistePattern
     * @return array d'Encheres
     */
    public static function readPageLike(int $page, int $pageSize, string $titreArtistePattern): array
    {
        // Chercher dans les articles, puis récupérer les enchères à partir des articles
        $articles = Article::readPageLike($page, $pageSize, $titreArtistePattern);
        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);
    }



    /**
     * 
     * Retourne les articles les plus populaires
     * @param string $page
     * @param int $pageSize
     * @return array
     */
    public static function readPageALaUne(string $page, int $pageSize): array
    {
        $articles = Article::readPageALaUne($page, $pageSize);
        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);
    }


    public static function readPageFavoris(string $page, int $pageSize, int $numUtilisateur): array
    {
        $articles = Article::readPageFavoris($page, $pageSize,$numUtilisateur);
        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);
    }

    public static function readPageGagne(string $page, int $pageSize, int $numUtilisateur): array
    {
        $articles = Article::readPageGagne($page, $pageSize,$numUtilisateur);
        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);
    }


    public static function readPagePlusieursChoix(
        int $page, int $pageSize, array $choixEtvaleurs,
        array $choixObligatoiresEtValeurs, string $orderByChoix = "date_debut", string $orderBy = "DESC"
    ): array
    {
        $articles = Article::readPagePlusieursChoix($page, $pageSize, $choixEtvaleurs, $choixObligatoiresEtValeurs, $orderByChoix, $orderBy);

        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);

    }





    //retourne les articles sans spécifier la categorie dans l'ordre des likes

    public static function readPage(int $page, int $pageSize): array
    {
        $articles = Article::readPage($page, $pageSize);
        return ENCHERE::obtenirEncheresAPartirDesNumerosArticles($articles);
    }
    






    public static function obtenirEncheresAPartirDesNumerosArticles(array $articles)
    {
        // Récupérer les enchères associées
        $query = "SELECT distinct num_enchere FROM ENCHERE_TOUT_VIEW WHERE num_article = ? AND est_lot='FALSE';";
        //$query2 = "SELECT distinct num_enchere FROM ENCHERE_TOUT_VIEW WHERE num_article = ? AND est_lot='TRUE';";
        $dao = DAO::get();
        $encheres = array();
        // Parcourir les articles obtenues pour leur associer les enchères
        foreach ($articles as $article) {
            $table = $dao->query($query, [$article->getNumArticle()]);

            if (count($table) >= 1) {
                $encheres[] = ENCHERE::read($table[0]["num_enchere"]);
            } 

        }
        return $encheres;
    }






    /////////////////////////// UPDATE /////////////////////////////////////
    public function update()
    {
        $query = "UPDATE ENCHERE
            set (est_lot,date_debut)
                = (:est_lot,:date_debut)
            WHERE num_enchere = '$this->numEnchere'";

        $dao = DAO::get();
        $dao->exec($query, $this->getData());
    }

    /////////////////////////// DELETE /////////////////////////////////////
    public function delete()
    {
        $query = "DELETE FROM ENCHERE WHERE num_ENCHERE = :num_enchere;"; // Des triggers feront des DELETE dans les autres tables

        $dao = DAO::get();
        $dao->exec($query, [$this->getNumEnchere()]);
    }



    function egalEnchere(Enchere $numEnchere): bool
    {
        return $this->getNumEnchere() == $numEnchere->getNumEnchere();
    }





    /********************************************* AUTRES METHODES ****************************************/
    public function encherir(Utilisateur $utilisateur, int $prixOffre)
    {
        $dao = DAO::get();
        $dateEncherissement = (new DateTime("now"))->format('Y-m-d');

        // Insérer en base de données
        try {
            $queryEnchere = "INSERT INTO ENCHERIT(num_utilisateur,num_enchere,prix_offre,date_encherissement) Values(:num_utilisateur,:num_enchere,:prix_offre,:date_encherissement)";
            $data = [
                "num_utilisateur" => $utilisateur->getNumUtilisateur(),
                "num_enchere" => $this->getNumEnchere(),
                "prix_offre" => $prixOffre,
                "date_encherissement" => $dateEncherissement // Format ISO pour la base de données
            ];
            $dao->exec($queryEnchere, $data);
        } catch (exception $e) {
            // Une erreur peut être générée si l'offre n'est pas la plus haute
            print('\nErreur ' . $e->getMessage() . "\n");
        }
    }

    public function obtenirPrixActuel()
    {
        $dao = DAO::get();
        $queryEnchere = "SELECT prix_actuel from ENCHERE_TOUT_VIEW where num_enchere = :num_enchere;";
        $data = [
            "num_enchere" => $this->getNumEnchere(),
        ];
        $table = $dao->query($queryEnchere, $data);

        $prix = $table[0][0];
        if ($prix == null) {
            throw new Exception("prix du lot non renseignée");

        }

        return $prix;
    }



    /********************************************* Like ****************************************/


    /**
     * Récupérer le nombre de like total
     */
    public function getCompteurLike(): int
    {
        $dao = DAO::get();
        $queryLike = "SELECT sum(CASE est_like WHEN TRUE then 1 WHEN false then -1 END) FROM LIKE_DISLIKE where num_enchere = :num_enchere;";
        $data = [
            "num_enchere" => $this->getNumEnchere(),
        ];
        $table = $dao->query($queryLike, $data);
        return ($table[0][0] ?? 0);
    }


    public function getLike(int $numUtilisateur): int|null
    {
        $dao = DAO::get();
        $querySelect = "SELECT COALESCE(CASE est_like WHEN true THEN 1 ELSE -1 END, 0) as est_like FROM LIKE_DISLIKE WHERE num_utilisateur = :num_utilisateur AND num_enchere = :num_enchere;";
        $data = [
            "num_enchere" => $this->getNumEnchere(),
            "num_utilisateur" => $numUtilisateur,
        ];

        return ($dao->query($querySelect, $data)[0]["est_like"] ?? NULL);
    }




    /**
     * Si l'article est déjà like et qu'on appuie une 2ème fois, enlever le like
     * @param int $numUtilisateur
     * @param int $estlike
     * @return void
     */
    public function setLike(int $numUtilisateur, int $estlike): void
    {
        $dao = DAO::get();
        // L'utilisateur ne peut like qu'une fois il faut donc savoir s'il a déjà like

        $queryInsert = "INSERT INTO LIKE_DISLIKE(num_utilisateur,num_enchere,est_like) values(:num_utilisateur,:num_enchere,:est_like);";
        $queryUpdate = "UPDATE LIKE_DISLIKE set est_like=:est_like where (num_utilisateur,num_enchere)=(:num_utilisateur,:num_enchere);";
        $queryDelete = "DELETE FROM LIKE_DISLIKE where (num_utilisateur,num_enchere)=(:num_utilisateur,:num_enchere);";
        $est_like_db = $this->getLike($numUtilisateur); // Note: dans un switch la valeur null est mise à 0

        $data = [
            "num_enchere" => $this->getNumEnchere(),
            "num_utilisateur" => $numUtilisateur,
        ];

        var_dump($est_like_db, $estlike);
        // ****** Requête préparée ******* /
        if ($est_like_db === NULL) {
            $dao->exec($queryInsert, array_merge($data, ["est_like" => $estlike])); // Première fois qu'il clique, INSERT
        } else if ($est_like_db === $estlike - 1 || $est_like_db === $estlike) {
            $dao->exec($queryDelete, $data); // Le delete, il a décoché
        } else {
            $dao->exec($queryUpdate, array_merge($data, ["est_like" => $estlike])); // update
        }

    }





    /********************************************* Favoris ****************************************/

    public function getFavoris(int $numUtilisateur): int|null
    {
        $dao = DAO::get();
        $querySelect = "select est_favoris from FAVORISE WHERE num_utilisateur = :num_utilisateur AND num_enchere = :num_enchere;";
        $data = [
            "num_enchere" => $this->getNumEnchere(),
            "num_utilisateur" => $numUtilisateur,
        ];

        return ($dao->query($querySelect, $data)[0]["est_favoris"] ?? NULL);
    }


    public function setFavoris(int $numUtilisateur, int $estFavoris): void
    {
        $dao = DAO::get();
        // L'utilisateur ne peut favoriser qu'une fois il faut donc savoir s'il a déjà favorisé l'article

        $queryInsert = "INSERT INTO FAVORISE(num_utilisateur,num_enchere,est_favoris) values(:num_utilisateur,:num_enchere,:est_favoris);";
        $queryUpdate = "UPDATE FAVORISE set est_favoris=:est_favoris where (num_utilisateur,num_enchere)=(:num_utilisateur,:num_enchere);";
        $queryDelete = "DELETE FROM FAVORISE where (num_utilisateur,num_enchere)=(:num_utilisateur,:num_enchere);";
        $est_favoris_db = $this->getFavoris($numUtilisateur); // Note: dans un switch la valeur null est mise à 0

        $data = [
            "num_enchere" => $this->getNumEnchere(),
            "num_utilisateur" => $numUtilisateur,
        ];

        var_dump($est_favoris_db, $estFavoris);
        // ****** Requête préparée ******* /
        if ($est_favoris_db === NULL) {
            $dao->exec($queryInsert, array_merge($data, ["est_favoris" => $estFavoris])); // Première fois qu'il clique, INSERT
        } else if ($est_favoris_db === $estFavoris) {
            $dao->exec($queryDelete, $data); // Le delete, il a décoché
        } else {
            $dao->exec($queryUpdate, array_merge($data, ["est_favoris" => $estFavoris])); // update
        }

    }


}
?>