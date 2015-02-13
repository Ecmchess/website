<?php

namespace ECM\Bundle\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Sponsor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ModuleBundle\Entity\SponsorRepository")
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Sponsor {

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
     * @ORM\Column(name="urlImage", type="text", nullable=true)
     */
    private $urlImage;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="text")
     */
    private $lien;

    /**
     * @var integer
     *
     *@Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;


    /**
     * @var date
     *
     * @ORM\Column(name="updated", type="date", nullable=true)
     */
    private $updated;

    /**
     * @var file
     *
     */

    private $image;



    public function getImage() {
        return $this->image;
    }

    public function setImage(UploadedFile $image = null) {
        $this->image = $image;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
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
     * @return Sponsor
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get urlImage
     *
     * @return string
     */
    public function getUrlImage()
    {
        return $this->urlImage;
    }

    /**
     * Set urlImage
     *
     * @param string $urlImage
     * @return Sponsor
     */
    public function setUrlImage($urlImage) {
        $this->urlImage = $urlImage;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Sponsor
     */
    public function setLien($lien) {
        $this->lien = $lien;

        return $this;
    }

    public function getAbsolutePath() {
        return null === $this->urlImage ? null : $this->getUploadRootDir() . '/' . $this->urlImage;
    }

    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'images/sponsors';
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
        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        $this->image = null;
    }

//    /**
//     * @ORM\PostRemove()
//     */
//    public function removeUpload()
//    {
//        if ($image = $this->getAbsolutePath()) {
//            unlink($image);
//        }
//    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function refreshUpdated() {
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

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Sponsor
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}