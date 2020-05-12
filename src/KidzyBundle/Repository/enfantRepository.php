<?php


namespace KidzyBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Tests\OrmFunctionalTestCase;

class enfantRepository extends EntityRepository
{
    public function myEnfant()
    {
        $qb=$this->getEntityManager()->createQuery("select e from KidzyBundle:Enfant e Where e.prenomEnfant = 'sonia' " );

        return $query = $qb->getResult();


    }
    public function search($prenomEnfant) {
        return $this->createQueryBuilder('Enfant')
            ->andWhere('Enfant.prenomEnfant LIKE :prenomEnfant')
            ->setParameter('prenomEnfant', '%'.$prenomEnfant.'%')
            ->getQuery()
            ->execute();
    }
}