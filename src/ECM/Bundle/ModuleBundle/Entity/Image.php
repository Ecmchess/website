<?php

namespace ECM\Bundle\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ModuleBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @var string
     *
     * @ORM\Column(name="urlImage", type="text", nullable=true)
     */
    private $urlImage;

    /**
     * @var file
     */
    private $image;

    /**
     * @var date
     *
     * @ORM\Column(name="updated", type="date", nullable=true)
     */
    private $updated;

    public function getUrlImage()
    {
        return $this->urlImage;
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
     * @return Image
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime("now"));
//        $this->urlImage = $this->image->getClientOriginalName();
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Sponsor
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage(UploadedFile $image = null)
    {
        $this->image = $image;
    }

    public function getAbsolutePath()
    {
        return null === $this->urlImage ? null : $this->getUploadRootDir() . '/' . $this->urlImage;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'images/uploads';
    }

    public function getWebPath()
    {
        return null === $this->urlImage ? null : $this->getUploadDir() . '/' . $this->urlImage;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
        if (null === $this->image) {
            return;
        }
        $this->urlImage = $this->image->getClientOriginalName();
        $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        $this->image = null;
    }


}
