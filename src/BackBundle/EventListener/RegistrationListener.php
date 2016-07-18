<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 02/07/2016
 * Time: 21:05
 */

namespace BackBundle\EventListener;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(FOSUserEvents::REGISTRATION_SUCCESS => 'onRegisterSucces',
            );
    }

    public function onRegisterSucces(FormEvent $event)
    {
        $role = array('ROLE_USER');
        $user = $event->getForm()->getData();
        $user->setRoles($role);
    }

}