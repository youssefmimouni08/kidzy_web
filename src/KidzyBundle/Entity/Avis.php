<?php

namespace KidzyBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="fk_id_peer", columns={"id"})})
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\avisRepository")
 *
 *
 */
class Avis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_avis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAvis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_avis", type="date", nullable=false)
     */
    private $dateAvis;

    /**
     * @var string
     *
     * @ORM\Column(name="description_avis", type="string", length=600, nullable=false)
     * @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $descriptionAvis;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="avis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */


    private $id;

    /**
     * @return \User
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \User $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * Get idAvis
     *
     * @return integer
     */
    public function getIdAvis()
    {
        return $this->idAvis;
    }

    /**
     * Set dateAvis
     *
     * @param \DateTime $dateAvis
     *
     * @return Avis
     */
    public function setDateAvis($dateAvis)
    {
        $this->dateAvis = $dateAvis;

        return $this;
    }

    /**
     * Get dateAvis
     *
     * @return \DateTime
     */
    public function getDateAvis()
    {
        return $this->dateAvis;
    }

    /**
     * Set descriptionAvis
     *
     * @param string $descriptionAvis
     *
     * @return Avis
     */
    public function setDescriptionAvis($descriptionAvis)
    {
        $this->descriptionAvis = $descriptionAvis;

        return $this;
    }

    /**
     * Get descriptionAvis
     *
     * @return string
     */
    public function getDescriptionAvis()
    {
        return $this->descriptionAvis;
    }


}
