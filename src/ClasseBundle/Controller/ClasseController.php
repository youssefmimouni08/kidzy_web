<?php

namespace ClasseBundle\Controller;

use KidzyBundle\Entity\Classe;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



/**
 * Classe controller.
 *
 */
class ClasseController extends Controller
{
    /**
     * Lists all classe entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $classes = $em->getRepository('KidzyBundle:Classe')->findAll();

        return $this->render('@Classe/classe/index.html.twig', array(
            'classes' => $classes,
        ));
    }
    /**
     * Creates a new classe entity.
     *
     */
    public function newAction(Request $request)
    {
        $classe = new Classe();
        $form = $this->createForm('ClasseBundle\form\ClasseType', $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('classe_show', array('idClasse' => $classe->getIdclasse()));
        }

        return $this->render('@Classe/classe/new.html.twig', array(
            'classe' => $classe,
            'form' => $form->createView(),
        ));

    }

    /**
     * Finds and displays a classe entity.
     *
     */
    public function showAction(Classe $classe)
    {
        $deleteForm = $this->createDeleteForm($classe);

        return $this->render('@Classe/classe/show.html.twig', array(
            'classe' => $classe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing classe entity.
     *
     */
    public function editAction(Request $request, Classe $classe)
    {
        $deleteForm = $this->createDeleteForm($classe);
        $editForm = $this->createForm('ClasseBundle\form\ClasseType', $classe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classe_edit', array('idClasse' => $classe->getIdclasse()));
        }

        return $this->render('@Classe/classe/edit.html.twig', array(
            'classe' => $classe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a classe entity.
     *
     */
    public function deleteAction(Request $request, Classe $classe)
    {
        $form = $this->createDeleteForm($classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($classe);
            $em->flush();
        }

        return $this->redirectToRoute('classe_index');
    }

    /**
     * Creates a form to delete a classe entity.
     *
     * @param Classe $classe The classe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Classe $classe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('classe_delete', array('idClasse' => $classe->getIdclasse())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function exportAction()
    {
        $webDirectory = $this->get('kernel')->getProjectDir() . '/web';
        $excelFilepath =  $webDirectory . '/classe.csv';
        $em= $this->getDoctrine()->getManager();
        $classes = $em->getRepository('KidzyBundle:Classe')->findAll();
        #Writer
        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Liste des classee']);
        $csv->insertOne(['    ']);
        $csv->insertOne(['id_classe' , 'Libelle classe' , 'Description']);
        foreach ($classes as $classe) {
            $csv->insertOne([$classe->getIdClasse() , $classe->getLibelleCla() ,$classe->getDescription()]);
        }
        $csv->output('classe.csv');
        die;
    }
}
