<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 17/06/2016
 * Time: 00:35
 */
namespace BackBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use BackBundle\Entity\Services;
use BackBundle\Entity\CmdHouse;
use BackBundle\Entity\CmdQuotidien;
use BackBundle\Entity\Adminis;
class GetForm
{
    const NUM_SERVICE = 1;
    const NUM_HOUSE = 2;
    const CAR = 3;
    const RELAX = 4;
    const ADMINIS = 5;

    public function __construct(EntityManager $entityManager,FormFactory $formFactory)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function formget(Services $service)
    {
        $idFamily = $service->getFamily()->getId();
        switch ($idFamily):
            case SELF::NUM_SERVICE:
                $cmdQuotidien = new CmdQuotidien();
                $form         = $this->formFactory->createBuilder('BackBundle\Form\CmdQuotidienType', $cmdQuotidien)->getForm();
                break;
            case SELF::NUM_HOUSE:
                $cmdHouse =  new CmdHouse();
                $form     = $this->formFactory->createBuilder('BackBundle\Form\CmdHouseType', $cmdHouse)->getForm();
                break;
            case SELF::RELAX:
                $form = NULL;
                break;
            case SELF::ADMINIS:
                $adminis      = new Adminis();
                $form     = $this->formFactory->createBuilder('BackBundle\Form\AdminisType', $adminis)->getForm();
                break;
            default:
                $form = NULL;
        endswitch;
        return $form;
    }
}
?>