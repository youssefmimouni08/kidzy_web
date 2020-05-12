<?php

namespace KidzyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_id_enff", columns={"id_enfant"}), @ORM\Index(name="id_event", columns={"id_event"})})
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\participationRepository")
 */
class Participation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_partici", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPartici;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_partici", type="date", nullable=true)
     */
    private $datePartici;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \Enfant
     *
     *
     * @ORM\OneToOne(targetEntity="Enfant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_enfant", referencedColumnName="id_enfant")
     * })
     */
    private $idEnfant;

    /**
     * @var \Event
     *
     *
     * @ORM\OneToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_event", referencedColumnName="id_event")
     * })
     */
    private $idEvent;



    /**
     * Set idPartici
     *
     * @param integer $idPartici
     *
     * @return Participation
     */
    public function setIdPartici($idPartici)
    {
        $this->idPartici = $idPartici;

        return $this;
    }

    /**
     * Get idPartici
     *
     * @return integer
     */
    public function getIdPartici()
    {
        return $this->idPartici;
    }

    /**
     * Set datePartici
     *
     * @param \DateTime $datePartici
     *
     * @return Participation
     */
    public function setDatePartici($datePartici)
    {
        $this->datePartici = $datePartici;

        return $this;
    }

    /**
     * Get datePartici
     *
     * @return \DateTime
     */
    public function getDatePartici()
    {
        return $this->datePartici;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Participation
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
     * Set idEnfant
     *
     * @param \KidzyBundle\Entity\Enfant $idEnfant
     *
     * @return Participation
     */
    public function setIdEnfant(\KidzyBundle\Entity\Enfant $idEnfant)
    {
        $this->idEnfant = $idEnfant;

        return $this;
    }

    /**
     * Get idEnfant
     *
     * @return \KidzyBundle\Entity\Enfant
     */
    public function getIdEnfant()
    {
        return $this->idEnfant;
    }

    /**
     * Set idEvent
     *
     * @param \KidzyBundle\Entity\Event $idEvent
     *
     * @return Participation
     */
    public function setIdEvent(\KidzyBundle\Entity\Event $idEvent)
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    /**
     * Get idEvent
     *
     * @return \KidzyBundle\Entity\Event
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }
}
