<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;


/**
 * @UniqueEntity(fields={"titre"},errorPath="titre",message="Il semble que vous avez déjà enregistré un frais avec ce titre.")
 * Frais
 *
 * @ORM\Table(name="frais")
 * @ORM\Entity
 */
class Frais implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_frais", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFrais;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le Titre doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "Le Titre doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank
     *
     */
    private $titre;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank
     */
    private $prix;





    /**
     * Get idFrais
     *
     * @return integer
     */
    public function getIdFrais()
    {
        return $this->idFrais;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Frais
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Frais
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    public function __toString()
    {
        return $this->titre . ' - ' . $this->prix . ' DT';
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return
            [
                'idfrais'   => $this->getIdFrais(),
                'titre' => $this->getTitre(),
                'prix_frais' => $this->getPrix()
            ];
    }


}
