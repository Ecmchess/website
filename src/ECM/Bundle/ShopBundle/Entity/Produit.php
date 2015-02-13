<?php

namespace ECM\Bundle\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * Produit
 *
 * @ORM\Table(name="Produit")
 * @ORM\Entity(repositoryClass="ECM\Bundle\ShopBundle\Entity\ProduitRepository")
 */
class Produit
{
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     * @Assert\Range(min=0)
     */
    private $prix;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\ShopBundle\Entity\Categorie", inversedBy="produits")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     * @var
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\ModuleBundle\Entity\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

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
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \ECM\Bundle\ShopBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set categorie
     *
     * @param \ECM\Bundle\ShopBundle\Entity\Categorie $categorie
     * @return Produit
     */
    public function setCategorie(\ECM\Bundle\ShopBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get image
     *
     * @return \ECM\Bundle\ModuleBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param \ECM\Bundle\ModuleBundle\Entity\Image $image
     * @return Produit
     */
    public function setImage(\ECM\Bundle\ModuleBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }
}