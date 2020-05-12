<?php

namespace KidzyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamations
 *
 * @ORM\Table(name="reclamations", indexes={@ORM\Index(name="jhjlh", columns={"id_M"}), @ORM\Index(name="id", columns={"id"})})
 *
 * @ORM\Entity(repositoryClass="KidzyBundle\Repository\reclamationsRepository")
 */
class Reclamations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rec", type="date", nullable=false)
     */

    private $dateRec;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_rec", type="string", length=11, nullable=false)
     */
    private $etatRec ;

    /**
     * @var string
     *
     * @ORM\Column(name="description_rec", type="string", length=255, nullable=false)
     *
     */
    private $descriptionRec;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse_rec", type="string", length=600, nullable=true)
     *
     */
    private $reponseRec;

    /**
     * @var string
     *
     * @ORM\Column(name="archive", type="string", length=255, nullable=false)
     */
    private $archive ;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="rec")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_M", referencedColumnName="id")
     * })
     */

    private $idM;

    /**
     * @return \User
     */
    public function getIdM()
    {
        return $this->idM;
    }

    /**
     * @param \User $idM
     */
    public function setIdM($idM)
    {
        $this->idM = $idM;
    }

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="rec")
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
     * Get idRec
     *
     * @return integer
     */
    public function getIdRec()
    {
        return $this->idRec;
    }

    /**
     * Set dateRec
     *
     * @param \DateTime $dateRec
     *
     * @return Reclamations
     */
    public function setDateRec($dateRec)
    {
        $this->dateRec = $dateRec;

        return $this;
    }

    /**
     * Get dateRec
     *
     * @return \DateTime
     */
    public function getDateRec()
    {
        return $this->dateRec;
    }

    /**
     * Set etatRec
     *
     * @param string $etatRec
     *
     * @return Reclamations
     */
    public function setEtatRec($etatRec)
    {
        $this->etatRec = $etatRec;

        return $this;
    }

    /**
     * Get etatRec
     *
     * @return string
     */
    public function getEtatRec()
    {
        return $this->etatRec;
    }

    /**
     * Set descriptionRec
     *
     * @param string $descriptionRec
     *
     * @return Reclamations
     */
    public function setDescriptionRec($descriptionRec)
    {
        $this->descriptionRec = $descriptionRec;

        return $this;
    }

    /**
     * Get descriptionRec
     *
     * @return string
     */
    public function getDescriptionRec()
    {
        return $this->descriptionRec;
    }

    /**
     * Set reponseRec
     *
     * @param string $reponseRec
     *
     * @return Reclamations
     */
    public function setReponseRec($reponseRec)
    {
        $this->reponseRec = $reponseRec;

        return $this;
    }

    /**
     * Get reponseRec
     *
     * @return string
     */
    public function getReponseRec()
    {
        return $this->reponseRec;
    }

    /**
     * Set archive
     *
     * @param string $archive
     *
     * @return Reclamations
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return string
     */
    public function getArchive()
    {
        return $this->archive;
    }


}
