<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");


    $utilisateur = Utilisateur::readNum(1);
    $errors = array();
    $messages = array();
    $article = null;
    $enchere = null;
    $todayDate = new DateTime();
    // Pour relancer le controller
    $controllerName = basename(__FILE__);
    $confirmer = $_POST['confirmer'] ?? "";
    
    /***************************************************************************
    **                         Données de l'enchère
    ***************************************************************************/
    $dateEnchere = $_POST['dateEnchere'] ?? "";
    
    /***************************************************************************
     **                         Données de l'article
     ***************************************************************************/
    $nomsImages = array();
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


    /***************************************************************************
     **                         Gestion des erreurs
     ***************************************************************************/
    // L'attribut required dans les balises html vérifie la pluspart des erreurs
    
    // Gérer les images

    foreach($_FILES as $image) {
        
        $file_name = $image['name'] ?? "";
        
        $file_type = $image['type'] ?? "";
        $file_tmp_name = $image['tmp_name'] ?? "";
        $file_error = $image['error'] ?? "";
        $file_size = $image['size'] ?? 0;

        if ($file_size == 0 && count($image) >= 1) {
            goto finImage; // Pas très propre mais je n'ai pas trouvé d'autres moyens
        } 
        else if ($file_name == "") {
            $errors[] = "Il faut mettre un nom sur l'image";
        }
        else if ($file_type != 'image/jpeg' && $file_type != 'image/png') {
            $errors[] = "L'image $file_name doit être un jpeg ou PNG"; // normalement l'input de l'html  vérifie ce format
        }
        else if ($file_error == "") {
            $errors[] = "L'erreur sur $file_name " . $file_error . " a été détectée ";
        } 
        else {
            // Pas d'erreurs l'ajouter
            $nomsImages[] = $file_name; // Mettre les noms des fichiers pour la création d'un article
        }
    }
    finImage:

    /***************************************************************************
     **                         Création de l'article
     ***************************************************************************/
    if ($confirmer=="confirmer" && count($errors) == 0 && count($image) >= 1); 
    {
        try {
            $article = new article($utilisateur, $titre, $description, $nomsImages, $prixMin, $artiste, 
                                    $etat, $categorie, $taille, $lieu, $style, new DateTime($dateEvenement)
                                );
            $article->create();
            
            /***************************************************************************
             **                         Création de l'enchère
            ***************************************************************************/
            $enchere = new Enchere([$article]);
            $enchere->setDateDebut(new DateTime($dateEnchere));
            $enchere->create();
            
            // Télécharger les fichiers sur le serveur
            foreach ($_FILES as $image) {
                if($image['size'] != 0) move_uploaded_file($image['tmp_name'], $chemin_image . $image['name']);
            }
            $messages[] = "L'enchère " . $titre . " a été  créée";

        } catch (Exception $e) {
            $errors[] =  "L'enchère n'a pas pu être créée" . $e->getMessage();
        } catch (Error $e) {
            $errors[] =  $e->getMessage();
        }
                            

    }

    

    if ($confirmer == "") {
        $errors = array(); // L'utilisateur arrive sur la page, il ne doit pas y'avoir d'erreur
    }
    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/

    $view = new View();
    
    // Charger les données
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
    $view->assign('controller',$controller);

    if ($confirmer == "confirmer" && count($errors) == 0)
    {
        // Prévisualiser l'enchère et prévenir de la réussite

        $view->assign('messages',$messages);
        $view->display("z.test.afficherArticler.view.php");

    } else {
        // Aller vers la création d'une enchère

        $view->assign('todayDate',$todayDate->format('Y-m-d'));
        $view->assign('errors',$errors);

        $view->display("creerEnchere.view.php");
    }
?>