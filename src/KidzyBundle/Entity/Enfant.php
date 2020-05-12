<?php

namespace KidzyBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Enfant
 *
 * @ORM\Table(name="enfant", indexes={@ORM\Index(name="fk_id_p", columns={"id"}), @ORM\Index(name="fk_id_classe", columns={"id_classe"})})
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\inscriptionRepository")
 *
 *
 *
 * @Vich\Uploadable
 */
class Enfant implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_enfant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnfant;

    /**
     * @var string
     *  @Assert\Length(
     *  min = 3,
     *  max = 30,
     *  minMessage = "Le Titre doit contenir au moins {{ limit }} caractéres ",
     *  maxMessage = "Le Titre doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank
     *
     * @ORM\Column(name="nom_enfant", type="string", length=50, nullable=false)
     */
    private $nomEnfant;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_enfant", type="string", length=50, nullable=false)
     *  @Assert\Length(
     *  min = 3,
     *  max = 30,
     *  minMessage = "Le Titre doit contenir au moins {{ limit }} caractéres ",
     *  maxMessage = "Le Titre doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank
     */
    private $prenomEnfant;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     * @ORM\Column(name="image_enfant", type="string", length=255, nullable=false)
     */
    private $imageEnfant;

    /**
     *
     * @Vich\UploadableField(mapping="enfant_image", fileNameProperty="imageEnfant")
     *
     * @var File|null
     * @Assert\Image(
     *     mimeTypes= { "image/png" , "image/jpeg"  },
     *
     * )
     */
    private $imageFile;

    /**
     * @var string
     *  @Assert\NotBlank
     * @ORM\Column(name="dateN_enfant", type="string", length=255, nullable=false)
     */

    private $datenEnfant;

    /**
     * @var \Classe
     *
     * @Assert\NotBlank
     *
     * @ORM\ManyToOne(targetEntity="KidzyBundle\Entity\Classe", inversedBy="enfants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_classe", referencedColumnName="id_classe")
     * })
     */
    private $idClasse;

    /**
     * @var \Garde
     *
     * @ORM\ManyToOne(targetEntity="KidzyBundle\Entity\Garde", inversedBy="enfants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_garde",referencedColumnName="id_garde")
     * })
     */

    private $idGarde;

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
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="enfants")
     * @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     */
    private $idParent;


    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;


    /**
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="idEnf")
     */
    private $factures;
    /**
     * @ORM\OneToMany(targetEntity="attachment", mappedBy="idEnfant")
     */
    private $attachments;



    /**
     * Get idEnfant
     *
     * @return integer
     */
    public function getIdEnfant()
    {
        return $this->idEnfant;
    }

    /**
     * Set nomEnfant
     *
     * @param string $nomEnfant
     *
     * @return Enfant
     */
    public function setNomEnfant($nomEnfant)
    {
        $this->nomEnfant = $nomEnfant;

        return $this;
    }

    /**
     * Get nomEnfant
     *
     * @return string
     */
    public function getNomEnfant()
    {
        return $this->nomEnfant;
    }

    /**
     * Set prenomEnfant
     *
     * @param string $prenomEnfant
     *
     * @return Enfant
     */
    public function setPrenomEnfant($prenomEnfant)
    {
        $this->prenomEnfant = $prenomEnfant;

        return $this;
    }

    /**
     * Get prenomEnfant
     *
     * @return string
     */
    public function getPrenomEnfant()
    {
        return $this->prenomEnfant;
    }

    /**
     * Set imageEnfant
     *
     * @param string $imageEnfant
     *
     * @return Enfant
     */
    public function setImageEnfant($imageEnfant)
    {
        $this->imageEnfant = $imageEnfant;

        return $this;
    }

    /**
     * Get imageEnfant
     *
     * @return string
     */
    public function getImageEnfant()
    {
        return $this->imageEnfant;
    }

    /**
     * Set datenEnfant
     *
     * @param string $datenEnfant
     *
     * @return Enfant
     */
    public function setDatenEnfant($datenEnfant)
    {
        $this->datenEnfant = $datenEnfant;

        return $this;
    }

    /**
     * Get datenEnfant
     *
     * @return string
     */
    public function getDatenEnfant()
    {
        return $this->datenEnfant;
    }

    /**
     * Set idClasse
     *
     * @param \KidzyBundle\Entity\Classe $idClasse
     *
     * @return Enfant
     */
    public function setIdClasse(\KidzyBundle\Entity\Classe $idClasse )
    {
        $this->idClasse = $idClasse;
        return $this;
    }

    /**
     * Get idClasse
     *
     * @return \KidzyBundle\Entity\Classe
     */
    public function getIdClasse()
    {
        return $this->idClasse;
    }

    /**
     * Set id
     *
     * @param \KidzyBundle\Entity\User $id
     *
     * @return Enfant
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->factures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();

    }

    /**
     * Add facture
     *
     * @param \KidzyBundle\Entity\Facture $facture
     *
     * @return Enfant
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
    /**
     * Add attachment
     *
     * @param \KidzyBundle\Entity\attachment $attachment
     *
     * @return Enfant
     */
    public function addAttachment(\KidzyBundle\Entity\attachment $attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * Remove attachment
     *
     * @param \KidzyBundle\Entity\attachment $attachment
     */
    public function removeAttachment(\KidzyBundle\Entity\attachment $attachment)
    {
        $this->attachments->removeElement($attachment);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttachements()
    {
        return $this->attachments;
    }

    /**
     * Set idParent
     *
     * @param \UserBundle\Entity\User $idParent
     *
     * @return Enfant
     */
    public function setIdParent(\UserBundle\Entity\User $idParent)
    {
        $this->idParent = $idParent;

        return $this;
    }

    /**
     * Get idParent
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * @return \Garde
     */
    public function getIdGarde()
    {
        return $this->idGarde;
    }

    /**
     * @param \Garde $idGarde
     */
    public function setIdGarde($idGarde)
    {
        $this->idGarde = $idGarde;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     */
    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile ) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return
            [
                'id'   => $this->getIdEnfant(),
                'nom' => $this->getNomEnfant(),
                'prenom' => $this->getPrenomEnfant(),
                'parent' => $this ->getIdParent()
            ];
    }
}
