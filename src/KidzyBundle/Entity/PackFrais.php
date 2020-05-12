<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * PackFrais
 *
 * @ORM\Table(name="pack_frais", indexes={@ORM\Index(name="fk_id_pack", columns={"id_pack"}), @ORM\Index(name="fk_id_frais_pack", columns={"id_frais"})})
 * @ORM\Entity
 */
class PackFrais implements JsonSerializable
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
     * @var \Frais
     *
     * @ORM\ManyToOne(targetEntity="Frais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_frais", referencedColumnName="id_frais")
     * })
     */
    private $idFrais;

    /**
     * @var \Pack
     *
     * @ORM\ManyToOne(targetEntity="Pack")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pack", referencedColumnName="id_pack")
     * })
     */
    private $idPack;



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
     * Set idFrais
     *
     * @param \KidzyBundle\Entity\Frais $idFrais
     *
     * @return PackFrais
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

    /**
     * Set idPack
     *
     * @param \KidzyBundle\Entity\Pack $idPack
     *
     * @return PackFrais
     */
    public function setIdPack(\KidzyBundle\Entity\Pack $idPack = null)
    {
        $this->idPack = $idPack;

        return $this;
    }

    /**
     * Get idPack
     *
     * @return \KidzyBundle\Entity\Pack
     */
    public function getIdPack()
    {
        return $this->idPack;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return
            [
                'idpack'   => $this->getIdPack(),
                'idfrais' => $this->getIdFrais()
            ];
    }
}
