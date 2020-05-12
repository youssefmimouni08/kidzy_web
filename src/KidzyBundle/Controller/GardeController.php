<?php

namespace KidzyBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use KidzyBundle\Entity\Enfant;
use KidzyBundle\Entity\Garde;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use KidzyBundle\Repository\gardeRepository;

class GardeController extends Controller
{
    /**
     * Lists all garde entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gardes = $em->getRepository('KidzyBundle:Garde')->findAll();

        return $this->render('@Kidzy/garde/index.html.twig', array(
            'gardes' => $gardes,
        ));
    }

    /**
     * Creates a new garde entity.
     *
     */
    public function newAction(Request $request)
    {
        $garde = new Garde();
        $form = $this->createForm('KidzyBundle\Form\GardeType', $garde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($garde);
            $em->flush();

            return $this->redirectToRoute('garde_show', array('idGarde' => $garde->getIdGarde()));
        }

        return $this->render('@Kidzy/garde/new.html.twig', array(
            'garde' => $garde,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a garde entity.
     *
     */
    public function showAction(Garde $garde)
    {
        $deleteForm = $this->createDeleteForm($garde);

        return $this->render('@Kidzy/garde/show.html.twig', array(
            'garde' => $garde,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing frai entity.
     *
     */
    public function editAction(Request $request, Garde $garde)
    {
        $deleteForm = $this->createDeleteForm($garde);
        $editForm = $this->createForm('KidzyBundle\Form\GardeType', $garde);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('garde_edit', array('idGarde' => $garde->getIdGarde()));
        }

        return $this->render('@Kidzy/garde/edit.html.twig', array(
            'garde' => $garde,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a garde entity.
     *
     */
    public function deleteAction(Request $request, Garde $garde)
    {
        $form = $this->createDeleteForm($garde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($garde);
            $em->flush();
        }

        return $this->redirectToRoute('garde_index');
    }

    /**
     * Creates a form to delete a garde entity.
     *
     * @param Garde $garde The garde entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Garde $garde)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('garde_delete', array('idGarde' => $garde->getIdGarde())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function listAction(Request $request, Garde $garde)
    {
        $idGarde = $request->get('idGarde');
        $repository = $this->getDoctrine()->getManager()->getRepository(Garde::class);
        $listenfants=$repository->myListEnfant($idGarde);

        return $this->render('@Kidzy/garde/list.html.twig', array(
            'garde' => $garde,
            'idGarde' => $idGarde,
            'listenfants' => $listenfants,

        ));

    }

    public function detailEnfantAction(Request $request,Garde $garde,Enfant $enfant )
    {
        $idGarde = $request->get('idGarde');
        return $this->render('@Kidzy/garde/detail.html.twig', array(
            'garde' => $garde,
            'idGarde' => $idGarde,
            'enfant' => $enfant,

        ));
    }





    public function gardeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gardes = $em->getRepository('KidzyBundle:Garde')->findAll();

        return $this->render('@Kidzy/garde/garde.html.twig' , array('gardes' => $gardes  ));
    }

    public function newEnfantAction(Request $request)
    {

        return $this->render('@Kidzy/garde/newEnfant.html.twig', array(

        ));
    }

    public function chartsAction()
    {
        $pieChart = new PieChart();
        $em = $this->getDoctrine()->getManager();

        $garde = $em->getRepository('KidzyBundle:Garde')->findAll();
        $repository = $this->getDoctrine()->getManager()->getRepository(Garde::class);
        $listes= $repository->nbreEnfants();
        $data=array();
        $a=['nomGarde', 'NB'];
        array_push($data,$a);
        foreach($listes as $c) {

            $a=array($c['nomGarde'],$c['NB']);
            array_push($data,$a);

        }
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Nombre d\'enfant par garderie ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#0e0c78');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@Kidzy/garde/chart.html.twig', array('piechart' => $pieChart));
    }

    public function printAction(Request $request)
    {



        $html = $this->renderView('@Kidzy/garde/print.html.twig', array(

        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'ListeEnfant.pdf'
        );
    }


}
