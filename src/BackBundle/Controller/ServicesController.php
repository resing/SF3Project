<?php

namespace BackBundle\Controller;

use BackBundle\Event\MessageEvent;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackBundle\Entity\Services;
use BackBundle\Form\ServicesType;
use UtilisateursBundle\Entity\Utilisateurs;

/**
 * Services controller.
 *
 * @Route("/admin/services")
 */
class ServicesController extends Controller
{


    /**
     * Lists all Services entities.
     *
     * @Route("/", name="admin_services_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $services = $em->getRepository('BackBundle:Services')->findAll();

        return $this->render('services/index.html.twig', array(
            'services' => $services,
        ));
    }

    /**
     * Creates a new Services entity.
     *
     * @Route("/new", name="admin_services_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $service = new Services();
        $message = $this->get('translator')->trans('form.text');
        $form = $this->createForm('BackBundle\Form\ServicesType', $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $dateStart=$request->request->get('services')['dateStart'];
            $dateStart = new \DateTime($dateStart);
            if($dateStart < new \DateTime()){
                $form->addError(new FormError($message));
            } else {
                /*
                 * add listener to send email for user
                 */
                $dispatcher = new EventDispatcher();

                $dispatcher->dispatch(MessageEvent::EVENT_NAME_PREFIX,new MessageEvent($service));
            //    $dispatcher->addListener(EmailEvents::EMAIL_AVAILABLE, array($listener, 'sendEmailToUsers'));


                /*
                 * end listener
                 */
                $em->persist($service);
                $em->flush();
                return $this->redirectToRoute('admin_services_show', array('id' => $service->getId()));
            }
        }
        return $this->render('services/new.html.twig', array(
            'service' => $service,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a Services entity.
     *
     * @Route("/{id}", name="admin_services_show")
     * @Method("GET")
     */
    public function showAction(Services $service)
    {
        $deleteForm = $this->createDeleteForm($service);

        return $this->render('services/show.html.twig', array(
            'service' => $service,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Services entity.
     *
     * @Route("/{id}/edit", name="admin_services_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Services $service)
    {
        $deleteForm = $this->createDeleteForm($service);
        $editForm = $this->createForm('BackBundle\Form\ServicesType', $service);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('admin_services_edit', array('id' => $service->getId()));
        }
        return $this->render('services/edit.html.twig', array(
            'service' => $service,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Services entity.
     *
     * @Route("/{id}", name="admin_services_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Services $service)
    {
        $form = $this->createDeleteForm($service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
        }

        return $this->redirectToRoute('admin_services_index');
    }

    /**
     * Creates a form to delete a Services entity.
     *
     * @param Services $service The Services entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Services $service)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_services_delete', array('id' => $service->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
