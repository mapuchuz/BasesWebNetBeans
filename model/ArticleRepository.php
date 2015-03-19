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
    
    
}
