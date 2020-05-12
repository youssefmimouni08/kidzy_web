<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seance
 *
 * @ORM\Table(name="seance", indexes={@ORM\Index(name="fk_id_classe", columns={"id_classe"}), @ORM\Index(name="fk_id_matiere", columns={"id_mat"}), @ORM\Index(name="fk_id_enss", columns={"id"})})
 * @ORM\Entity
 */
class Seance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_seance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSeance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_seance", type="date", nullable=false)
     */
    private $dateSeance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_seance", type="datetime", nullable=false)
     */
    private $heureSeance = 'CURRENT_TIMESTAMP';

    /**
     * @var \Classe
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_classe", referencedColumnName="id_classe")
     * })
     */
    private $idClasse;

    /**
     * @var \Matiere
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_mat", referencedColumnName="id__matiere")
     * })
     */
    private $idMat;

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
     * Set idSeance
     *
     * @param integer $idSeance
     *
     * @return Seance
     */
    public function setIdSeance($idSeance)
    {
        $this->idSeance = $idSeance;

        return $this;
    }

    /**
     * Get idSeance
     *
     * @return integer
     */
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * Set dateSeance
     *
     * @param \DateTime $dateSeance
     *
     * @return Seance
     */
    public function setDateSeance($dateSeance)
    {
        $this->dateSeance = $dateSeance;

        return $this;
    }

    /**
     * Get dateSeance
     *
     * @return \DateTime
     */
    public function getDateSeance()
    {
        return $this->dateSeance;
    }

    /**
     * Set heureSeance
     *
     * @param \DateTime $heureSeance
     *
     * @return Seance
     */
    public function setHeureSeance($heureSeance)
    {
        $this->heureSeance = $heureSeance;

        return $this;
    }

    /**
     * Get heureSeance
     *
     * @return \DateTime
     */
    public function getHeureSeance()
    {
        return $this->heureSeance;
    }

    /**
     * Set idClasse
     *
     * @param \KidzyBundle\Entity\Classe $idClasse
     *
     * @return Seance
     */
    public function setIdClasse(\KidzyBundle\Entity\Classe $idClasse)
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
     * Set idMat
     *
     * @param \KidzyBundle\Entity\Matiere $idMat
     *
     * @return Seance
     */
    public function setIdMat(\KidzyBundle\Entity\Matiere $idMat)
    {
        $this->idMat = $idMat;

        return $this;
    }

    /**
     * Get idMat
     *
     * @return \KidzyBundle\Entity\Matiere
     */
    public function getIdMat()
    {
        return $this->idMat;
    }

    /**
     * Set id
     *
     * @param \KidzyBundle\Entity\User $id
     *
     * @return Seance
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
}
