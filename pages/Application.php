<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Application
 *
 * @author hb
 */

class Application {
    private $dB;
    private $content;
    private $title;
    
    public function __construct($db) {
        $this->dB=  $db;
    }
    /**
     * interprète les demandes de l'utilisateur
     */
    public function handleRequest() {
        $control= (isset($_GET['control']) ? $_GET['control'] : "article");
        $control=   ucfirst(strtolower($control));
        $action= (isset($_GET['action']) ? $_GET['action'] : "list");
 
        $repositoryName=   $control . "Repository"; 
        //inclusion dynamique du Repository
        require("model/" . $repositoryName . ".php");
        //instantiation dynamique du Repository
        $articlerepository= new $repositoryName($this->dB);

        /* analyse de la page demandée et création des variables */
        $this->title= $control . " - " . $action;
        
        $controlName=   $control . "Controller";
        //inclusion dynamique
        require("pages/" . $controlName . ".php");
        //instantiation dynamique
        $controller= new $controlName($articlerepository);
            
        $action.= "Action";
        if( method_exists($controller, $action) ) {
            $pageInclue=    'DEPRECATED';
            $this->content=  $controller->$action();
        }
    }
    
    public function renderResponse() {
        // le header contient le début de la page jusqu'à la balise <body>
        $titre= $this->title;
        include("blocs/header.php");

        // le menu est composé de la balise <nav> et de ses items
        include("blocs/menu.php");

        /* début corps de page */

        // on affiche les messages éventuels
        showMessages();

        // on affiche le contenu principal de la page
        echo $this->content;

        /* fin corps de page */

        // on affiche le footer et on ferme la page html
        include("blocs/footer.php");

    }
}
