<?php

namespace KidzyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="foreign_parent", columns={"id_parent"}), @ORM\Index(name="foreign_enfant", columns={"id_enf"}), @ORM\Index(name="foreign_pack", columns={"id_pack"})})
 * @ORM\Entity
 */
class Facture implements JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_facture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFacture;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=false)
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_facture", type="date", nullable=false)
     */
    private $dateFacture;
    /**
     * @var string
     *
     * @ORM\Column(name="due_date_facture", type="string", nullable=false)
     */
    private $due_dateFacture;

    /**
     * @ORM\ManyToOne(targetEntity="Enfant", inversedBy="factures")
     * @ORM\JoinColumn(name="id_enf", referencedColumnName="id_enfant")
     */
    private $idEnf;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="factures")
     * @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     */
    private $idParent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paye", type="boolean", nullable=false)
     */
    private $paye;
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pack", inversedBy="factures")
     * @ORM\JoinColumn(name="id_pack", referencedColumnName="id_pack")
     */
    private $pack;

    /**
     * Get idFacture
     *
     * @return integer
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }
    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Facture
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Set total
     *
     * @param float $total
     *
     * @return Facture
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set dateFacture
     *
     * @param \DateTime $dateFacture
     *
     * @return Facture
     */
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    /**
     * Get dateFacture
     *
     * @return \DateTime
     */
    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    /**
     * @return string
     */
    public function getdue_dateFacture(): string
    {
        return $this->due_dateFacture;
    }

    /**
     * @param string $due_dateFacture
     */
    public function setdue_dateFacture(string $due_dateFacture)
    {
        $this->due_dateFacture = $due_dateFacture;
    }
    

    /**
     * Set paye
     *
     * @param boolean $paye
     *
     * @return Facture
     */
    public function setPaye($paye)
    {
        $this->paye = $paye;

        return $this;
    }

    /**
     * Get paye
     *
     * @return boolean
     */
    public function getPaye()
    {
        return $this->paye;
    }

    /**
     * Set idEnf
     *
     * @param \KidzyBundle\Entity\Enfant $idEnf
     *
     * @return Facture
     */
    public function setIdEnf(\KidzyBundle\Entity\Enfant $idEnf = null)
    {
        $this->idEnf = $idEnf;

        return $this;
    }

    /**
     * Get idEnf
     *
     * @return \KidzyBundle\Entity\Enfant
     */
    public function getIdEnf()
    {
        return $this->idEnf;
    }

    /**
     * Set idParent
     *
     * @param \UserBundle\Entity\User $idParent
     *
     * @return Facture
     */
    public function setIdParent(\UserBundle\Entity\User $idParent = null)
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
     * Set pack
     *
     * @param \KidzyBundle\Entity\Pack $pack
     *
     * @return Facture
     */
    public function setPack(\KidzyBundle\Entity\Pack $pack = null)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \KidzyBundle\Entity\Pack
     */
    public function getPack()
    {
        return $this->pack;
    }
    public function jsonSerialize()
    {
        return
            [
                'id'   => $this->getIdFacture(),
                'enfant' => $this->getIdEnf(),
                'parent' => $this->getIdParent(),
                'pack' => $this ->getPack(),
                'total' =>$this ->getTotal(),
                'start date facture' =>$this ->getDateFacture(),
                'End date facture' =>$this ->getDueDateFacture(),
                'paye'=>$this->getPaye(),
                'status'=>$this->getStatus()
            ];
    }
}
