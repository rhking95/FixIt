<?php

namespace DemandeBundle\Repository;

/**
 * RepenseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RepenseRepository extends \Doctrine\ORM\EntityRepository
{
    public function refuserrep($iddem){
        return $this->getEntityManager()->createQuery(
            "UPDATE DemandeBundle:Repense rep SET rep.etat = 1 WHERE rep.iddem = ".$iddem
        )->getArrayResult();
    }
}
