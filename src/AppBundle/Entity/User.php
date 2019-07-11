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


     public function setEmail($email)
     {
         $this->setusername($email);
         return parent::setEmail($email); // TODO: Change the autogenerated stub
     }


 }