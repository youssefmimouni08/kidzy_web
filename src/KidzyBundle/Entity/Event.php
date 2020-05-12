<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


/**
 * Event
 *
 * @ORM\Table(name="event")
 *
 *
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\inscriptionRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=20, nullable=false)
     *  @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Le Nom doit contenir au moins {{ limit }} caractéres ",
     *      maxMessage = "Le nom doit contenir au plus {{ limit }} caractéres "
     * )
     * @Assert\NotBlank(message="le champ nom est obligatoire")
     */
    private $nomEvent;

    /**
     * @var string|null
     *
     *
     * @ORM\Column(name="image_enfant", type="string", length=255, nullable=false)
     */
    private $imageEvent;

    /**
     * @return string|null
     */
    public function getImageEvent()
    {
        return $this->imageEvent;
    }

    /**
     * @param string|null $imageEvent
     */
    public function setImageEvent($imageEvent)
    {
        $this->imageEvent = $imageEvent;
    }


    /**
     *
     * @Vich\UploadableField(mapping="event_image", fileNameProperty="imageEvent")
     *
     * @var File|null
     * @Assert\Image(
     *     mimeTypes= { "image/png" , "image/jpeg"  },
     *
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

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
     * @var string
     *
     * @ORM\Column(name="date_event", type="string", length=255, nullable=false)
     *  @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $dateEvent;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_event", type="float", precision=10, scale=0, nullable=false)
     *  @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $prixEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="descr_event", type="string", length=600, nullable=false)
     *  @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $descrEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="type_event", type="string", length=600, nullable=false)
     *  @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $typeEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_event", type="string", length=500, nullable=false)
     *  @Assert\NotBlank(message="le champ description est obligatoire")
     */
    private $lieuEvent;

    /**
     * @ORM\ManyToOne(targetEntity="Club")
     * @ORM\JoinColumn(name="id_club",
     *     referencedColumnName="id_club")

     */
    private $club ;

    /**
     * @return mixed
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * @param mixed $club
     */
    public function setClub($club)
    {
        $this->club = $club;
    }

    /**
     * Get idEvent
     *
     * @return integer
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * Set nomEvent
     *
     * @param string $nomEvent
     *
     * @return Event
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    /**
     * Get nomEvent
     *
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * Set dateEvent
     *
     * @param string $dateEvent
     *
     * @return Event
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return string
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * Set prixEvent
     *
     * @param float $prixEvent
     *
     * @return Event
     */
    public function setPrixEvent($prixEvent)
    {
        $this->prixEvent = $prixEvent;

        return $this;
    }

    /**
     * Get prixEvent
     *
     * @return float
     */
    public function getPrixEvent()
    {
        return $this->prixEvent;
    }

    /**
     * Set descrEvent
     *
     * @param string $descrEvent
     *
     * @return Event
     */
    public function setDescrEvent($descrEvent)
    {
        $this->descrEvent = $descrEvent;

        return $this;
    }

    /**
     * Get descrEvent
     *
     * @return string
     */
    public function getDescrEvent()
    {
        return $this->descrEvent;
    }

    /**
     * Set typeEvent
     *
     * @param string $typeEvent
     *
     * @return Event
     */
    public function setTypeEvent($typeEvent)
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    /**
     * Get typeEvent
     *
     * @return string
     */
    public function getTypeEvent()
    {
        return $this->typeEvent;
    }

    /**
     * Set lieuEvent
     *
     * @param string $lieuEvent
     *
     * @return Event
     */
    public function setLieuEvent($lieuEvent)
    {
        $this->lieuEvent = $lieuEvent;

        return $this;
    }

    /**
     * Get lieuEvent
     *
     * @return string
     */
    public function getLieuEvent()
    {
        return $this->lieuEvent;
    }
}
