<?php
    include_once(__DIR__."/../framework/view.class.php");
    include_once(__DIR__."/../model/Utilisateur.class.php");
    include_once(__DIR__."/../model/Article.class.php");
    include_once(__DIR__."/../model/Enchere.class.php");
    $numEnchere = 1;

    $view = new View();
    $view->assign('numEnchere',$numEnchere);
    $view->display('../ajax/testAjax.view.php');
?>