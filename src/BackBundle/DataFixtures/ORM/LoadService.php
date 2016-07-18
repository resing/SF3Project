<?php

namespace BackBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use BackBundle\Entity\Services;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
/**
 * Description of LoadService
 *
 * @author frup64362
 */
class LoadService extends AbstractFixture implements  ContainerAwareInterface, OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    private $container;
    const Max_NB_STATUS = 10;
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for($i =0;$i< Self::Max_NB_STATUS;++$i)
        {
            $service = new Services();
            $service->setName($faker->text(30));
            $service->setStatus(TRUE);
            $service->setDescription($faker->text(400));
            $service->setDateEnd(new \DateTime('2016-12-12'));
            $service->setDateStart(new \DateTime('now '));
            $service->setCreated(new \DateTime('now '));
            $service->setUpdated(new \DateTime('now '));
            $service->setFamily($this->getReference("famille".rand(0, 4)));
            $manager->persist($service); 
        }
        $manager->flush();
    }
    public  function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function getOrder() 
    {
        return 2;
    }
}
