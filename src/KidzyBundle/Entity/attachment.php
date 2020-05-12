<?php


namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * attachment
 *
 * @ORM\Table(name="attachment", indexes={@ORM\Index(name="foreign_enfant", columns={"id_enfant"})})
 * @ORM\Entity
 *
 *
 */
class attachment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_attachement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Enfant", inversedBy="attachments")
     * @ORM\JoinColumn(name="id_enfant", referencedColumnName="id_enfant")
     */
    private $idEnfant;

    /**
     * Filename of the asset
     * @ORM\Column(length=40, nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    private $fileName;

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }


    /**
     * Set idEnfant
     *
     * @param \KidzyBundle\Entity\Enfant $idEnfant
     *
     * @return attachment
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
}