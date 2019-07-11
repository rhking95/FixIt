<?php

namespace DemandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Repense
 *
 * @ORM\Table(name="repense")
 * @ORM\Entity(repositoryClass="DemandeBundle\Repository\RepenseRepository")
 */
class Repense
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
     * @ORM\Column(name="rep", type="string", length=255)
     */
    private $rep;


    /**
     * @ORM\ManyToOne(targetEntity="Demande")
     * @ORM\JoinColumn(name="iddem",referencedColumnName="id")
     */

    private $iddem;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="iduser",referencedColumnName="id")
     */

    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
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
     * Set iddem
     *
     * @param string $iddem
     *
     * @return Repense
     */
    public function setIddem($iddem)
    {
        $this->iddem = $iddem;

        return $this;
    }

    /**
     * Get iddem
     *
     * @return string
     */
    public function getIddem()
    {
        return $this->iddem;
    }

    /**
     * Set iduser
     *
     * @param string $iduser
     *
     * @return Repense
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return string
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @return string
     */
    public function getRep()
    {
        return $this->rep;
    }

    /**
     * @param string $rep
     */
    public function setRep($rep)
    {
        $this->rep = $rep;
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

