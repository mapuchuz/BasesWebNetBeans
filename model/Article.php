<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Article is a class to handle BO articles
 *
 * @author vd
 */
class Article {
    //put your code here
    
    public $id;
    private $title;
    private $content;
    /**
     * Renvoi le titre de l'article
     * @return type
     */
    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }
    
    public function afficher() {
        echo $this->title . "," . $this->content . "<br />";
    }
    
    /**
     * remplit les champs de Article avec les arguments données
     * w
     * @param type $id
     * @param type $title
     * @param type $content
     */
    public function renseigner($id, $title, $content) {
        $this->id=       $id;
        $this->title=    $title;
        $this->content=  $content;
    }
    
    
}
