<?php

namespace ECM\Bundle\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Publication
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\Entity(repositoryClass="ECM\Bundle\ArticleBundle\Entity\PublicationRepository")
 * @ORM\DiscriminatorMap({"article" = "Article", "publication" = "Publication"})
 */
class Publication extends ContainerAware
{
    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    public $etat;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text")
     *
     */
    protected $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="corps", type="text")
     */
    protected $corps;

    /**
     * @var string
     *
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\ModuleBundle\Entity\Menu", inversedBy="articles", cascade={"persist"})
     * @ORM\JoinColumn(name="menu_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $menu;

    /**
     *
     * @var date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    public function __construct()
    {
        $this->date = new \Datetime();
        $this->etat = 2;
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
     * @return Publication
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
     * @return Publication
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Publication
     */
    public function setDate($date)
    {
        $this->date = $date;

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
     * @return Publication
     */
    public function setMenu(\ECM\Bundle\ModuleBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }


}