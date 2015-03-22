<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleController
 *
 * @author hb
 */
class ArticleController {
    //put your code here
    private $repo;
    
    public function __construct($repo) {
        $this->repo=    $repo;
    }
    
    public function listAction() {
            // on demande tous les articles
        $articles=  $this->repo->getAll();
        $html=  '';    
        if($articles!=null) {
            $nbRows = count($articles);

            // on affiche l'article 
            $html=  '<h2>Liste des TOUS les articles (' . (int)$nbRows . ')</h2>';
            $html.= '<ul>';
            foreach ($articles as $article) { 
                $html.= '<li id="' . $article->id . '">';
                $html.= '-<a href="index.php?page=article_read&id=' . $article->id . '">' . $article->getTitle() . '</a>';
                $html.= '-<a href="index.php?page=article_edit&id=' . $article->id . '">edit</a>';
                $html.= '-<a href="index.php?page=article_delete&id=' . $article->id . '">delete</a>';
                $html.= '</li>';
            }
            $html.=  '</ul>';
        // sinon on affiche un message d'erreur
        } else {
                $html=  '<h2>Aucun article avec cet identifiant.</h2>';
        }
        $html.= '<p><a href="index.php?page=article_add">Ajouter un article</a></p>';
        return $html;
    }
    
    public function readAction() {
        // on récupère l'id de l'article à travers la var GET
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $article=   $repo->get( $id );
        $html=  '';
        if($article!=null) {
            // on affiche l'article 
            $html.= '<h2>Lecture dE un article</h2>';
            $html.= '<article    id=' . $article->id . '>';
            $html.= '<h1>' . $article->getTitle() . '</h1>';
            $html.= '<p>' . nl2br($article->getContent()) . '</p>';
            $html.= '</article>';
        // sinon on affiche un message d'erreur
        } else {
                $html.= '<h2>Aucun article avec cet identifiant.</h2>';
        }
    }
}
