<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;

/**

 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="prenom", type="string", length=255)
     *
     * @Assert\NotBlank(message="Taper votre Prénom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="Taper un prénom valid.",
     *     maxMessage="Taper un prénom valid.",
     *     groups={"Registration", "Profile"}
     * )
     */

    protected $prenom;

    /**
     * @ORM\Column(name="nom", type="string", length=255)
     *
     * @Assert\NotBlank(message="Taper votre Nom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="Taper un nom valid.",
     *     maxMessage="Taper un nom valid.",
     *     groups={"Registration", "Profile"}
     * )
     */

    protected $nom;

    /**
     * @ORM\Column(name="tel", type="string", length=255)
     *
     * @Assert\NotBlank(message="Taper votre Télephone", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="8",
     *     minMessage="Taper un télephone valid.",
     *     maxMessage="Taper un télephone valid.",
     *     groups={"Registration", "Profile"}
     * )
     */

    protected $tel;

    /**
     * @ORM\Column(name="cin", type="string", length=255)
     *
     * @Assert\NotBlank(message="Taper votre CIN", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="8",
     *     minMessage="Taper un numéro de CIN valide.",
     *     maxMessage="Taper un numéro de CIN valide.",
     *     groups={"Registration", "Profile"}
     * )
     */

    protected $cin;



    /**
     * @ORM\OneToMany(targetEntity="KidzyBundle\Entity\Facture", mappedBy="idParent")
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity="KidzyBundle\Entity\Enfant", mappedBy="idParent")
     */
    private $enfants;

    /**
     * @ORM\OneToMany(targetEntity="KidzyBundle\Entity\Avis", mappedBy="id")
     */
    private $avis;

    /**
     * @ORM\OneToMany(targetEntity="KidzyBundle\Entity\Reclamations", mappedBy="id")
     */
    private $rec;

    /**
     * @return mixed
     */
    public function getRec()
    {
        return $this->rec;
    }

    /**
     * @param mixed $rec
     */
    public function setRec($rec)
    {
        $this->rec = $rec;
    }

    /**
     * @return mixed
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * @param mixed $avis
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;
    }

    public function __construct()
    {
        parent::__construct();
        $this->factures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
        // your own logic
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Add facture
     *
     * @param \KidzyBundle\Entity\Facture $facture
     *
     * @return User
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
     * @param \Doctrine\Common\Collections\ArrayCollection $enfants
     */
    public function setEnfants($enfants)
    {
        $this->enfants = $enfants;
    }

    /**
     * Add enfant
     *
     * @param \KidzyBundle\Entity\Enfant $enfant
     *
     * @return User
     */
    public function addEnfant(\KidzyBundle\Entity\Enfant $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \KidzyBundle\Entity\Enfant $enfant
     */
    public function removeEnfant(\KidzyBundle\Entity\Enfant $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }
    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return
            [
                'nom_parent'   => $this->getNom(),
                'prenom_parent' => $this->getPrenom()
            ];
    }
}
