<?php

namespace Asso\UserBundle\Entity;

use Asso\AMBundle\Entity\Asso;
use FOS\UserBundle\Entity\User as FOSUser;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Asso\UserBundle\Manager\UserManager")
 * @ORM\Table(name="ass_user")
 */
class User extends FOSUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Asso\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="ass_user_group")
     */
    protected $groups;

    /**
     * @ORM\ManyToMany(targetEntity="Asso\AMBundle\Entity\Asso", mappedBy="users")
     */
    protected $assos;


    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->assos  = new ArrayCollection();

        parent::__construct();
    }


    public function __toString()
    {
        return $this->getUsername();
    }


    public function getAssos()
    {
        return $this->assos;
    }
    public function addAsso(Asso $asso)
    {
        $this->assos[] = $asso;
    }
}