<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 15/07/2016
 * Time: 15:06
 */

namespace BackBundle\Event;


use Monolog\Logger;

class EmailAvailabilityListener
{
    public function sendEmailToUsers(EmailAvailableEvent $event)
    {
        $user = $event->getEmail();
        $logger = new Logger();
        $logger->info('yyyy'.$user);
    }
}