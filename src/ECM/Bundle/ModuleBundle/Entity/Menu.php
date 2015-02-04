<?php

namespace ECM\Bundle\ModuleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Menu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ModuleBundle\Entity\MenuRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="menu_parent_id")
 * @ORM\DiscriminatorMap({"menu" = "Menu", "submenu" = "SubMenu"})
 */
class Menu extends ContainerAware{
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;



    /**
     * @var string
     *
     * @ORM\Column(name="glyphicon", type="string", length=255, nullable=true)
     */
    private $glyphicon;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="ECM\Bundle\ArticleBundle\Entity\Article", mappedBy="menu", cascade={"remove"})
     */
    private $articles;

    /*
     * @var integer
     *
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\ModuleBundle\Entity\Menu", cascade={"remove"})
     * @ORM\JoinColumn(name="menu_parent_id", referencedColumnName="id")
     */
//    private $parent;


    public function __construct(){
        $this->articles = new ArrayCollection();
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
     * @return Menu
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get glyphicon
     *
     * @return string
     */
    public function getGlyphicon()
    {
        return $this->glyphicon;
    }

    /**
     * Set glyphicon
     *
     * @param string $glyphicon
     * @return Menu
     */
    public function setGlyphicon($glyphicon)
    {
        $this->glyphicon = $glyphicon;

        return $this;
    }

    /**
     * Add articles
     *
     * @param \ECM\Bundle\ArticleBundle\Entity\Article $articles
     * @return Menu
     */
    public function addArticle(\ECM\Bundle\ArticleBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
    
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \ECM\Bundle\ArticleBundle\Entity\Article $articles
     */
    public function removeArticle(\ECM\Bundle\ArticleBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set parent
     *
     * @param \ECM\Bundle\ModuleBundle\Entity\Menu $parent
     * @return Menu
     */
    public function setParent(\ECM\Bundle\ModuleBundle\Entity\Menu $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \ECM\Bundle\ModuleBundle\Entity\Menu 
     */
    public function getParent()
    {
        return $this->parent;
    }
}