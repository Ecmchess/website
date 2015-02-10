<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ECM\Bundle\ArticleBundle\Entity;
/**
 * Description of ArticleEtat
 *
 * @author lacombes
 */
abstract class ArticleEtat
{
    public function valider($article)
    {
    }

    public function refuser($article)
    {
    }

    public function editer($article)
    {
    }
}
