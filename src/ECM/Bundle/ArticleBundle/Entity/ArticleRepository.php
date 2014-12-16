<?php

namespace ECM\Bundle\ArticleBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class ArticleRepository extends EntityRepository
{

    public function getArticlesByMenu(String $menu){
        $query = 'SELECT a, m FROM ECMArticleBundle:Article a JOIN a.menu m';
        $this->_em->createQuery()->getResult();
    }

}
