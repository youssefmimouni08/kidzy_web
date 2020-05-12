<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity
 */
class Matiere
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id__matiere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMatiere;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_matiere", type="string", length=255, nullable=false)
     */
    private $libelleMatiere;

    /**
     * @var string
     *
     * @ORM\Column(name="description_mat", type="string", length=255, nullable=false)
     */
    private $descriptionMat;



    /**
     * Get idMatiere
     *
     * @return integer
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * Set libelleMatiere
     *
     * @param string $libelleMatiere
     *
     * @return Matiere
     */
    public function setLibelleMatiere($libelleMatiere)
    {
        $this->libelleMatiere = $libelleMatiere;

        return $this;
    }

    /**
     * Get libelleMatiere
     *
     * @return string
     */
    public function getLibelleMatiere()
    {
        return $this->libelleMatiere;
    }

    /**
     * Set descriptionMat
     *
     * @param string $descriptionMat
     *
     * @return Matiere
     */
    public function setDescriptionMat($descriptionMat)
    {
        $this->descriptionMat = $descriptionMat;

        return $this;
    }

    /**
     * Get descriptionMat
     *
     * @return string
     */
    public function getDescriptionMat()
    {
        return $this->descriptionMat;
    }
}
