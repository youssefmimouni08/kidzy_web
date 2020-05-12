<?php

namespace KidzyBundle\Controller;

use KidzyBundle\Entity\Inscription;
use KidzyBundle\Entity\Enfant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Inscription controller.
 *
 */
class InscriptionController extends Controller
{
    /**
     * Lists all Inscription entities.
     *
     */
    public function listeAction(Request $request ,$idClub)
    {        $idClub = $request->get('idClub');
        $repository = $this->getDoctrine()->getManager()->getRepository(Inscription::class) ;
        $listenfants=$repository->myfinfDomaine($idClub);

        return $this->render('@Kidzy/inscription/listeAdmin.html.twig', array('liste' => $listenfants,'idClub'=>$idClub));

    }
    public function showAction( Request $request)
    {
        $idInscrit = $request->get('idInscrit');
        $idClub = $request->get('idClub');
        $idEnfant = $request->get('idEnfant');

        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository('KidzyBundle:Club')->find($idClub);
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $Inscrit = $em->getRepository('KidzyBundle:Inscription')->find($idInscrit);

        $deleteForm = $this->createDeleteForm($Inscrit,$idClub);


        return $this->render('@Kidzy/inscription/show.html.twig', array(
            'club' => $club,
            'enfant' => $enfant,
            'inscription' => $Inscrit,
            'delete_form' => $deleteForm->createView()


        ));
    }
    public function showParentAction(Request $request,Inscription $inscription)
    {
        $id = $request->get('idInscrit');

        $idClub = $request->get('idClub');
        $idEnfant = $request->get('idEnfant');
        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $clubs = $em->getRepository('KidzyBundle:Club')->find($idClub);
        $inscrit = $em->getRepository('KidzyBundle:Inscription')->find($id);

        $deleteForm = $this->createDeleteFrontForm($inscription);
        $repository = $this->getDoctrine()->getManager()->getRepository(Inscription::class);


        $details=$repository->myfinfClubDetails($idClub,$idEnfant,$id);
        return $this->render('@Kidzy/club/showParent.html.twig', array(
            'enfant' => $enfant,
            'clubs' => $clubs,
            'inscription' => $inscrit,

            'delete_form' => $deleteForm->createView()
        ));
    }
    public function showParentAAction(Request $request)
    {

        $idClub = $request->get('idClub');
        $em = $this->getDoctrine()->getManager();
        $clubs = $em->getRepository('KidzyBundle:Club')->find($idClub);



        return $this->render('@Kidzy/club/showParentA.html.twig', array(
            'clubs' => $clubs,

        ));
    }

    private function createDeleteForm(Inscription $Inscription,$idClub)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inscription_delete', array('idInscrit' => $Inscription->getIdInscrit(),'idClub' =>$idClub)))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    private function createDeleteFrontForm(Inscription $Inscription)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inscription_delete_Front', array('idInscrit' => $Inscription->getIdInscrit())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function deleteAction(Request $request, Inscription $club, $idClub)
    {
        $form = $this->createDeleteForm( $club,$idClub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove( $club);
            $em->flush();

        } return $this->redirectToRoute('inscription_enfantAdmin',array('idClub' => $idClub));
    } public function deleteFrontAction(Request $request, Inscription $club)
{
    $form = $this->createDeleteFrontForm( $club);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove( $club);
        $em->flush();
    } return $this->redirectToRoute('clubParent');
}

    public function newAction(Request $request)

    {
        $idClub = $request->get('idClub');
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
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idParent = $user->getId();
        $enfants = $em->getRepository('KidzyBundle:Enfant')->find($idParent);


        $repositoryF = $this->getDoctrine()->getManager()->getRepository(Enfant::class);
        $enfant=$repositoryF->myfinfEnfant($idParent);

        $inscription = new Inscription();
        $form = $this->createForm('KidzyBundle\Form\InscriptionFType', $inscription);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $editForms = $this->createForm('KidzyBundle\Form\nomEnfantType', $enfants);
        $editForms->handleRequest($request);
 $repository = $this->getDoctrine()->getManager()->getRepository(Inscription::class);
        $existe=$repository->myfinfInsc($inscription->getIdEnfant(),$inscription->getIdClub());

        if ($form->isSubmitted() && $form->isSubmitted() &&$form->isValid()&& !$existe) {

            $today = new \DateTime('now');
            $inscription->setDateInscrit($today);
            $em->persist($inscription);
            $em->flush();

            $this->addFlash('info', 'Enfant inscrit avec succés');
            return $this->redirectToRoute('clubindexFront');



        }else if ($existe)  {

            $this->addFlash('info', 'Enfant inscrit déja');


        }else{ }



        return $this->render('@Kidzy/inscription/newFront.html.twig', array(

            'enfant' => $enfant,
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
   }