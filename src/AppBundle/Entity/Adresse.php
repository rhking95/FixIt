<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdresseRepository")
 */
class Adresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAdresse", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=255)
     */
    private $Libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="Niveau", type="integer")
     */
    private $Niveau;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Adresse")
     * @ORM\JoinColumn(name="IdParent",referencedColumnName="idAdresse")
     */
    private $IdParent;

    /**
     * Get idAdresse
     *
     * @return integer
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->Libelle;
    }

    /**
     * @param string $Libelle
     */
    public function setLibelle($Libelle)
    {
        $this->Libelle = $Libelle;
    }

    /**
     * @return int
     */
    public function getNiveau()
    {
        return $this->Niveau;
    }

    /**
     * @param int $Niveau
     */
    public function setNiveau($Niveau)
    {
        $this->Niveau = $Niveau;
    }

    /**
     * @return mixed
     */
    public function getIdParent()
    {
        return $this->IdParent;
    }

    /**
     * @param mixed $IdParent
     */
    public function setIdParent($IdParent)
    {
        $this->IdParent = $IdParent;
    }

}

