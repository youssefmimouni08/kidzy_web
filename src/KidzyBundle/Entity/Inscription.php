<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 * @ORM\Table(name="Inscription", indexes={@ORM\Index(name="fk_id_enff", columns={"id_enfant"}), @ORM\Index(name="id_club", columns={"id_club"})})
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\inscriptionRepository")
 */
class Inscription
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_inscrit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInscrit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscrit", type="date", nullable=true)
     */
    private $dateInscrit;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionInscrit", type="string", length=255, nullable=true)
     */
    private $descriptionInscrit;

    /**
     * @var \Enfant
     *
     *
     *
     * @ORM\OneToOne(targetEntity="Enfant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_enfant", referencedColumnName="id_enfant")
     * })
     */
    private $idEnfant;

    /**
     * @var \Club
     *
     *
     *
     * @ORM\OneToOne(targetEntity="Club")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_club", referencedColumnName="id_club")
     * })
     */
    private $idClub;

    /**
     * @return int
     */
    public function getIdInscrit()
    {
        return $this->idInscrit;
    }

    /**
     * @param int $idInscrit
     */







    public function setIdInscrit($idInscrit)
    {
        $this->idInscrit = $idInscrit;
    }

    /**
     * @return \DateTime
     */
    public function getDateInscrit()
    {
        return $this->dateInscrit;
    }

    /**
     * @param \DateTime $dateInscrit
     */
    public function setDateInscrit($dateInscrit)
    {
        $this->dateInscrit = $dateInscrit;
    }

    /**
     * @return string
     */
    public function getDescriptionInscrit()
    {
        return $this->descriptionInscrit;
    }

    /**
     * @param string $descriptionInscrit
     */
    public function setDescriptionInscrit($descriptionInscrit)
    {
        $this->descriptionInscrit = $descriptionInscrit;
    }

    /**
     * @return \Enfant
     */
    public function getIdEnfant()
    {
        return $this->idEnfant;
    }

    /**
     * @param \Enfant $idEnfant
     */
    public function setIdEnfant($idEnfant)
    {
        $this->idEnfant = $idEnfant;
    }

    /**
     * @return \Club
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * @param \Club $idClub
     */
    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;
    }





}
