<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * ArticleRepository handles transactions with database
 *
 * @author vd
 */
require("model/Article.php");

class ArticleRepository {
    /**
     * return a BO Article
     * @param type int $id of an Article
     * @return mixed $article or null
     */
    
    private $db; //passé dans le constructeur; instancié à l'extérieur
    
    public function __construct($db) {
        $this->db=  $db;
    }

    public function get($id) {
        // on forge la requete SQL
        $sql = "SELECT * FROM article WHERE id=".$id;

        // on passe la requete SQL à PDO
        $statement = $this->db->query($sql);

        // on récupère le premier (et unique) résultat de la requete
        // si on a un article on l'affiche
        $statement->setFetchMode(PDO::FETCH_CLASS, "Article");
        $article = $statement->fetch();
    
        return $article;
    }
    
    public function getAll() {
        // on forge la requete SQL
        $sql = "SELECT * FROM article";

        // on passe la requete SQL à PDO
        $statement = $this->db->query($sql);

        // on récupère le premier (et unique) résultat de la requete
        // si on a un article on l'affiche
        $statement->setFetchMode(PDO::FETCH_CLASS, "Article");
 
        return $statement->fetchAll();
    }
    
    public function delete($id) {
        	// si on a un id (GET ou POST), on déclenche la suppression
	$sql = "DELETE FROM article WHERE id=".$id;

	// requete préparée PDO
	return $this->db->exec($sql);
    }
    
    /**
     * ajoute un article dans dB
     * si $article->iid<=0 , il y a création de nouveau article
     * @param type $article
     * @return type
     */
    public function addOrUpdate(Article $article) {
       	// si on a un id (GET ou POST), on fait une mise à jour
	$id=    $article->id;
        if ($id>0)
		$sql = "UPDATE article SET title=:title, content=:content WHERE id=".$id;
	// sinon on insère un nouvel enregistrement
	else
		$sql = "INSERT INTO article (title, content) VALUES (:title, :content)";

	// requete préparée PDO
	$statement = $this->db->prepare($sql);
	$statement->bindParam(":title",    $article->getTitle());
	$statement->bindParam(":content",  $article->getContent());

	return $statement->execute();	
    }

    
    
}
