<?php

namespace KidzyBundle\Controller;

use KidzyBundle\Entity\Frais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Frai controller.
 *
 */
class FraisController extends Controller
{
    /**
     * Lists all frai entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $frais = $em->getRepository('KidzyBundle:Frais')->findAll();

        return $this->render('@Kidzy/frais/index.html.twig', array(
            'frais' => $frais,
        ));
    }

    /**
     * Creates a new frai entity.
     *
     */
    public function newAction(Request $request)
    {
        $frai = new Frais();
        $form = $this->createForm('KidzyBundle\Form\FraisType', $frai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($frai);
            $em->flush();

            return $this->redirectToRoute('frais_show', array('idFrais' => $frai->getIdfrais()));
        }

        return $this->render('@Kidzy/frais/new.html.twig', array(
            'frai' => $frai,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a frai entity.
     *
     */
    public function showAction(Frais $frai)
    {
        $deleteForm = $this->createDeleteForm($frai);

        return $this->render('@Kidzy/frais/show.html.twig', array(
            'frai' => $frai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing frai entity.
     *
     */
    public function editAction(Request $request, Frais $frai)
    {
        $deleteForm = $this->createDeleteForm($frai);
        $editForm = $this->createForm('KidzyBundle\Form\FraisType', $frai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('frais_edit', array('idFrais' => $frai->getIdfrais()));
        }

        return $this->render('@Kidzy/frais/edit.html.twig', array(
            'frai' => $frai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a frai entity.
     *
     */
    public function deleteAction(Request $request, Frais $frai)
    {
        $form = $this->createDeleteForm($frai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($frai);
            $em->flush();
        }

        return $this->redirectToRoute('frais_index');
    }

    /**
     * Creates a form to delete a frai entity.
     *
     * @param Frais $frai The frai entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Frais $frai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('frais_delete', array('idFrais' => $frai->getIdfrais())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
