<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    if(!isset($_SESSION)) { session_start(); }

    $numEnchere = $_GET['idArticleAModifier'] ?? 0;

    $enchere = Enchere::read($numEnchere);
    $article = Article::getTypeArticleFromArray($enchere->getArticles(),0);



    if ($article->getVendeur()->getNumUtilisateur() == $_SESSION['num_utilisateur']) {
        $errors = array();
        $messages = array();
        $todayDate = new DateTime();
        // Pour relancer le controller
        $controllerName = basename(__FILE__);
        $confirmer = $_POST['confirmer'] ?? "";

        /***************************************************************************
         **                         Données de l'enchère
        ***************************************************************************/



        //Si la date de début est inférieure à la date du jour, on la met à la date du jour
        $dateEnchere = $_POST['dateEnchere'] ?? null;

        if($dateEnchere === null){
            $dateEnchere = $enchere->getDateDebut()->format('Y-m-d');
        }


        $enchere->setDateDebut(new DateTime($dateEnchere));

        $dateFin = $enchere->getDateFin()->format('Y-m-d');

        /***************************************************************************
         **                         Données de l'article
        ***************************************************************************/
        $titre = $article->getTitre();
        $prixMin = $article->getPrixMin();
        $description = $_POST['description'] ??  $article->getDescription();
        $artiste = $_POST['artiste'] ??  $article->getArtiste();
        $dateEvenement = $_POST['dateEvenement'] ??  $article->getDateEvenement();
        $lieu = $_POST['lieu'] ??  $article->getLieu();
        $style = $_POST['style'] ??  $article->getStyle();
        $numVendeur = $article->getVendeur()->getNumUtilisateur();

        $taille = $_POST['taille'] ?? $article->getTaille();
        $etat = $_POST['etat'] ??  $article->getEtat();
        $categorie = $_POST['categorie'] ??  $article->getCategorie();

        $article->setTitre($titre);
        $article->setPrixMin($prixMin);
        $article->setDescription($description);
        
        $article->setArtiste($artiste);
        $article->setDateEvenement(new DateTime($dateEvenement));
        
        $article->setLieu($lieu);
        $article->setStyle($style);
        
        $article->setTaille($taille);
        $article->setEtat($etat);
        $article->setCategorie($categorie);


        if ($confirmer == "confirmer") {
            try {
                $article->update();
                $enchere->update();

            } catch (Exception $e) {
                $errors[] = "L'enchère n'a pas pu être update" . $e->getMessage();
            } catch (Error $e) {
                $errors[] = $e->getMessage();
            }
        }


        /***************************************************************************
         **                         Construction de la vue
        ***************************************************************************/

        $view = new View();

        // Charger les données
        $view->assign('titre', $titre);
        $view->assign('prixMin', $prixMin);
        $view->assign('dateEnchere', $dateEnchere);
        $view->assign('dateFin', $dateFin);
        $view->assign('description', $description);

        $view->assign('artiste', $artiste);
        $view->assign('dateEvenement', $dateEvenement);
        $view->assign('style', $style);
        $view->assign('categorie', $categorie);

        $view->assign('taille', $taille);
        $view->assign('etat', $etat);
        $view->assign('lieu', $lieu);
        $view->assign('controllerName', $controllerName . "?idArticleAModifier=$numEnchere");
        $view->assign('numVendeur', $numVendeur);

        if ($confirmer == "confirmer" && count($errors) == 0) {
            // Prévisualiser l'enchère et prévenir de la réussite

            $view->assign('messages', $messages);
        header("Location: afficherArticle.ctrl.php?numEnchere=$numEnchere");

        } else {
            //On indique que nous sommes en mode modification   
            $modification = true;
            $view->assign('modification', $modification);
            $view->assign('todayDate', $todayDate->format('Y-m-d'));
            $view->assign('errors', $errors);

            $view->display("creerEnchere.view.php");
        }
    }
?>