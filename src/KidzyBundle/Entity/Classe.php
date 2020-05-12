<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity
 */
class Classe implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_classe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasse;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_cla", type="string", length=255, nullable=false)
     */
    private $libelleCla;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="KidzyBundle\Entity\Enfant", mappedBy="idClasse")
     */
    private $enfants;

    /**
     * Classe constructor.
     */
    public function __construct()
    {
        $this->enfants =  new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get idClasse
     *
     * @return integer
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * Set libelleCla
     *
     * @param string $libelleCla
     *
     * @return Classe
     */
    public function setLibelleCla($libelleCla)
    {
        $this->libelleCla = $libelleCla;

        return $this;
    }

    /**
     * Get libelleCla
     *
     * @return string
     */
    public function getLibelleCla()
    {
        return $this->libelleCla;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Classe
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
     * Add enfant
     *
     * @param \KidzyBundle\Entity\Enfant $enfant
     *
     * @return Classe
     */
    public function addEnfant(\KidzyBundle\Entity\Enfant $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \KidzyBundle\Entity\Enfant $enfant
     */
    public function removeEnfant(\KidzyBundle\Entity\Enfant $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfant()
    {
        return $this->enfants;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return
            [
                'id'   => $this->getIdClasse(),
                'libelle' => $this->getLibelleCla(),
                'desctiption' => $this->getDescription()
            ];
    }
}
