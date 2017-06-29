<?php

namespace PokedexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fiche
 *
 * @ORM\Table(name="fiche")
 * @ORM\Entity(repositoryClass="PokedexBundle\Repository\FicheRepository")
 */
class Fiche
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var array
     *
     * @ORM\Column(name="types", type="array")
     */
    private $types;

    /**
     * @ORM\OneToOne(targetEntity="PokedexBundle\Entity\Fiche")
     */
    private $evolution;

    /**
     * @ORM\OneToOne(targetEntity="PokedexBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\Column(name="nationalID", type="integer", unique=true)
     */
    private $nationalID;


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
     * Set name
     *
     * @param string $name
     * @return Fiche
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Fiche
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set types
     *
     * @param array $types
     * @return Fiche
     */
    public function setTypes($types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * Get types
     *
     * @return array 
     */
    public function getTypes()
    {
        return $this->types;
    }

   
    /**
     * @param Image|null $image
     */
    public function setImage(Image $image = null)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
    

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set evolution
     *
     * @param \PokedexBundle\Entity\Fiche $evolution
     * @return Fiche
     */
    public function setEvolution(\PokedexBundle\Entity\Fiche $evolution = null)
    {
        $this->evolution = $evolution;

        return $this;
    }

    /**
     * Get evolution
     *
     * @return \PokedexBundle\Entity\Fiche 
     */
    public function getEvolution()
    {
        return $this->evolution;
    }


    /**
     * Set nationalID
     *
     * @param integer $nationalID
     * @return Fiche
     */
    public function setNationalID($nationalID)
    {
        $this->nationalID = $nationalID;

        return $this;
    }

    /**
     * Get nationalID
     *
     * @return integer 
     */
    public function getNationalID()
    {
        return $this->nationalID;
    }
}
