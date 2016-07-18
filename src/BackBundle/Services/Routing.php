<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 03/07/2016
 * Time: 20:22
 */

namespace BackBundle\Services;


use BackBundle\Entity\Services;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Routing
{
    /**
     * @var RouterInterface
     */
    private $router;
    const NUM_SERVICE = 1;
    const NUM_HOUSE = 2;
    const CAR = 3;
    const RELAX = 4;
    const ADMINIS = 5;
    /**
     * @var UrlGenerator     */
    private $urlGenerator;
    /**
     * @var RedirectResponse
     */
    private $response;

    public function __construct(Router $router)
    {

        $this->router = $router;
    }

    public function redirect(Services $service)
    {
        $idFamily = $service->getFamily()->getId();
        $id = $service->getId();
        switch ($idFamily):
            case SELF::NUM_SERVICE:
                $url = $this->router->generate('addquotidien',array('service'=>$id));
                break;
                break;
            case SELF::NUM_HOUSE:
             //   $url = $this->response->getTargetUrl('addhome',array('service'=>$service));
                $url = $this->router->generate('addhome',array('service'=>$id));
                break;
            case SELF::RELAX:
                break;
            case SELF::ADMINIS:
                break;
            default:
                $form = NULL;
        endswitch;

        return $url;
    }
}