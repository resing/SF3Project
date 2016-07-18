<?php

namespace FrontBundle\Controller;

use BackBundle\Entity\Adminis;
use BackBundle\EventListener\OrderPlacedEvent;
use BackBundle\Services\GetForm;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BackBundle\Entity\CmdQuotidien;
use BackBundle\Entity\Services;
use BackBundle\Entity\CmdHouse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/accueil")
     */
    public function indexAction()
    {
        
        $em       = $this->getDoctrine()->getManager();
        $familys  = $em->getRepository('BackBundle:Family')->findBy(array('status'=> TRUE));
        return $this->render('front/index.html.twig',array('familys' => $familys));
    }
    /**
     * @Route("/listservices/{slug}",name = "services")
     *      
     */
    public function listServiceAction($slug)
    {
        $em       = $this->getDoctrine()->getManager();
        $family   = $em->getRepository('BackBundle:Family')->findOneBy(array('slug' => $slug));
        return $this->render('front/services.html.twig',array('services' => $family->getServices()));
    }
    /**
     * @Route("/detailservice/{slug}",name = "detail")
     * 
     */
    public function detailServiceAction($slug)
    {
        $em        = $this->getDoctrine()->getManager();
        $service   = $em->getRepository('BackBundle:Services')->findOneBy(array('slug' =>$slug));
        return $this->render('front/single.html.twig',array('service' => $service));
    }
    /**
     * @Route("/reserve/{idService}", name="reservation")
     * @Method({"GET", "POST"})
     */
    public function reservationAction(Request $request,$idService)
    {
        $em        = $this->getDoctrine()->getManager();
        $service   = $em->getRepository('BackBundle:Services')->find($idService);

        $redirect = $this->container->get('redirection')->redirect($service);

        return new RedirectResponse($redirect);
    }
    /**
     * @Route("/addreserve/{service}", name="addreservation")
     * @Method({"GET", "POST"})
     */
    public function addReservationAction(Request $request,Services $service)
    {
        $cmdQuotidien = new CmdQuotidien();
        $cmdhouse     = new CmdHouse();
        $adminis      = new Adminis();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $form = $this->container->get('service_name')->formget($service);
        $em   = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid())
        {

            $idFamily = $service->getFamily()->getId();
            
            switch ($idFamily):
                case GetForm::NUM_SERVICE:
                    $cmdQuotidien->setUtilisateur($user);
                    $cmdQuotidien->setService($service);
                    $dateLiv = \DateTime::createFromFormat("Y-m-d",$request->request->get('cmd_quotidien')['dateliv']);
                    $cmdQuotidien->setDateliv($dateLiv);
                    $cmdQuotidien->setQuantity($request->request->get('cmd_quotidien')['quantity']);
                    $em->persist($cmdQuotidien);
                    $em->flush();
                    break;
                case GetForm::NUM_HOUSE:
                    $cmdhouse->setUtilisateur($user);
                    $cmdhouse->setService($service);
                    $cmdhouse->setNature($request->request->get('cmd_house')['nature']);
                    $cmdhouse->setCouleur($request->request->get('cmd_house')['couleur']);
                    $cmdhouse->setQuantity($request->request->get('cmd_house')['quantity']);
                    $em->persist($cmdhouse);
                    $em->flush();
                    break;
                case GetForm::ADMINIS:
                    $adminis->setUtilisateur($user);
                    $adminis->setService($service);
                    $adminis->setQuantity($request->request->get('adminis')['quantity']);
                    $adminis->setName($request->request->get('adminis')['name']);
                    $adminis->file = $request->files->get('adminis')['file'];

                    $em->persist($adminis);
                    $em->flush();
                    break;
                case GetForm::RELAX:
                    $view = NULL;
                    break;
            endswitch;
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }
        $template = $this->templating($service);
        return $this->render($template, array('form' => $form->createView(),'service' => $service));
    }

    private function templating(Services $service)
    {
        $idFamily = $service->getFamily()->getId();
        switch ($idFamily):
            case GetForm::NUM_SERVICE:
                $view = 'front/quotidien.html.twig';
                break;
            case GetForm::NUM_HOUSE:
                $view = 'front/house.html.twig';
                break;
            case GetForm::RELAX:
                $view = NULL;
                break;
            case GetForm::ADMINIS:
                $view = 'front/admin.html.twig';
                break;
            default:
                $view = NULL;
        endswitch;
        return $view;
    }
    /**
     * @Route("/addhome/{service}", name="addhome")
     * @Method({"GET","POST"})
     */
    public function ServiceHomeAction (Request $request,Services $service)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $home  = new CmdHouse();
        $form = $this->createForm('BackBundle\Form\CmdHouseType', $home);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $home->setUtilisateur($user);
            $home->setService($service);
            $em->persist($home);
            $em->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

        }

        return $this->render('front/house.html.twig', array('form' => $form->createView(),'service' => $service));
    }
    /**
     * @Route("/addquotidien/{service}", name="addquotidien")
     * @Method({"GET","POST"})
     */
    public function Servicequotifien(Request $request, Services $service)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $quotidien  = new CmdQuotidien();
        $form = $this->createForm('BackBundle\Form\CmdQuotidienType', $quotidien);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $quotidien->setUtilisateur($user);
            $quotidien->setService($service);
            $em->persist($quotidien);
            $em->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }

        return $this->render('front/quotidien.html.twig', array('form' => $form->createView(),'service' => $service));
    }
}
