<?php

//print_r($_SERVER);

/* initialisation */
require("includes/all.php");

$articlerepository= new ArticleRepository($db);

$page = (isset($_GET['page']) ? $_GET['page'] : "article_list");

/* analyse de la page demandée et création des variables */

$montrerHtml = true;
$html=  '';


$control= strtok($page, "_");
if($control=="article")
    $control=   "Article";
$action= strtok("_");

if($control!="") {
    $control.=      "Controller";
    $controller= new $control($articlerepository);

    if($action!="") {
        $action.= "Action";
        if( method_exists($controller, $action) ) {
            $pageInclue=    'DEPRECATED';
            $html=  $controller->$action();
        }
    }
}
/*
switch ($page) {
    case "register":
        $titre = "Formulaire d'enregistrement";
        $pageInclue = "pages/register.php";
        break;
    case "register_traitement":
        $pageInclue = "pages/register_traitement.php";
        $montrerHtml = false;
        break;
    case "article_read":
        $titre = "Lecture d'un article";
        $pageInclue=    'DEPRECATED';
        $html=  $articleControl->readAction();
        break;
    case "article_list":
        $titre = "Liste des articles";
        $pageInclue=    'DEPRECATED';
        $html=  $articleControl->listAction();
        break;
    case "article_add":
    case "article_edit":
        $titre = "Ajout/édition d'un article";
        $pageInclue=    'DEPRECATED';
        $html=  $articleControl->editAction();
        break;
    case "article_delete":
        $titre = "Suppression d'un article";
        $pageInclue=    'DEPRECATED';
        $html=  $articleControl->deleteAction();
        break;
    case "home":
    default:
        $titre = "Page d'accueil";
        $pageInclue = "pages/home.php";
        break;
}
*/
// si cette page a un affichage graphique, tout inclure, sinon juste un script
if ($montrerHtml) {
    // le header contient le début de la page jusqu'à la balise <body>
    include("blocs/header.php");

    // le menu est composé de la balise <nav> et de ses items
    include("blocs/menu.php");

    /* début corps de page */

    // on affiche les messages éventuels
    showMessages();

    // on affiche le contenu principal de la page
    if($pageInclue!="DEPRECATED") 
        include($pageInclue);
    else        
        echo $html;

    /* fin corps de page */

    // on affiche le footer et on ferme la page html
    include("blocs/footer.php");
} else {
    // on inclut le script demandé
    include($pageInclue);
}
