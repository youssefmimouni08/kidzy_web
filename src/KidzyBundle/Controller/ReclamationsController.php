<?php

namespace KidzyBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use KidzyBundle\Entity\Reclamations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use KidzyBundle\Form\ReclamationsType;
use KidzyBundle\Form\ReclamationsAType;
use UserBundle\Entity\User;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class ReclamationsController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rec = $em->getRepository('KidzyBundle:Reclamations')->findAll();

        return $this->render('@Kidzy/reclamations/index.html.twig', array(
            'rec' => $rec,
        ));
    }





    public function showAction(Reclamations $rec)
    {
        $deleteForm = $this->createDeleteForm($rec);

        return $this->render('@Kidzy/reclamations/show.html.twig', array(
            'rec' => $rec,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    public function deleteAction(Request $request, Reclamations $rec)
    {
        $form = $this->createDeleteForm($rec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rec);
            $em->flush();
        }

        return $this->redirectToRoute('reclamations_index');
    }


    private function createDeleteForm(Reclamations $rec)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamations_delete', array('idRec' => $rec->getIdRec())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function editAction(Request $request, Reclamations $rec)
    {
        $deleteForm = $this->createDeleteForm($rec);
        $editForm = $this->createForm('KidzyBundle\Form\ReclamationsType', $rec);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $rec->setEtatRec("oui");
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamations_edit', array('idRec' => $rec->getIdRec()));
        }

        return $this->render('@Kidzy/reclamations/edit.html.twig', array(
            'frai' => $rec,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function MesRecAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $rec = $em->getRepository('KidzyBundle:Reclamations')->findAll();
        $recc= $this->get('knp_paginator')->paginate($rec, $request->query->get( 'page',  1), 2);
        return $this->render('@Kidzy/reclamations/Mesrec.html.twig', array(
            'parent' => $user,
            'rec' => $rec,
            'rec' => $recc,






        ));
    }
    public function newAction(Request $request)
    {
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $reclamation = new Reclamations();
            $form = $this->createForm('KidzyBundle\Form\ReclamationsAType', $reclamation);
            $form->handleRequest($request);
            $em=$this->getDoctrine()->getManager();
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $reclamation->setId($user);
                $today = new \DateTime('now');
                $reclamation ->setDateRec($today);
                $reclamation ->setEtatRec("non");
                $reclamation ->setReponseRec(" ");
                $reclamation ->setArchive("non archiver");
                $em->persist($reclamation);
                $em->flush();

                return $this->redirectToRoute('MesRec', array('idRec' => $reclamation->getIdRec()));
            }

            return $this->render('@Kidzy/reclamations/new.html.twig', array('form' => $form->createView()));
        }


    }
    public function printAction(Request $request)
    {

        $idRec = $request->get('idRec');
        $em = $this->getDoctrine()->getManager();

        $reclamation = $em->getRepository('KidzyBundle:Reclamations')->find($idRec);




        $html = $this->renderView('@Kidzy/reclamations/print.html.twig', array(
            'reclamation'  => $reclamation,


        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'reclamation.pdf'
        );
    }

    public function chartsRAction()
    {
        $pieChart = new PieChart();
        $em = $this->getDoctrine()->getManager();

        $reclamation= $em->getRepository('KidzyBundle:Reclamations')->findAll();
        $repository= $this->getDoctrine()->getManager()->getRepository(Reclamations::class);
        $listes= $repository->myfindrec();
        $data=array();
        $a=['etatRec','NB'];
        array_push($data,$a);
        foreach($listes as $c){
            $a=array($c['etatRec'],$c['NB']);
            array_push($data,$a);

    }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Réclamation ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);




        return $this->render('@Kidzy/reclamations/chartsR.html.twig', array('piechart' => $pieChart));



    }




}

