<?php

namespace ECM\Bundle\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubMenu
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ECM\Bundle\ModuleBundle\Entity\SubMenuRepository")
 */
class SubMenu extends Menu
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
     * @var
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="enfants")
     * @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     */
    private $parent;

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
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent
     *

     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }
}
