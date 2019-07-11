<?php

namespace DemandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="DemandeBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\Column(name="valure", type="string", length=255)
     */
    private $valure;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer")
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="iddem",type="integer")
     */
    private $iddem;


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
     * Set valure
     *
     * @param string $valure
     *
     * @return Commentaire
     */
    public function setValure($valure)
    {
        $this->valure = $valure;

        return $this;
    }

    /**
     * Get valure
     *
     * @return string
     */
    public function getValure()
    {
        return $this->valure;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return Commentaire
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @return int
     */
    public function getIddem()
    {
        return $this->iddem;
    }

    /**
     * @param int $iddem
     */
    public function setIddem($iddem)
    {
        $this->iddem = $iddem;
    }



}

