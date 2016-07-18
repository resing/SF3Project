<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 23/06/2016
 * Time: 20:03
 */

namespace BackBundle\EventListener;
use Psr\Log\LoggerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use UtilisateursBundle\Entity\Utilisateurs;

class CreateUserEventListener implements EventSubscriber
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
        );
    }
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }
    
    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Utilisateurs) {
            $this->logger->info($entity->getId());
            $this->logger->info($entity->getEmail());

        }
    }
}