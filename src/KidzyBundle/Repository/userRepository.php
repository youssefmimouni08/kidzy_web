<?php


namespace KidzyBundle\Repository;


use Doctrine\ORM\EntityRepository;


class userRepository extends EntityRepository
{
    public function maitresse()
    {
        $qb = $this->getEntityManager()->createQuery("select c from KidzyBundle:User c where c.prenom='Ikram");
        return $query = $qb->getResult();
    }

}