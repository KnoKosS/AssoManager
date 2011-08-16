<?php

namespace Asso\BookBundle\Entity;

use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Asso\BookBundle\Entity\CategoryRepository")
 * @ORM\Table(name="ass_book_category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Asso\AMBundle\Entity\Asso")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $wrap;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     */
    protected $name;


    /**
     * Dump the name
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get wrap
     */
    public function getWrap()
    {
        return $this->wrap;
    }
    /**
     * Set wrap
     * @param Asso $wrap
     */
    public function setWrap(\Asso\AMBundle\Entity\Asso $wrap)
    {
        $this->wrap = $wrap;
    }

    /**
     * Get name
	 * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set name
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}