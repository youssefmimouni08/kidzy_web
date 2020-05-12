<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback", indexes={@ORM\Index(name="fk_id_enfant", columns={"id_enfant"}), @ORM\Index(name="fk_id_perso", columns={"id"})})
 * @ORM\Entity
 */
class Feedback
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fd", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFd;

    /**
     * @var string
     *
     * @ORM\Column(name="description_fd", type="string", length=255, nullable=false)
     */
    private $descriptionFd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat_fd", type="boolean", nullable=false)
     */
    private $etatFd;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_fd", type="string", length=255, nullable=false)
     */
    private $reponseFd;

    /**
     * @var \Enfant
     *
     * @ORM\ManyToOne(targetEntity="Enfant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_enfant", referencedColumnName="id_enfant")
     * })
     */
    private $idEnfant;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;



    /**
     * Get idFd
     *
     * @return integer
     */
    public function getIdFd()
    {
        return $this->idFd;
    }

    /**
     * Set descriptionFd
     *
     * @param string $descriptionFd
     *
     * @return Feedback
     */
    public function setDescriptionFd($descriptionFd)
    {
        $this->descriptionFd = $descriptionFd;

        return $this;
    }

    /**
     * Get descriptionFd
     *
     * @return string
     */
    public function getDescriptionFd()
    {
        return $this->descriptionFd;
    }

    /**
     * Set etatFd
     *
     * @param boolean $etatFd
     *
     * @return Feedback
     */
    public function setEtatFd($etatFd)
    {
        $this->etatFd = $etatFd;

        return $this;
    }

    /**
     * Get etatFd
     *
     * @return boolean
     */
    public function getEtatFd()
    {
        return $this->etatFd;
    }

    /**
     * Set reponseFd
     *
     * @param string $reponseFd
     *
     * @return Feedback
     */
    public function setReponseFd($reponseFd)
    {
        $this->reponseFd = $reponseFd;

        return $this;
    }

    /**
     * Get reponseFd
     *
     * @return string
     */
    public function getReponseFd()
    {
        return $this->reponseFd;
    }

    /**
     * Set idEnfant
     *
     * @param \KidzyBundle\Entity\Enfant $idEnfant
     *
     * @return Feedback
     */
    public function setIdEnfant(\KidzyBundle\Entity\Enfant $idEnfant = null)
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
     * Set id
     *
     * @param \KidzyBundle\Entity\User $id
     *
     * @return Feedback
     */
    public function setId(\KidzyBundle\Entity\User $id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \KidzyBundle\Entity\User
     */
    public function getId()
    {
        return $this->id;
    }
}
