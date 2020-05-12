<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FraisFacture
 *
 * @ORM\Table(name="frais_facture", indexes={@ORM\Index(name="fk_id_facture", columns={"id_facture"}), @ORM\Index(name="fk_id_frais", columns={"id_frais"})})
 * @ORM\Entity
 */
class FraisFacture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_facture", referencedColumnName="id_facture")
     * })
     */
    private $idFacture;

    /**
     * @var \Frais
     *
     * @ORM\ManyToOne(targetEntity="Frais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frais", referencedColumnName="id_frais")
     * })
     */
    private $idFrais;



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
     * Set idFacture
     *
     * @param \KidzyBundle\Entity\Facture $idFacture
     *
     * @return FraisFacture
     */
    public function setIdFacture(\KidzyBundle\Entity\Facture $idFacture = null)
    {
        $this->idFacture = $idFacture;

        return $this;
    }

    /**
     * Get idFacture
     *
     * @return \KidzyBundle\Entity\Facture
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * Set idFrais
     *
     * @param \KidzyBundle\Entity\Frais $idFrais
     *
     * @return FraisFacture
     */
    public function setIdFrais(\KidzyBundle\Entity\Frais $idFrais = null)
    {
        $this->idFrais = $idFrais;

        return $this;
    }

    /**
     * Get idFrais
     *
     * @return \KidzyBundle\Entity\Frais
     */
    public function getIdFrais()
    {
        return $this->idFrais;
    }
}
