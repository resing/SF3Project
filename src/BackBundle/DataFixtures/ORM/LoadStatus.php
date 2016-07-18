<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 06/07/2016
 * Time: 14:05
 */

namespace BackBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use BackBundle\Entity\Status;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadStatus extends AbstractFixture implements ContainerAwareInterface , OrderedFixtureInterface 
{
    /**
     * {@inheritDoc}
     */
    private $container;
    const Max_NB_STATUS = 3;
    public function load (ObjectManager $manager)
    {
        for($i =0;$i< Self::Max_NB_STATUS;++$i)
        {
            $status = new Status();
            switch ($i) {
                case 0:
                    $status->setName('Create');
                    break;
                case 1:
                    $status->setName('prepaid');
                    break;
                case 2:
                    $status->setName('sending');
                    break;
            }
            $manager->persist($status);
        }
        $manager->flush();
    }
    public  function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function getOrder()
    {
        return 4;
    }
}