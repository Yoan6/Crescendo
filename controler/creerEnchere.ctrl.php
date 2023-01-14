<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");


    $utilisateur = Utilisateur::readNum(1);
    $errors = array();
    $article = null;
    $enchere = null;
    $todayDate = new DateTime();
    $confirmer = $_POST['confirmer'] ?? "";
    
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
    

    // Récupérer les images
    var_dump($images);
    var_dump($_FILES);
    
    
    $file_name = $_FILES['img']['name'] ?? "";
    $file_type = $_FILES['img']['type'] ?? "";
    $file_tmp_name = $_FILES['img']['tmp_name'] ?? "";  
    $file_error = $_FILES['img']['error'] ?? "";
    $file_size = $_FILES['img']['size'] ?? 0;
    


    /***************************************************************************
    **                         Gestion des erreurs
    ***************************************************************************/
    // L'attribut required dans les balises html vérifie la pluspart des erreurs

    if ($file_name == "") {
        $errors[] = "Il faut mettre un nom sur l'image";
    }
    if ($file_tmp_name== "") {
        $errors[] = "Il faut mettre un nom sur l'image";
    }
    if ($file_type != 'image/jpeg' && $file_type != 'image/png') {
        $errors[] = "L'image doit être un jpeg ou PNG"; // normalement l'input de l'html  vérifie ce format
    } 
    if ($file_error == "") {
        $errors[] = "L'erreur " . $file_error ." a été détectée ";
    }



    /***************************************************************************
     **                         Création de l'article
     ***************************************************************************/
    if ($confirmer=="confirmer" && count($errors) == 0) 
    {
        try {
            $article = new article($utilisateur, $titre, $description, [$images], $prixMin, $artiste, 
                                    $etat, $categorie, $taille, $lieu, $style, new DateTime($dateEvenement)
                                );
            $article->create();
        } catch (Exception $e) {
            $errors[] =  "L'article n'a pas pu être crée";
        } catch (Error $e) {
            $errors[] =  $e->getMessage();
        }
                            
        /***************************************************************************
         **                         Création de l'enchère
        ***************************************************************************/
        if (count($errors) == 0) {
            try {
                $enchere = new Enchere([$article]);
                $enchere->setDateDebut(new DateTime($dateEnchere));
                $enchere->create();
            } catch (Exception ) {
                $errors[] = "L'enchère n'a pas pu être créée";
            }
        }
    }

    

    if ($confirmer == "") {
        $errors = array(); // L'utilisateur arrive sur la page, il ne doit pas y'avoir d'erreur
    }
    var_dump($errors);
    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/

    $view = new View();
    
    if ($confirmer == "confirmer" && count($errors) == 0)
    {
        // Aller vers une autre page et prévenir de la réussite
        $view->display("recherche.php");

    } else {
        // Aller vers la création d'une enchère
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

        $view->assign('todayDate',$todayDate->format('Y-m-d'));
        $view->assign('errors',$errors);
       
        $view->display("creerEnchere.view.php");
    }
?>