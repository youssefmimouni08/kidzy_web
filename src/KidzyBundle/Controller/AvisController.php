<?php

namespace KidzyBundle\Controller;

use KidzyBundle\Entity\Avis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use KidzyBundle\Form\AvisType;



/**
 * avis controller.
 *
 */
class AvisController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('KidzyBundle:Avis')->findAll();

        return $this->render('@Kidzy/avis/index.html.twig', array(
            'avis' => $avis,
        ));
    }
    public function newAction(Request $request)
    {

        $user = $this->container->get('security.token_storage')->getToken()->getUser();



        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $today = new \DateTime('now');
            $avis->setDateAvis($today);
            $avis->setId($user);
            $em->persist($avis);
            $em->flush();

            return $this->redirectToRoute('Mesavis',array("avis"=>$avis));
        }
        return $this->render('@Kidzy/avis/new.html.twig', array('form'=>$form->createView()));
    }

    public function showAction(Avis $avi)
    {
        $deleteForm = $this->createDeleteForm($avi);

        return $this->render('@Kidzy/avis/show.html.twig', array(
            'avi' => $avi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction(Request $request, Avis $avi)
    {
        $form = $this->createDeleteForm($avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avi);
            $em->flush();
        }

        return $this->redirectToRoute('avis_index');
    }




    private function createDeleteForm(Avis $avi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avis_delete', array('idAvis' => $avi->getIdAvis())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function avisFAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('KidzyBundle:Avis')->findAll();
        $aviss= $this->get('knp_paginator')->paginate($avis, $request->query->get( 'page',  1), 3);

        return $this->render('@Kidzy/avis/avisF.html.twig', array(
            'avis' => $avis,
            'avis' => $aviss,
       

        ));
    }

    public function MesavisAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $avis = $em->getRepository('KidzyBundle:Avis')->findAll();
        $aviss= $this->get('knp_paginator')->paginate($avis, $request->query->get( 'page',  1), 3);
        return $this->render('@Kidzy/avis/Mesavis.html.twig', array('parent' => $user,
            'avis' => $avis,
            'avis' => $aviss,




        ));
    }

    public function supprimerAction($idAvis)
    {

        $em=$this->getDoctrine()->getManager();
        $avis =$em ->getRepository(Avis::class) ->find($idAvis);
        $em->remove($avis);
        $em->flush();
        return $this->redirectToRoute("Mesavis" );
    }




    public function editAction(Request $request, Avis $avis)
    {
        $deleteForm = $this->createDeleteForm($avis);
        $editForm = $this->createForm('KidzyBundle\Form\AvisType', $avis);
        $editForm->handleRequest($request);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Mesavis', array('idAvis' => $avis->getIdAvis()));
        }

        return $this->render('@Kidzy/avis/edit.html.twig', array(
            'avis' => $avis,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }





}

