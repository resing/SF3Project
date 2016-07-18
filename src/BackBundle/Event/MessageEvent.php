<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 17/07/2016
 * Time: 12:27
 */

namespace BackBundle\Event;



use BackBundle\Entity\Services;
use Symfony\Component\EventDispatcher\Event;
use UtilisateursBundle\Entity\Utilisateurs;

class MessageEvent extends Event
{
    const EVENT_NAME_PREFIX = 'application_backend.event';

    private $service;

    public function __construct(Services $service)
    {
        $this->service = $service;
    }
    public function getService()
    {
        return $this->service;
    }

}