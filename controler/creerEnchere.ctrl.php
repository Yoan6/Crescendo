<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");


    $utilisateur = Utilisateur::read('crescendo.uga@gmail.com', 'Crescendo.uga*');
    $errors = array();
    $article = null;
    $enchere = null;
    $todayDate = new DateTime();
    
    /***************************************************************************
    **                         Données de l'enchère
    ***************************************************************************/
    $dateEnchere = $_POST['dateEnchere'] ?? "";
    
    /***************************************************************************
     **                         Données de l'article
     ***************************************************************************/
    $images = $_POST['images'] ?? array();
    $titre = $_POST['titre'] ?? "";
    $prixMin = $_POST['prixMin'] ?? 0;
    $description = $_POST['description'] ?? "";

    $artiste = $_POST['artiste'] ?? "";
    $dateEvenement = $_POST['dateEvenement'] ?? "";
    $lieu = $_POST['lieu'] ?? "";
    $style = $_POST['style'] ?? "";

    $taille = $_POST['taille'] ?? "";
    $etat = $_POST['etat'] ?? "";
    $categorie =  $_POST['categorie'] ?? "";
    
    var_dump($images);
    var_dump($_FILES);
    /*
    $file_name = $_FILES['img']['name'] ?? "";
    $file_type = $_FILES['img']['type'] ?? "";
    $file_tmp_name = $_FILES['img']['tmp_name'] ?? "";  
    $file_error = $_FILES['img']['error'] ?? "";
    $file_size = $_FILES['img']['size'] ?? 0;
    */


    /***************************************************************************
    **                         Gestion des erreurs
    ***************************************************************************/
    if($titre == "") {
        $errors[] = new Exception("Mauvais titre");
    }
    if($prixMin < 1) {
        $errors[] = new Exception("Mauvais prix");
    }
    if($dateEnchere == "") {
        $errors[] = new Exception("Date pas remplie");
    } else if($dateEnchere < $todayDate->format('Y-m-d')) {
        $errors[] = new Exception("La date doit être supérieure à aujourd'hui");
    }
    if($description == "") {
        $errors[] = new Exception("Mauvaise description");
    }
    //////////////////////////////// Informations sur l'évenement
    if($artiste == "") {
        $errors[] = new Exception("Mauvais artiste");
    }
    if($dateEvenement == "") {
        $errors[] = new Exception("Date pas remplie");
    } else if ($dateEvenement > $todayDate->format('Y-m-d')) {
        $errors[] = new Exception("La date du concert doit être inférieure à aujourd'hui");
    }
    if($lieu == "") {
        $errors[] = new Exception("Mauvais lieu");
    }
    if($style == "") {
        $errors[] = new Exception("Mauvais style");
    }

    ////////////////////////////////// Informations sur l'article
    if($taille == "") {
        $errors[] = new Exception("Mauvaise taille");
    }
    if($etat == "") {
        $errors[] = new Exception("Mauvais état");
    }
    if($categorie == "") {
        $errors[] = new Exception("Mauvaise categorie");
    }


    var_dump($errors);
    if (isset($errors) && count($errors) == 0) {
        /***************************************************************************
        **                         Création de l'article
        ***************************************************************************/
        try {
            $article = new article($utilisateur, $titre, $description, [$images], $prixMin, $artiste, 
                                    $etat, $categorie, $taille, $lieu, $style, new DateTime($dateEvenement)
                                );
            $article->create();
        } catch (Exception $e) {
            $errors[] = new Exception( "L'article n'a pas pu être crée");
        } catch (Error $e) {
            print($e->getMessage());
        }
                            
        /***************************************************************************
         **                         Création de l'enchère
        ***************************************************************************/
        if (isset($errors) && count($errors) == 0) {
            try {
                $enchere = new Enchere([$article]);
                $enchere->setDateDebut(new DateTime($dateEnchere));
                $enchere->create();
            } catch (Exception ) {
                $errors[] = new Exception("L'enchère n'a pas pu être créée");
            }
        }
    }

    


    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/

    $view = new View();
    
    if (isset($errors) && count($errors) == 0) {
        $view->assign('titre',$titre);
        $view->assign('prixMin',$prixMin);
        $view->assign('dateEnchere',$dateEnchere);
        $view->assign('description',$description);

        $view->assign('artiste',$artiste);
        $view->assign('dateEvenement',$dateEvenement);
        $view->assign('style',$style);
        $view->assign('categorie',$categorie);

        $view->assign('taille',$taille);
        $view->assign('etat',$etat);
        $view->assign('lieu',$lieu);

        $view->assign('errors',$errors);
       
        $view->display("creerEnchere.view.php");
    } else {
        
        $view->display("recherche.php");
    }
?>