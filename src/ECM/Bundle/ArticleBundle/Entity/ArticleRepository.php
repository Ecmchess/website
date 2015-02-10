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

    public function getArticlesByMenu(String $menu)
    {
        $query = 'SELECT a, m FROM ECMArticleBundle:Article a JOIN a.menu m';
        $this->_em->createQuery()->getResult();
    }

    public function getArticlesByMenuAccepte($menu)
    {
        //$query = 'SELECT a, m FROM ECMArticleBundle:Article a JOIN a.menu m WHERE a.accepte = 1 and a.menu = :menu';
        //return $this->_em->createQuery($query)->setParameter('menu', $menu)->getResult();

        $query = $this->_em->createQueryBuilder('a')
            ->select('a')
            ->from('ECMArticleBundle:Article', 'a')
            ->where('a.menu = :menu')
            ->andWhere('a.accepte = 1')
            ->setParameter('menu', $menu)
            ->getQuery();

        return $query->getResult();

    }

}
