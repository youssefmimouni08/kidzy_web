<?php


namespace KidzyBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Tests\OrmFunctionalTestCase;

class gardeRepository extends EntityRepository
{
    public function myListEnfant($idGarde)
    {$qb=$this->getEntityManager()->createQuery("select  e.nomEnfant , e.prenomEnfant , e.idEnfant  from KidzyBundle:Enfant e  where e.idGarde=:id")
        ->setParameter('id', $idGarde);
        return $query=$qb->getResult();
    }

    public function nbreEnfant($idGarde)
    {
        $qb = $this->getEntityManager()->createQuery("select count(i.idEnfant) from KidzyBundle:Enfant i JOIN i.idGarde c where  i.idGarde=:idGarde
        group by c.idGarde ")

            ->setParameter('idGarde', $idGarde);

        return $query = $qb->getSingleScalarResult();



    }

    public function nbreEnfants()
    {
        $qb = $this->getEntityManager()->createQuery(
            "select c.nomGarde nomGarde , count(i.idEnfant) NB 
            from KidzyBundle:Enfant i JOIN i.idGarde c  group by c.idGarde");

        return $query = $qb->getResult();

    }

/*
select id_enf , titre from facture f INNER JOIN frais_packs s on f.id_pack=s.pack_id INNER JOIN frais l ON l.id_frais=s.frais_id WHERE titre="garde"

    public function gardePayee($titre)
    {$qb=$this->getEntityManager()->createQuery("select  idEnf , titre  from KidzyBundle:Facture f INNER JOIN where e.idGarde=:id")
        ->setParameter('titre', $titre);
        return $query=$qb->getResult();
    }
*/
}