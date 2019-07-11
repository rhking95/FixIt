<?php

namespace DemandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="DemandeBundle\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dis",type="string", length=255)
     */
    private $dis;

    /**
     * @var string
     *
     * @ORM\Column(name="photo",type="string", length=255)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="address",type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="contact",type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="CategorieDem")
     * @ORM\JoinColumn(name="cat",referencedColumnName="id")
     */
    private $cat;

    /**
     * @var int
     *
     * @ORM\Column(name="prix",type="decimal", scale=3)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="iduser",referencedColumnName="id")
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="Date",type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="etat",type="integer")
     */
    private $etat;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDis()
    {
        return $this->dis;
    }

    /**
     * @param string $dis
     */
    public function setDis($dis)
    {
        $this->dis = $dis;
    }

    /**
     * @return string
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param string $cat
     */
    public function setCat($cat)
    {
        $this->cat = $cat;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }



}

