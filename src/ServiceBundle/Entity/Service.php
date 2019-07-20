<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\ServiceRepository")
 */
class Service
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDService", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $IDService;

    /**
     * @var string
     *
     * @ORM\Column(name="TitreService", type="string", length=255)
     */
    private $TitreService;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionService", type="string", length=255)
     */
    private $DescriptionService;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Categorie")
     * @ORM\JoinColumn(name="CategorieService",referencedColumnName="id")
     */
    private $CategorieService;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixService", type="float")
     */
    private $PrixService;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="UtilisateurService",referencedColumnName="id")
     */
    private $UtilisateurService;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreationService", type="datetime")
     */
    private $DateCreationService;

    /**
     * Get id
     *
     * @return integer
     */

    /**
     * @var int
     *
     * @ORM\Column(name="EtatService", type="integer")
     */
    private $EtatService;

    /**
     * @var float
     *
     * @ORM\Column(name="NoteService", type="float")
     */
    private $NoteService;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Adresse")
     * @ORM\JoinColumn(name="GouvernoratService",referencedColumnName="idAdresse")
     */
    private $GouvernoratService;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Adresse")
     * @ORM\JoinColumn(name="DelegationService",referencedColumnName="idAdresse")
     */
    private $DelegationService;

    public function getIDService()
    {
        return $this->IDService;
    }

    /**
     * @return string
     */
    public function getTitreService()
    {
        return $this->TitreService;
    }

    /**
     * @param string $TitreService
     */
    public function setTitreService($TitreService)
    {
        $this->TitreService = $TitreService;
    }

    /**
     * @return string
     */
    public function getDescriptionService()
    {
        return $this->DescriptionService;
    }

    /**
     * @param string $DescriptionService
     */
    public function setDescriptionService($DescriptionService)
    {
        $this->DescriptionService = $DescriptionService;
    }

    /**
     * @return mixed
     */
    public function getCategorieService()
    {
        return $this->CategorieService;
    }

    /**
     * @param mixed $CategorieService
     */
    public function setCategorieService($CategorieService)
    {
        $this->CategorieService = $CategorieService;
    }

    /**
     * @return float
     */
    public function getPrixService()
    {
        return $this->PrixService;
    }

    /**
     * @param float $PrixService
     */
    public function setPrixService($PrixService)
    {
        $this->PrixService = $PrixService;
    }

    /**
     * @return mixed
     */
    public function getUtilisateurService()
    {
        return $this->UtilisateurService;
    }

    /**
     * @param mixed $UtilisateurService
     */
    public function setUtilisateurService($UtilisateurService)
    {
        $this->UtilisateurService = $UtilisateurService;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreationService()
    {
        return $this->DateCreationService;
    }

    /**
     * @param \DateTime $DateCreationService
     */
    public function setDateCreationService($DateCreationService)
    {
        $this->DateCreationService = $DateCreationService;
    }

    /**
     * @return int
     */
    public function getEtatService()
    {
        return $this->EtatService;
    }

    /**
     * @param int $EtatService
     */
    public function setEtatService($EtatService)
    {
        $this->EtatService = $EtatService;
    }

    /**
     * @return float
     */
    public function getNoteService()
    {
        return $this->NoteService;
    }

    /**
     * @param float $NoteService
     */
    public function setNoteService($NoteService)
    {
        $this->NoteService = $NoteService;
    }

    /**
     * @return mixed
     */
    public function getGouvernoratService()
    {
        return $this->GouvernoratService;
    }

    /**
     * @param mixed $GouvernoratService
     */
    public function setGouvernoratService($GouvernoratService)
    {
        $this->GouvernoratService = $GouvernoratService;
    }

    /**
     * @return mixed
     */
    public function getDelegationService()
    {
        return $this->DelegationService;
    }

    /**
     * @param mixed $DelegationService
     */
    public function setDelegationService($DelegationService)
    {
        $this->DelegationService = $DelegationService;
    }

}

