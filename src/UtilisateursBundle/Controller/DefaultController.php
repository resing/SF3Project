<?php

namespace UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Bundle\Bundle;


class DefaultController extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

   

}