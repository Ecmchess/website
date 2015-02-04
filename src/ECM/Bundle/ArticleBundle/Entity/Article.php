<?php

namespace ECM\Bundle\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ArticleBundle\Entity\ArticleRepository")
 */
class Article implements RouteReferrersReadInterface
{
    protected $routes;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text")
     *
     */
    private $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="corps", type="text")
     */
    private $corps;
    /**
     * @var string
     *
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\ModuleBundle\Entity\Menu", inversedBy="articles", cascade={"persist"})
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     */
    private $menu;

    public function getRoutes()
    {
        return $this->routes;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string
     */
    public function getCorps()
    {
        return $this->corps;
    }

    /**
     * Set corps
     *
     * @param string $corps
     * @return Article
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \ECM\Bundle\ModuleBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set menu
     *
     * @param \ECM\Bundle\ModuleBundle\Entity\Menu $menu
     * @return Article
     */
    public function setMenu(\ECM\Bundle\ModuleBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }



}