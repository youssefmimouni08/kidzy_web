<?php


namespace KidzyBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\Tests\OrmFunctionalTestCase;

class fraisRepository extends EntityRepository
{
    public function checktitre($titre)
    {
        $qb = $this->createQueryBuilder('frai')
            ->andWhere('frai.titre = :titre')
            ->setParameter('titre', $titre)
            ->select('frai.titre');
        $query = $qb->getQuery();
        return $query->execute();

    }
}