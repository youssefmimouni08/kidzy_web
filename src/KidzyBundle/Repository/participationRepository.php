<?php


namespace KidzyBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Tests\OrmFunctionalTestCase;

class participationRepository extends EntityRepository
{
    public function myfinfDomaine($idEvent)
    {$qb=$this->getEntityManager()->createQuery("select  c.nomEnfant , c.prenomEnfant from KidzyBundle:Participation i JOIN i.idEnfant c JOIN i.idEvent p where i.idEvent=:id")
        ->setParameter('id', $idEvent);
        return $query=$qb->getResult();
    }

    public function myfinfnbrese()
    {
        $qb = $this->getEntityManager()->createQuery(
            "select c.nomEvent nomEvent , count(i.idEnfant) NB 
            from KidzyBundle:Participation i JOIN i.idEvent c    group by c.idEvent");


        return $query = $qb->getResult();



    }
}