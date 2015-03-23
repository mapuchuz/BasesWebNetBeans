<?php

/* initialisation */
require("includes/all.php");
$page = (isset($_GET['page']) ? $_GET['page'] : "article_list");

$control= strtok($page, "_");
if($control=="article")
    $control=   "Article";
$action= strtok("_");

//inclusion dynamique du Repository
require("model/" . $control . "Repository.php");
//instantiation dynamique du Repository
$repositoryName= $control . "Repository"; 
$articlerepository= new $repositoryName($db);

/* analyse de la page demandée et création des variables */
$montrerHtml = true;
$html=  '';

if($control!="") {
    $controlName=   $control . "Controller";
    //inclusion dynamique
    require("pages/" . $controlName . ".php");
    //instantiation dynamique
    $controller= new $controlName($articlerepository);

    if($action!="") {
        $action.= "Action";
        if( method_exists($controller, $action) ) {
            $pageInclue=    'DEPRECATED';
            $html=  $controller->$action();
        }
    }
}

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
