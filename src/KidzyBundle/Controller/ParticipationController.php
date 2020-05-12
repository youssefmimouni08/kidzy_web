<?php

namespace KidzyBundle\Controller;


use KidzyBundle\Entity\Participation;
use KidzyBundle\Entity\Enfant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Inscription controller.
 *
 */
class ParticipationController extends Controller
{
    /**
     * Lists all Participation entities.
     *
     */
    public function listeAction(Request $request )
    {        $idEvent = $request->get('idEvent');
        $repository = $this->getDoctrine()->getManager()->getRepository(Participation::class);
        $listenfants=$repository->myfinfDomaine($idEvent);

        return $this->render('@Kidzy/event/listeAdmin.html.twig', array('liste' => $listenfants,'idEvent'=>$idEvent));

    }
    public function showAction( Request $request)
    {
        $idParticipation = $request->get('idParticipation');
        $idEvent = $request->get('idEvent');
        $idEnfant = $request->get('idEnfant');

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('KidzyBundle:Club')->find($idEvent);
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $Participation = $em->getRepository('KidzyBundle:Participation')->find($idParticipation);

        $deleteForm = $this->createDeleteForm($Participation,$idParticipation);


        return $this->render('@Kidzy/participation/show.html.twig', array(
            'event' => $event,
            'enfant' => $enfant,
            'participation' => $Participation,
            'delete_form' => $deleteForm->createView()


        ));
    }
    public function showParentAction(Request $request,Participation $participation)
    {
        $id = $request->get('idParticipation');

        $idEvent = $request->get('idEvent');
        $idEnfant = $request->get('idEnfant');
        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $events = $em->getRepository('KidzyBundle:Event')->find($idEvent);
        $participation = $em->getRepository('KidzyBundle:Participation')->find($id);

        $deleteForm = $this->createDeleteFrontForm($participation);
        $repository = $this->getDoctrine()->getManager()->getRepository(Participation::class);


        $details=$repository->myfinfEventDetails($idEvent,$idEnfant,$id);
        return $this->render('@Kidzy/club/showParent.html.twig', array(
            'enfant' => $enfant,
            'events' => $events,
            'participation' => $participation,

            'delete_form' => $deleteForm->createView()
        ));
    }
    private function createDeleteForm(Participation $Participation,$idEvent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participation_delete', array('idParticipation' => $Participation->getIdParticipation(),'idEvent' =>$idEvent)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    private function createDeleteFrontForm(Participation $Participation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('participation_delete_Front', array('idParticipation' => $Participation->getIdParticipation())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function deleteAction(Request $request, Participation $event, $idEvent)
    {
        $form = $this->createDeleteForm( $event,$idEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove( $event);
            $em->flush();

        } return $this->redirectToRoute('participation_enfantAdmin',array('idEvent' => $idEvent));
    } public function deleteFrontAction(Request $request, Inscription $event)
{
    $form = $this->createDeleteFrontForm( $event);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove( $event);
        $em->flush();
    } return $this->redirectToRoute('eventParent');
}

    public function newAction(Request $request)

    {
        $idEvent = $request->get('idClub');
        $em = $this->getDoctrine()->getManager();

        $club = $em->getRepository('KidzyBundle:Club')->find($idClub);
        $repository = $this->getDoctrine()->getManager()->getRepository(Inscription::class);
        $listenfants=$repository->myfinfDomaine($idClub);


        $inscription = new Inscription();
        $form = $this->createForm('KidzyBundle\Form\InscriptionType', $inscription);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getManager()->getRepository(Inscription::class);
        $existe=$repository->myfinfInsc($inscription->getIdEnfant(),$inscription->getIdClub());

        if ($form->isSubmitted() && $form->isValid()&& !$existe) {

            $today = new \DateTime('now');
            $inscription->setDateInscrit($today);
            $em->persist($inscription);
            $em->flush();

            $this->addFlash('info', 'Enfant inscrit avec succés');
            return $this->redirectToRoute('inscription_enfantAdmin',array('idClub' => $club->getIdClub()));



        }else if ($existe)  {

            $this->addFlash('info', 'Enfant inscrit déja');


            }



        return $this->render('@Kidzy/inscription/new.html.twig', array(

        'club' => $idClub,

            'inscription' => $inscription,
            'liste' => $listenfants,
            'form' => $form->createView(),
        ));
    }
    public function newFrontAction(Request $request)

    {



        $inscription = new Participation();
        $form = $this->createForm('KidzyBundle\Form\ParticipationType', $inscription);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();



        if ($form->isSubmitted() && $form->isValid()) {

            $today = new \DateTime('now');
            $inscription->setDatePartici($today);
            $em->persist($inscription);
            $em->flush();

            return $this->redirectToRoute('event');




        }else{ }



        return $this->render('@Kidzy/event/newPaticipation.html.twig', array(


            'inscription' => $inscription,
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, Inscription $Inscription)
    {
        $idClub = $request->get('idClub');
        $idEnfant = $request->get('idEnfant');
        $editForm = $this->createForm('KidzyBundle\Form\DescriptionType', $Inscription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscription_show', array('idInscrit' => $Inscription->getIdInscrit(),'idEnfant' => $idEnfant,'idClub' => $idClub));
        }

        return $this->render('@Kidzy/inscription/edit.html.twig', array(
            'inscription' => $Inscription,
            'idClub' => $idClub,
            'enfant' => $idEnfant,
            'edit_form' => $editForm->createView(),

        ));
    }

    public function newpAction(Request $request)

    {

        $inscription = new Participation();
        $form = $this->createForm('KidzyBundle\Form\ParticipationType', $inscription);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();



        if ($form->isSubmitted() && $form->isValid()) {

            $today = new \DateTime('now');
            $inscription->setDatePartici($today);
            $em->persist($inscription);
            $em->flush();

            return $this->redirectToRoute('inscription_enfantAdmin\',array(\'idEvent\' => $event->getIdEvent())');




        }else{ }



        return $this->render('@Kidzy/event/newp.html.twig', array(


            'inscription' => $inscription,
            'form' => $form->createView(),
        ));

    }

   }