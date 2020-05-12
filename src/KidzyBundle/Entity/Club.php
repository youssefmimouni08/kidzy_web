<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Club
 *
 * @ORM\Table(name="Club")
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\inscriptionRepository")
 */
class Club
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_club", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClub;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClub", type="string", length=20, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le Nom doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "Le nom doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank(message="le champ nom est obligatoire")
     */
    private $nomClub;

    /**
     * @ORM\Column(name="descriptionClub",type="string",length=255)
     * @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $descriptionClub;



    /**
     * @return int
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * @param int $idClub
     */
    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;
    }

    /**
     * @return string
     */
    public function getNomClub()
    {
        return $this->nomClub;
    }

    /**
     * @param string $nomClub
     */
    public function setNomClub($nomClub)
    {
        $this->nomClub = $nomClub;
    }

    /**
     * @return mixed
     */
    public function getDescriptionClub()
    {
        return $this->descriptionClub;
    }

    /**
     * @param mixed $descriptionClub
     */
    public function setDescriptionClub($descriptionClub)
    {
        $this->descriptionClub = $descriptionClub;
    }

    /**
     * @return mixed
     */
    public function getAdresseClub()
    {
        return $this->adresseClub;
    }

    /**
     * @param mixed $adresseClub
     */
    public function setAdresseClub($adresseClub)
    {
        $this->adresseClub = $adresseClub;
    }
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank(message="le champ adresse est obligatoire")
     */
    private $adresseClub;
}