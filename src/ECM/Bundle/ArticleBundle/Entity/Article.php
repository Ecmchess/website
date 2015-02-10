<?php

namespace ECM\Bundle\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;
//use ECM\Bundle\ArticleBundle\Entity\ArticleEtat;
use Symfony\Component\DependencyInjection\ContainerAware;
/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ArticleBundle\Entity\ArticleRepository")
 */
class Article extends ContainerAware implements RouteReferrersReadInterface{

    private $user;
    protected $routes;
    
    /**
     * @var ArticleEtat
     */
    private $etatArticle;
   

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

    /**
     * @var int
     *
     * @ORM\Column(name="accepte", type="integer")
     */
    public $accepte;

    /**
     * @var int
     *
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\UserBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="auteur_id", referencedColumnName="id")
     */
    private $auteur;

    /**
     * Get auteur
     *
     * @return \ECM\Bundle\UserBundle\Entity\User
     */
    public function getAuteur() {
        return $this->auteur;
    }
 

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
     * Get accepte
     *
     * @return ArticleEtat
     */
    public function getAccepte() {
        switch ($this->accepte) {
            case 1:
                $this->etatArticle = new ArticleEnAttenteDeValidation();
                break;
            case 2:
                $this->etatArticle = new ArticleValide();
                break;
            case 3:
                $this->etatArticle = new ArticleRefuse();
                break;

            default:
                $this->etatArticle = new ArticleEnAttenteDeValidation();
                break;
        }
        return $this->accepte;
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
    public function setAuteur($auteur){
        $this->auteur=$auteur;
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
    public function setMenu(\ECM\Bundle\ModuleBundle\Entity\Menu $menu = null) {
        $this->menu = $menu;

        return $this;
    }

    public function setArticleState($ArticleEtat_In) {
        $this->etatArticle = $ArticleEtat_In;
    }

    public function valider() {
        $this->etatArticle->valider($this);
        $this->accepte = 2;
    }

    public function refuser() {
        $this->etatArticle->refuser($this);
        $this->accepte = 3;
    }

    public function editer() {
        $this->etatArticle->editer($this);
        $this->accepte = 1;
    }

    public function getArticleEtat() {
        return $this->etatArticle;
    }

    public function __construct() {
        //$this->accepte = FALSE;
        //$this->accepte = new ArticleEnAttenteDeValidation();
        $this->etatArticle = new ArticleEnAttenteDeValidation();
        $this->accepte = 1;
        //$this->auteur = $this->container->get('security.context')->getToken()->getUser()->getId();
        
    }
    

}
