<?php

namespace KidzyApiBundle\Controller;

use KidzyBundle\Entity\Facture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PricingController extends Controller
{
    public function allPackAction()
    {
        $packs = $this->getDoctrine()->getManager()
            ->getRepository('KidzyBundle:Pack')
            ->findAll();

        return new Response(json_encode($packs));
    }
    public function findPackAction($id)
    {
        $packs = $this->getDoctrine()->getManager()
            ->getRepository('KidzyBundle:Pack')
            ->find($id);

        return new Response(json_encode($packs));
    }
    public function allFactureAction()
    {
        $factures = $this->getDoctrine()->getManager()
            ->getRepository('KidzyBundle:Facture')
            ->findAll();

        return new Response(json_encode($factures));
    }
    public function findFactureAction($id)
    {
        $factures = $this->getDoctrine()->getManager()
            ->getRepository('KidzyBundle:Facture')
            ->find($id);

        return new Response(json_encode($factures));
    }
    public function newFactureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = new Facture();

        $iduser = $request->get('idparent');
        $user = $em->getRepository('UserBundle:User')->find($iduser);

        $idEnfant = $request->get('idEnfant');
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);

        $idpack = $request->get('idPack');
        $pack = $em->getRepository('KidzyBundle:Pack')->find($idpack);

        $prix = $request->get('prix');
        $due =$request->get('end') ;

        $facture->setDateFacture(new \DateTime());
        $facture->setDue_dateFacture($due);
        $facture->setPack($pack);
        $facture->setPaye(false);
        $facture->setTotal($prix);
        $facture->setIdParent($user);
        $facture->setIdEnf($enfant);
        $facture->setStatus(0);
        $em->persist($facture);
        $em->flush();


        return new Response(json_encode($facture));
    }

}


