<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="ProduitBundle\Repository\commandeRepository")
 */
class commande
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
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="idpro",referencedColumnName="id")
     */
    private $idpro;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="iduser",referencedColumnName="id")
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="quant", type="integer")
     */
    private $quant;

    /**
     * @var int
     *
     * @ORM\Column(name="prixc", type="integer")
     */
    private $prixc;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idpro
     *
     * @param string $idpro
     *
     * @return commande
     */
    public function setIdpro($idpro)
    {
        $this->idpro = $idpro;
    
        return $this;
    }

    /**
     * Get idpro
     *
     * @return string
     */
    public function getIdpro()
    {
        return $this->idpro;
    }

    /**
     * Set iduser
     *
     * @param string $iduser
     *
     * @return commande
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
     * Set quant
     *
     * @param integer $quant
     *
     * @return commande
     */
    public function setQuant($quant)
    {
        $this->quant = $quant;
    
        return $this;
    }

    /**
     * Get quant
     *
     * @return integer
     */
    public function getQuant()
    {
        return $this->quant;
    }

    /**
     * @return int
     */
    public function getPrixc()
    {
        return $this->prixc;
    }

    /**
     * @param int $prixc
     */
    public function setPrixc($prixc)
    {
        $this->prixc = $prixc;
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

