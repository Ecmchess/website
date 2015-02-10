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
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"menu" = "Menu", "submenu" = "SubMenu"})
 */
class Menu extends ContainerAware
{

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, unique=true)
     */
    protected $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="glyphicon", type="string", length=255, nullable=true)
     */
    protected $glyphicon;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="ECM\Bundle\ArticleBundle\Entity\Article", mappedBy="menu", cascade={"remove"})
     */
    private $articles;

    /**
     * @var integer
     * @ORM\OneToMany(targetEntity="ECM\Bundle\ModuleBundle\Entity\SubMenu", mappedBy="parent", cascade={"remove"})
     */
    private $enfants;


    public function __construct(){
        $this->articles = new ArrayCollection();
        $this->enfants = new ArrayCollection();
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


    public function __toString()
    {
        return $this->titre;
    }


    /**
     * Add enfants
     *
     * @param \ECM\Bundle\ModuleBundle\Entity\SubMenu $enfants
     * @return Menu
     */
    public function addEnfant(\ECM\Bundle\ModuleBundle\Entity\SubMenu $enfants)
    {
        $this->enfants[] = $enfants;
    
        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \ECM\Bundle\ModuleBundle\Entity\SubMenu $enfants
     */
    public function removeEnfant(\ECM\Bundle\ModuleBundle\Entity\SubMenu $enfants)
    {
        $this->enfants->removeElement($enfants);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }
}