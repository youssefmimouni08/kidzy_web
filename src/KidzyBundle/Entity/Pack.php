<?php

namespace KidzyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;

/**
 * @UniqueEntity(fields={"nomPack"},errorPath="nomPack",message="Il semble que vous avez déjà enregistré un Pack avec ce nom.")
 * Pack
 *
 * @ORM\Table(name="pack")
 * @ORM\Entity
 */
class Pack implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_pack", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPack;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_pack", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "Le nom doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank
     */
    private $nomPack;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_pack", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank
     */
    private $prixPack;
    /**
     * @var float
     *
     * @ORM\Column(name="prix_pack_year", type="float", precision=10, scale=0, nullable=true)
     *
     */
    private $prixPackyear;

    /**
     * @return float
     */
    public function getPrixPackyear()
    {
        return $this->prixPackyear;
    }

    /**
     * @param float $prixPackyear
     */
    public function setPrixPackyear($prixPackyear)
    {
        $this->prixPackyear = $prixPackyear;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description_pack", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le nom doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "Le nom doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank
     */
    private $descriptionPack;

    /**
     * @ORM\ManyToMany(targetEntity="Frais")
     * @ORM\JoinTable(name="frais_packs",
     *      joinColumns={@ORM\JoinColumn(name="pack_id", referencedColumnName="id_pack")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="frais_id", referencedColumnName="id_frais")}
     *      )
     */
    private $frais;

    /**
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="pack")
     */
    private $factures;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->frais = new \Doctrine\Common\Collections\ArrayCollection();
        $this->factures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prixPackyear = $this->prixPack;
    }

    /**
     * Get idPack
     *
     * @return integer
     */
    public function getIdPack()
    {
        return $this->idPack;
    }

    /**
     * Set nomPack
     *
     * @param string $nomPack
     *
     * @return Pack
     */
    public function setNomPack($nomPack)
    {
        $this->nomPack = $nomPack;

        return $this;
    }

    /**
     * Get nomPack
     *
     * @return string
     */
    public function getNomPack()
    {
        return $this->nomPack;
    }

    /**
     * Set prixPack
     *
     * @param float $prixPack
     *
     * @return Pack
     */
    public function setPrixPack($prixPack)
    {
        $this->prixPack = $prixPack;

        return $this;
    }

    /**
     * Get prixPack
     *
     * @return float
     */
    public function getPrixPack()
    {
        return $this->prixPack;
    }
    /**
     * Set descriptionPack
     *
     * @param string $descriptionPack
     *
     * @return Pack
     */
    public function setDescriptionPack($descriptionPack)
    {
        $this->descriptionPack = $descriptionPack;

        return $this;
    }

    /**
     * Get descriptionPack
     *
     * @return string
     */
    public function getDescriptionPack()
    {
        return $this->descriptionPack;
    }

    /**
     * Add frai
     *
     * @param \KidzyBundle\Entity\Frais $frai
     *
     * @return Pack
     */
    public function addFrai(\KidzyBundle\Entity\Frais $frai)
    {
        $this->frais[] = $frai;

        return $this;
    }

    /**
     * Remove frai
     *
     * @param \KidzyBundle\Entity\Frais $frai
     */
    public function removeFrai(\KidzyBundle\Entity\Frais $frai)
    {
        $this->frais->removeElement($frai);
    }

    /**
     * Get frais
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrais()
    {
        return $this->frais;
    }

    /**
     * Add facture
     *
     * @param \KidzyBundle\Entity\Facture $facture
     *
     * @return Pack
     */
    public function addFacture(\KidzyBundle\Entity\Facture $facture)
    {
        $this->factures[] = $facture;

        return $this;
    }

    /**
     * Remove facture
     *
     * @param \KidzyBundle\Entity\Facture $facture
     */
    public function removeFacture(\KidzyBundle\Entity\Facture $facture)
    {
        $this->factures->removeElement($facture);
    }

    /**
     * Get factures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFactures()
    {
        return $this->factures;
    }


    public function jsonSerialize()
    {
        return
            [
                'idpack'   => $this->getIdPack(),
                'nom_pack' => $this->getNomPack(),
                'prix_pack' => $this->getPrixPack(),
                'prix_pack_year' => $this->getPrixPackyear(),
                'description' => $this ->getDescriptionPack()
            ];
    }
}
