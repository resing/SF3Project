<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 14/07/2016
 * Time: 16:30
 */

namespace BackBundle\EventListener;


use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class FirstConnectionListener implements EventSubscriber
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function getSubscribedEvents()
    {
        return array(
            'postUpdate',
        );
    }
    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    

}