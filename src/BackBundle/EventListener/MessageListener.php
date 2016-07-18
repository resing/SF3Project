<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 17/07/2016
 * Time: 12:30
 */

namespace BackBundle\EventListener;


use BackBundle\Event\MessageEvent;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class MessageListener
{
    private $logger;
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreateUser(MessageEvent $messageEvent)
    {
        $message = $messageEvent->getService();
        $this->logger->info(sprintf(
            'Create Message: ID [%s] BODY [%s] @ %s',
            $message->getId(),
            $message->getName(),
            date('d/m/Y H:i:s')));
        $messageEvent->stopPropagation();
        echo 'ok';
        die;
    }
}