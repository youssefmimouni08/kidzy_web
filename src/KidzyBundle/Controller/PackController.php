<?php

namespace KidzyBundle\Controller;



use AppBundle\Entity\mediaEntity;
use Doctrine\ORM\Query;
use http\Client\Response;
use KidzyBundle\Entity\attachment;
use KidzyBundle\Entity\Facture;
use KidzyBundle\Entity\Pack;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Pack controller.
 *
 */
class PackController extends Controller
{
    /**
     * Lists all pack entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('KidzyBundle:Pack')->findAll();

        return $this->render('@Kidzy/pack/index.html.twig', array(
            'packs' => $packs
        ));
    }

    /**
     * Creates a new pack entity.
     *
     */
    public function newAction(Request $request )
    {
        $pack = new Pack();
        $form = $this->createForm('KidzyBundle\Form\PackType', $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pack->setPrixPackyear(($pack->getPrixPack()*7)-($pack->getPrixPack()*0.2));

            $em->persist($pack);
            $em->flush();


            return $this->redirectToRoute('pack_show', array('idPack' => $pack->getIdpack()));
        }

        return $this->render('@Kidzy/pack/new.html.twig', array(
            'pack' => $pack,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pack entity.
     *
     */
    public function showAction(Pack $pack)
    {
        $deleteForm = $this->createDeleteForm($pack);

        return $this->render('@Kidzy/pack/show.html.twig', array(
            'pack' => $pack,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pack entity.
     *
     */
    public function editAction(Request $request, Pack $pack)
    {
        $deleteForm = $this->createDeleteForm($pack);
        $editForm = $this->createForm('KidzyBundle\Form\PackType', $pack);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $pack->setPrixPackyear(($pack->getPrixPack()*7)-($pack->getPrixPack()*0.2));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pack_edit', array('idPack' => $pack->getIdpack()));
        }

        return $this->render('@Kidzy/pack/edit.html.twig', array(
            'pack' => $pack,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pack entity.
     *
     */
    public function deleteAction(Request $request, Pack $pack)
    {
        $form = $this->createDeleteForm($pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pack);
            $em->flush();
        }

        return $this->redirectToRoute('pack_index');
    }

    /**
     * Creates a form to delete a pack entity.
     *
     * @param Pack $pack The pack entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pack $pack)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pack_delete', array('idPack' => $pack->getIdpack())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function pricingAction()
    {
        $em = $this->getDoctrine()->getManager();
        $packs = $em->getRepository('KidzyBundle:Pack')->findAll();
        $frais = $em->getRepository('KidzyBundle:Frais')->findAll();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->render('@Kidzy/pack/pricing.html.twig' , array('packs' => $packs ,'parent' => $user,'frais'=>$frais));
    }
    public function buyAction(Request $request )
    {
        $end = $request->get('due');
        $prix = $request->get('amount');
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('idPack');
        $idEnfant = $request->get('enfant');
        $pack = $em->getRepository('KidzyBundle:Pack')->find($id);
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $idParent = $user->getId();

        \Stripe\Stripe::setApiKey('sk_test_8TNB5HaJ0H5lWP5qMso3OWDI00syLPhFY3');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'name' => $pack->getNomPack(),
                'description' => $pack->getDescriptionPack(),
                'images' => ['https://image.freepik.com/free-vector/e-mail-news-subscription-promotion-flat-vector-illustration-design-newsletter-icon-flat_1200-330.jpg'],
                'amount' => $request->get('amount')*100,
                'currency' => 'usd',
                'quantity' => 1,
            ]],
            'success_url' => 'http://localhost/kidzy_web/web/app_dev.php/kidzy/packs/success/'.$id.'/'.$idEnfant.'/'.$prix.'/'.$end.'/{CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost/kidzy_web/web/app_dev.php/kidzy/packs/'.$id.'/'.$prix.'/'.$end.'/buy?enfant='.$idEnfant,
        ]);


        return $this->render('@Kidzy/pack/confirm.html.twig' , array('pack' => $pack , 'CHECKOUT_SESSION_ID'=>$session->id ,'enfant' =>$enfant ));
    }

    public function successAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('idPack');
        $idEnfant = $request->get('idEnfant');
        $pack = $em->getRepository('KidzyBundle:Pack')->find($id);
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $idParent = $request->get('idParent');
        $userManager = $this->container->get('fos_user.user_manager');
        //$parent = $userManager->findUserBy(array('id'=>$idParent));
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $facture = new Facture();
        $prix = $request->get('prix');
        $due =$request->get('end') ;
        $facture->setDateFacture(new \DateTime());
        $facture->setdue_dateFacture($due);
        $facture->setPack($pack);
        $facture->setPaye(true);
        $facture->setTotal($prix);
        $facture->setIdParent($user);
        $facture->setIdEnf($enfant);
        $facture->setStatus(0);
        $em->persist($facture);
        $em->flush();

        return $this->render('@Kidzy/pack/success.html.twig' , array('due'=>$due,'prix'=>$prix,'user' => $user , 'pack' => $pack , 'enfant' => $enfant ,'facture' => $facture));
    }

    public function factureAction()
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('KidzyBundle:Facture')->findAll();

        return $this->render('@Kidzy/pack/facture.html.twig', array(
            'factures' => $factures,
        ));
    }

    public function printAction(Request $request)
    {   $prix = $request->get('prix');
        $due = $request->get('end');

        $idParent = $request->get('idParent');
        $idEnfant = $request->get('idEnfant');
        $idPack = $request->get('idPack');
        $idFacture = $request->get('idFacture');
        $em = $this->getDoctrine()->getManager();
        $pack = $em->getRepository('KidzyBundle:Pack')->find($idPack);
        $enfant = $em->getRepository('KidzyBundle:Enfant')->find($idEnfant);
        $facture = $em->getRepository('KidzyBundle:Facture')->find($idFacture);
        $userManager = $this->container->get('fos_user.user_manager');
        $parent = $userManager->findUserBy(array('id'=>$idParent));


        $html = $this->renderView('@Kidzy/pack/print.html.twig', array(
            'enfant'  => $enfant,
            'parent' => $parent,
            'pack' => $pack,
            'facture' => $facture,
            'prix'=>$prix,
            'enddate'=>$due
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'facture.pdf'
        );
    }
    public function statusAction(){
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $q = $qb->update('KidzyBundle:Facture', 'f')
            ->set('f.status', '?1')
            ->where('f.status = ?2')
            ->setParameter(1, 1)
            ->setParameter(2, 0)
            ->getQuery();
        $p = $q->execute();

        $query = $em->createQuery('SELECT f FROM KidzyBundle:Facture f WHERE f.status = :status')->setParameter('status', 0);

        $results = $query->getResult();
        return $this->json(['code' => 200,'message'=>'status updated','count'=>$results],200);
    }
    public function countAction(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT f FROM KidzyBundle:Facture f WHERE f.status = :status')->setParameter('status', 0);
        $results = $query->getResult();
        return $this->render('@Kidzy/pack/notif_count.html.twig', array(
            'count' => $results,
        ));
    }
    public function attachAction(){
        $em = $this->getDoctrine()->getManager();

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $this->render('@Kidzy/pack/attachement.html.twig', array(
            'parent' => $user,
        ));
    }


    public function fileUploadHandlerAction(Request $request) {
        $output = array('uploaded' => false);
        // get the file from the request object
        $file = $request->files->get('file');
        // generate a new filename (safer, better approach), but to use original filename instead, use $fileName = $file->getClientOriginalName();
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        // set your uploads directory
        $uploadDir = $this->get('kernel')->getRootDir() . '/../web/uploads/';
        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }
        if ($file->move($uploadDir, $fileName)) {
            // get entity manager
            $em = $this->getDoctrine()->getManager();

            // create and set this mediaEntity
            $attachment = new attachment();
            $attachment->setFileName($fileName);
            $id=$request->get('idEnfant');
            $enfant = $em->getRepository('KidzyBundle:Enfant')->find($id);
            $attachment->setIdEnfant($enfant);

            // save the uploaded filename to database
            $em->persist($attachment);
            $em->flush();
            $output['uploaded'] = true;
            $output['fileName'] = $fileName;
            $output['enfant'] = $enfant;
            $output['mediaEntityId'] = $attachment->getId();
            $output['originalFileName'] = $file->getClientOriginalName();
        };

        return new JsonResponse($output);

    }

    public function deleteResourceAction(Request $request){
        $output = array('deleted' => false, 'error' => false);
        $mediaID = $request->get('id');
        $fileName = $request->get('fileName');
        $em = $this->getDoctrine()->getManager();
        $media = $em->find('AppBundle:mediaEntity', $mediaID);
        if ($fileName && $media && $media instanceof attachment) {
            $uploadDir = $this->get('kernel')->getRootDir() . '/../web/uploads/';
            $output['deleted'] = unlink($uploadDir.$fileName);
            if ($output['deleted']) {
                // delete linked mediaEntity
                $em = $this->getDoctrine()->getManager();
                $em->remove($media);
                $em->flush();
            }
        } else {
            $output['error'] = 'Missing/Incorrect Media ID and/or FileName';
        }
        return new JsonResponse($output);
    }



}
