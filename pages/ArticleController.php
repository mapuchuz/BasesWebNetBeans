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
 //       if($articles!=null) {
            $nbRows = count($articles);
            $view=  new View("article.index", array("articles" => $articles));
//        }
        return $view->gethtml();    
    }
    
    public function readAction() {
        // on récupère l'id de l'article à travers la var GET
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        //on demande l'article au repo
        $article=   $this->repo->get( $id );
        
        $view=  new View("article.read", array("article" => $article));

        return $view->getHtml();
    }
    
    /**
     * supprimer un Article
     * 
     * @return string
     */
    /*
     * PROBLEME 1:  Le Form action="index.php?page=article_delete"
     *              comment se débarrasse de article_delete.php ? 
     * PROBLEME 2:  Je peux afficher un SEUL  
     *              des boutons Confirmer et Annuler
     *              c'est le dernier dans le code qui est affiché
    */
    public function deleteAction() {
        // on regarde si un ID a été fourni
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // on regarde si un formulaire a été soumis
        if (isset($_POST['confirmer'])) {

                // on regarde si un id est passé dans le formulaire, si oui il est prioritaire
                if (isset($_POST['id'])&&$_POST['id']>0)
                        $id = (int)$_POST['id'];

                $result=    $this->repo->delete($id);
                // on valide et on redirige
                addMessageRedirect(0,"valid",$result . " article a été supprimé.");
        }
        // on regarde si notre formulaire a été annulé
        else if (isset($_POST['annuler'])) {
                // on ne fait rien et on redirige
                addMessageRedirect(0,"info","La suppression a été annulée.");
        }

        // si on est jusqu'ici, il n'y a pas eu de redirection
        // il faut donc générer un formulaire
        // mais d'abord, regardons si on a un article correspondant à l'identifiant demandé
        if ($id>0) {    
                $article=   $this->repo->get($id);
                if ($article!=null) {
                } else {
                        addMessageRedirect(0,"error","Aucun article trouvé avec cet identifiant.");
                }
        }

        $view=  new View("article.delete", array("article" => $article, "id" => $id));    
    
        return $view->getHtml();
    }
    
    public function editAction() {
        // on regarde si un ID a été fourni
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $article=   null;    
        // on regarde si un formulaire a été soumis
        if (isset($_POST['submit'])) {

                // on regarde si un id est passé dans le formulaire, si oui il est prioritaire
                if (isset($_POST['id'])&&$_POST['id']>0)
                        $id = (int)$_POST['id'];

                $article=   new Article();
                $article->renseigner($id, $_POST['title'], $_POST['content']);
                $this->repo->addOrUpdate($article);

                // on valide et on redirige
                addMessageRedirect(0,"valid","Votre article a bien été inséré");

        } 

        // si on est jusqu'ici, il n'y a pas eu de redirection
        // il faut donc générer un formulaire
        // mais d'abord, regardons si on a un article correspondant à l'identifiant demandé
        if ($id>0) {
                $article=   $this->repo->get($id);
                if ($article!=null) {
                        // notre article est pret à etre utilisé
                } else {
                        addMessageRedirect(0,"error","Aucun article trouvé avec cet identifiant.");
                }
        }

        $view=  new View("article.edit", array("article" => $article, "id" => $id));    
    
        return $view->getHtml();
    }
    
}
