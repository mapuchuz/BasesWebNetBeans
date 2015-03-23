<?php

    /**
     * point d'entrée du site web
     * 
     * @author: vd
     */
    require("includes/all.php");
    
    //la db est instanciée dans all.php
    $app=   new Application($db);
    
    //les requêtre de l'utilisateur
    $app->handleRequest();
    
    //affichage des réponses aux requêtes
    $app->renderResponse();


   