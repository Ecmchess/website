<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ECM\Bundle\ArticleBundle\Entity;
/**
 * Description of ArticleEnAttenteDeValidation
 *
 * @author lacombes
 */
class ArticleEnAttenteDeValidation extends ArticleEtat
{


    public function refuser($article)
    {
        $article->accepte = new ArticleRefuse();
        //TODO mail auteur
    }

    public function valider($article)
    {
        $article->accepte = new ArticleValide();
    }

    public function __toString()
    {
        return 'En attente de validation';
    }
}
