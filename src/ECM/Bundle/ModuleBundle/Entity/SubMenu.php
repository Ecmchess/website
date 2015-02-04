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
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="ECM\Bundle\ModuleBundle\Entity\Menu", cascade={"remove"})
     * @ORM\JoinColumn(name="menu_parent_id", referencedColumnName="id")
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
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set parent
     *
     * @param string $parent
     * @return SubMenu
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
