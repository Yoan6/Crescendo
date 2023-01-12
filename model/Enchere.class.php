<?php

require_once(__DIR__ . '/../model/DAO.class.php');
require_once(__DIR__ . '/../model/Article.class.php');

    class Enchere {
        private int $numEnchere;
        private const DUREE_MAX = 7;

        private DateTime $dateDebut;

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


        public function getEstLot() : bool
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
        public function getArticles() : array
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

        public function getDateDebut() : DateTime
        {
            return $this->dateDebut;
        }

        public function getDateFin() : DateTime
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
        private function getData() : array {
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
            $dao->exec($queryEnchere,$this->getData());


            //assigner le bon numéro à cet objet, car c'est la base qui le génère
            $num_enchere_serial = $dao->query("SELECT max(num_enchere) FROM ENCHERE;",array())[0][0];
            $this->setNumEnchere($num_enchere_serial); 


            // Lier l'enchères aux articles dans la base
            foreach($this->getArticles() as $article) {
                $queryEnchereArticle = "INSERT INTO CONCERNE(num_article, num_enchere) Values(?,?)";
                $dao->exec($queryEnchereArticle,[$article->getNumArticle(),$this->getNumEnchere()]);
            }
            
        }

        /////////////////////////// READ /////////////////////////////////////
        /**
         * Récupère une enchère à partir de son numéro, puis récupère les articles de l'enchères (un si c'est pour objet, plusieurs si c'est un lot)
         * @param int $numEnchere
         * @throws Exception
         * @return Enchere
         */
        public static function read(int $numEnchere) : Enchere
        {
            $query = "SELECT *
                    FROM ENCHERE e natural left join CONCERNE c
                    WHERE num_enchere = ?;";

            $dao = DAO::get();
            $table = $dao->query($query,[$numEnchere]);
            if(count($table) != 1) {
                throw new Exception("l'enchère n'existe pas");
            }

            // Récupérer les articles
            $articles = array();
            foreach($table as $ligne) {
                array_push( $articles, Article::readNum($ligne["num_article"]) );
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
            // Parcourir les articles obtenues pour leur associer les enchères
            foreach($articles as $article) {
                $numEnchere = $dao->query($query, [$article->getNumArticle()])[0][0];
                array_push($encheres, ENCHERE::read($numEnchere) );
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
            $dao->exec($query,$this->getData());
        }

        /////////////////////////// DELETE /////////////////////////////////////
        public function delete()
        {
            $query = "DELETE FROM ENCHERE WHERE num_ENCHERE = :num_enchere;"; // Des triggers feront des DELETE dans les autres tables
            
            $dao = DAO::get();
            $dao->exec($query,[$this->getNumEnchere()]);
        }
        


        function egalEnchere(Enchere $numEnchere) : bool
        {
            return $this->getNumEnchere() == $numEnchere->getNumEnchere();
        }

        



        /********************************************* AUTRES METHODES ****************************************/
        public function encherir(Utilisateur $utilisateur, int $prixOffre) {
            $dao = DAO::get();
            $dateEncherissement =  (new DateTime("now"))->format('Y-m-d');

            // Insérer en base de données
            try {
                $queryEnchere = "INSERT INTO ENCHERIT(num_utilisateur,num_enchere,prix_offre,date_encherissement) Values(:num_utilisateur,:num_enchere,:prix_offre,:date_encherissement)";
                $data = [
                    "num_utilisateur" =>$utilisateur->getNumUtilisateur(), 
                    "num_enchere" => $this->getNumEnchere(), 
                    "prix_offre" => $prixOffre,
                    "date_encherissement" =>  $dateEncherissement // Format ISO pour la base de données
                ];
                $dao->exec($queryEnchere,$data);
            } catch (exception $e) {
                // Une erreur peut être générée si l'offre n'est pas la plus haute
                print('\nErreur ' . $e->getMessage() . "\n");
            } 
        }

        public function obtenirPrixActuel() : int|string {
            $dao = DAO::get();
            $queryEnchere = "SELECT max(prix_offre) FROM ENCHERIT where num_enchere = :num_enchere;";
            $data = [
                "num_enchere" => $this->getNumEnchere(), 
            ];
            $table = $dao->query($queryEnchere,$data);

            $prix = $table[0][0];
            if($prix == null) {
                $prix = "Aucun prix pour l'instant, min : " . Article::getTypeArticleFromArray($this->getArticles(),0)->getPrixMin(); 
            }

            return $prix;
        }

        
    
    }
?>