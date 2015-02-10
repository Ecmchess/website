<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ECM\Bundle\ArticleBundle\Entity;
/**
 * Description of ArticleValide
 *
 * @author lacombes
 */
class ArticleValide extends ArticleEtat{
    public function editer($article) {
        $article->accepte = new ArticleEnAttenteDeValidation();
    }
    public function __toString() {
        return 'Validé';
    }
}
