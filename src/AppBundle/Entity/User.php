<?php
// src/AppBundle/Entity/User.php

 namespace AppBundle\Entity;
 use FOS\UserBundle\Model\User as BaseUser;
 use Doctrine\ORM\Mapping as ORM;

 /**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
 class User extends BaseUser
 {
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;

     /**
      * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Adresse")
      * @ORM\JoinColumn(name="Gouvernorat",referencedColumnName="idAdresse")
      */
     private $Gouvernorat;

     /**
      * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Adresse")
      * @ORM\JoinColumn(name="Delegation",referencedColumnName="idAdresse")
      */
     private $Delegation;

     /**
      * @return mixed
      */
     public function getGouvernorat()
     {
         return $this->Gouvernorat;
     }

     /**
      * @param mixed $Gouvernorat
      */
     public function setGouvernorat($Gouvernorat)
     {
         $this->Gouvernorat = $Gouvernorat;
     }

     /**
      * @return mixed
      */
     public function getDelegation()
     {
         return $this->Delegation;
     }

     /**
      * @param mixed $Delegation
      */
     public function setDelegation($Delegation)
     {
         $this->Delegation = $Delegation;
     }

 }