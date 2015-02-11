<?php

namespace ECM\Bundle\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;

//use ECM\Bundle\ArticleBundle\Entity\ArticleEtat;
/**
 * Publication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ArticleBundle\Entity\PublicationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article extends Publication
{

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    public $etat;

//    /**
//     * @var ArticleEtat
//     */
//    private $etatArticle;


    /**
     * @var string
     *
     * @ORM\Column(name="motif", type="text", nullable=true)
     *
     */
    private $motif;

    /**
     * @var int
     *
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\UserBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="auteur_id", referencedColumnName="id")
     */
    private $auteur;

    public function __construct()
    {
        //$this->etat = FALSE;
        //$this->etat = new ArticleEnAttenteDeValidation();
//        $this->etatArticle = new ArticleEnAttenteDeValidation();
        $this->etat = 1;
        $this->date = new \DateTime();
        //$this->auteur = $this->container->get('security.context')->getToken()->getUser()->getId();

    }

    /**
     * Get auteur
     *
     * @return \ECM\Bundle\UserBundle\Entity\User
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }




    /**
     * Get etat
     *
     * @return ArticleEtat
     */
    public function getEtat()
    {
//        switch ($this->etat) {
//            case 1:
//                $this->etatArticle = new ArticleEnAttenteDeValidation();
//                break;
//            case 2:
//                $this->etatArticle = new ArticleValide();
//                break;
//            case 3:
//                $this->etatArticle = new ArticleRefuse();
//                break;
//
//            default:
//                $this->etatArticle = new ArticleEnAttenteDeValidation();
//                break;
//        }
        return $this->etat;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Article
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNomEtat()
    {
        switch ($this->etat) {
            case 1:
                return "En attente de vérification";
            case 2:
                return "Accepté";
            case 3:
                return "Refusé";
            default:
                return "En attente de vérification";
        }
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

    public function setArticleState($ArticleEtat_In)
    {
        $this->etatArticle = $ArticleEtat_In;
    }

    public function valider()
    {
//        $this->etatArticle->valider($this);
        $this->etat = 2;
    }

    public function refuser()
    {
//        $this->etatArticle->refuser($this);
        $this->etat = 3;
    }

//    public function getArticleEtat()
//    {
//        return $this->etatArticle;
//    }

    public function editer()
    {
//        $this->etatArticle->editer($this);
        $this->etat = 1;
    }

    /**
     * Get motif
     *
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set motif
     *
     * @param string $motif
     * @return Article
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

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

    public function resetEtat()
    {
        $this->etat = 1;
    }

    public function estRefuse()
    {
        return $this->etat == 3;
    }

}