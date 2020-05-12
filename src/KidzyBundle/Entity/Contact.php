<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact", indexes={@ORM\Index(name="fk_id_pe", columns={"id"})})
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ct", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ct", type="date", nullable=false)
     */
    private $dateCt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat_ct", type="boolean", nullable=false)
     */
    private $etatCt;

    /**
     * @var string
     *
     * @ORM\Column(name="description_ct", type="string", length=600, nullable=false)
     */
    private $descriptionCt;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_ct", type="string", length=600, nullable=false)
     */
    private $reponseCt;

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
     * Get idCt
     *
     * @return integer
     */
    public function getIdCt()
    {
        return $this->idCt;
    }

    /**
     * Set dateCt
     *
     * @param \DateTime $dateCt
     *
     * @return Contact
     */
    public function setDateCt($dateCt)
    {
        $this->dateCt = $dateCt;

        return $this;
    }

    /**
     * Get dateCt
     *
     * @return \DateTime
     */
    public function getDateCt()
    {
        return $this->dateCt;
    }

    /**
     * Set etatCt
     *
     * @param boolean $etatCt
     *
     * @return Contact
     */
    public function setEtatCt($etatCt)
    {
        $this->etatCt = $etatCt;

        return $this;
    }

    /**
     * Get etatCt
     *
     * @return boolean
     */
    public function getEtatCt()
    {
        return $this->etatCt;
    }

    /**
     * Set descriptionCt
     *
     * @param string $descriptionCt
     *
     * @return Contact
     */
    public function setDescriptionCt($descriptionCt)
    {
        $this->descriptionCt = $descriptionCt;

        return $this;
    }

    /**
     * Get descriptionCt
     *
     * @return string
     */
    public function getDescriptionCt()
    {
        return $this->descriptionCt;
    }

    /**
     * Set reponseCt
     *
     * @param string $reponseCt
     *
     * @return Contact
     */
    public function setReponseCt($reponseCt)
    {
        $this->reponseCt = $reponseCt;

        return $this;
    }

    /**
     * Get reponseCt
     *
     * @return string
     */
    public function getReponseCt()
    {
        return $this->reponseCt;
    }

    /**
     * Set id
     *
     * @param \KidzyBundle\Entity\User $id
     *
     * @return Contact
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
