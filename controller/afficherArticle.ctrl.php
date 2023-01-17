<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");

    $prix = $_POST['prix'] ?? 0; 


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /***************************************************************************
    **                         Données de l'enchère
    ***************************************************************************/
    $utilisateur = Utilisateur::readNum(1);
    $num_enchere = $_GET['numEnchere'] ?? 1;
    $enchere = Enchere::read($num_enchere);
    $prixActuel = $enchere->obtenirPrixActuel();
    $dateFin = $enchere->getDateFin()->format('d-m-Y');

    /***************************************************************************
    **                         Données de l'article
    ***************************************************************************/
    
    // Note : getArticles renvoie une array d'article, cependant php n'a pas de type arrayObject donc il ne sait pas que c'est l'array contient des types articles 
    $articleArray = $enchere->getArticles(); // Recupère un type Array
    $article = Article::getTypeArticleFromArray($articleArray,0); // Conversion en type Article

    
    $imgUrl = $article->getImagesURL();
    $nomEnchere = $article->getTitre();
    $description = $article->getDescription();
    $numArticle = $article->getNumArticle();
    $titre = $article->getTitre();
    $nomImages = $article->getImages();
    $artiste = $article->getArtiste();
    $prixMin = $article->getPrixMin();
    $etat = $article->getEtat();
    $categorie = $article->getCategorie();
    $taille = $article->getTaille();
    $dateEvenement = $article->getDateEvenement();
    $lieu = $article->getLieu();
    $style = $article->getStyle();


    /***************************************************************************
    **                         Données du vendeur
    ***************************************************************************/
    $vendeur = $article->getVendeur();
    $imgProfil = $article->getVendeur()->getImgProfil();
    $numUtilisateur = $article->getVendeur()->getNumUtilisateur();
    $pseudo = $article->getVendeur()->getPseudo();



    /***************************************************************************
    **                         Construction de la vue
    ***************************************************************************/
    $view = new View();
    
    // données de l'enchère
    $view->assign('prixActuel', $prixActuel);
    $view->assign('dateFin', $dateFin);

    // données de l'article
    $view->assign('imgUrl', $imgUrl);
    $view->assign('nomEnchere', $nomEnchere);
    $view->assign('numEnchere', $num_enchere);
    $view->assign('description', $description);
    $view->assign('numArticle', $numArticle);
    $view->assign('titre', $titre);
    $view->assign('nomImages', $nomImages);
    $view->assign('artiste', $artiste);
    $view->assign('prixMin', $prixMin);
    $view->assign('etat', $etat);
    $view->assign('categorie', $categorie);
    $view->assign('taille', $taille);
    $view->assign('dateEvenement', $dateEvenement);
    $view->assign('lieu', $lieu);
    $view->assign('style', $style);

    // données du vendeur
    $view->assign('vendeur', $vendeur);
    $view->assign('imgProfil', $imgProfil);
    $view->assign('numUtilisateur', $numUtilisateur);
    $view->assign('pseudo', $pseudo);

    
    /***************************************************************************
     **                         Gestion des erreurs
     ***************************************************************************/
    
    
    // test encherir
    try {
        $enchere->encherir($utilisateur, $prix);
    } catch (exception $e) {
        // Une erreur peut être générée si l'offre n'est pas la plus haute
        print('\n Erreur ' . $e->getMessage() . "\n");
    }
    
    $view->display("voirEnchère.php");
?>