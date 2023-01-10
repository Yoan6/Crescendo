<?php

require_once(__DIR__ . '/../model/DAO.class.php');
require_once(__DIR__ . '/../model/Article.class.php');

    class Enchere {
        private int $numEnchere;
        private int $prixActuel;
        private const DUREE_MAX = 7;

        private DateTime $DATE_DEBUT;
        private int $idPaiement;

        private array $articles = array(); // Si ce n'est pas un lot, alors une enchère est toujours reliée à un article
        private bool $estLot;
        

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
            $this->setPrixActuel(-1);
            $this->setNumEnchere(-1);
            $this->setDateDebut(new DateTime());
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

        public function getPrixActuel()
        {
            return $this->prixActuel;
        }

        public function setPrixActuel(int $prixActuel)
        {
            $this->prixActuel = $prixActuel;
        }

        public function getEstLot()
        {
            return $this->estLot;
        }

        private function setEstLot(int $estLot)
        {
            $this->estLot = $estLot;
        }


        public function getArticles() : array
        {
            return $this->articles;
        }

        public function ajouterArticle(Article $article)
        {
            array_push($this->articles,$article);
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

        public function getDateDebut() : string
        {
            return $this->dateDebut->format('d/m/y');
        }

        private function setDateDebut(dateTime $dateDebut)
        {
            $this->dateDebut = $dateDebut;
        }



    /**
     * Récupère toutes les valeurs nécessaires pour un CREATE ou UPDATE
     * @return array
     */
        private function getData() : array {
            return array(
                ':date_debut' => $this->getDateDebut(),
                ':est_lot' => $this->getEstLot(),
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
            $dao->exec($queryEnchere,$this->getData());


            //assigner le bon id à cet objet
            $num_enchere_serial = $dao->query("SELECT max(num_enchere) FROM ENCHERE;",array())[0]['max(num_enchere)'];
            $this->setNumEnchere($num_enchere_serial); 


            // Lier l'enchères aux articles dans la base
            foreach($this->getArticles() as $article) {
                $queryEnchereArticle = "INSERT INTO CONCERNE(num_article, num_enchere) Values(?,?)";
                $dao->exec($queryEnchereArticle,[$article->getNumArticle(),$this->getNumEnchere()]);
            }
            
        }

        /////////////////////////// READ /////////////////////////////////////
        public static function read($numEnchere) : Enchere
        {
            $query = "SELECT *
                    FROM ENCHERE e natural left join CONCERNE c
                    WHERE num_enchere = ?;";

            $dao = DAO::get();
            $table = $dao->query($query,[$numEnchere]);
            if(count($table) != 1) {throw new Exception("l'enchère n'existe pas");}


            // Récupérer les articles
            $articles = array();
            foreach($table as $ligne) {array_push( $articles, Article::readNum($ligne["num_article"]) );}
            $ligne = $table[0];
            $enchere = new Enchere($articles);
            $enchere->setNumEnchere($ligne['num_enchere']);
            return $enchere;
        }

        public static function readLike(string $titrePattern) : array
        {
            // Chercher les articles ayants ces noms
            $articles = Article::readLike($titrePattern);
            
            // Récupérer les enchères associées
            $query = "SELECT distinct num_enchere
                FROM ARTICLE a natural left join CONCERNE c
                WHERE num_article = ?;";
            $dao = DAO::get();
            $encheres = array();
            foreach($articles as $article) {
                array_push($encheres, ENCHERE::read($dao->exec($query, [$article->getNumArticle()])) );
            }
            return array();
        }

        /////////////////////////// UPDATE /////////////////////////////////////
        public function update()
        {
            $query = "UPDATE ENCHERE
            set (est_lot,date_debut)
                = (:est_lot,:date_debut)
            WHERE num_enchere = '$this->numEnchere'"; 

            $dao = DAO::get();
            $dao->exec($query,$this->getData());
        }

        /////////////////////////// DELETE /////////////////////////////////////
        public function delete()
        {
            $query = "DELETE FROM ENCHERE WHERE num_ENCHERE = :num_enchere;";
            
            $dao = DAO::get();
            $dao->exec($query,[$this->getNumEnchere()]);
        }
        


        function egalEnchere(Enchere $numEnchere) : bool
        {
            return $this->getNumEnchere() == $numEnchere->getNumEnchere();
        }
    
    }
?>