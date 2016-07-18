<?php
namespace BackBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use BackBundle\Entity\Family;

/**
 * Description of LoadFamily
 *
 * @author frup64362
 */
class LoadFamily extends AbstractFixture implements  ContainerAwareInterface, OrderedFixtureInterface {
    
    /**
     * {@inheritDoc}
     */
    private $container;
    const Max_NB_STATUS = 5;
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for($i =0;$i< Self::Max_NB_STATUS;++$i)
        {
            
            $family = new Family();
            switch ($i) {
                case 0:
                    $family->setName('SERVICES DU QUOTIDIEN');  
                    break;
                case 1:
                    $family->setName('MAISON – FAMILLE'); 
                    break;
                case 2:
                    $family->setName('VOITURE'); 
                    break;
                case 3:
                    $family->setName('BIEN ETRE'); 
                    break;
                case 4:
                    $family->setName('DEMARCHES ADMINISTRATIVES');
                    break;
            }
            $family->setStatus(TRUE);
            $family->setCreated(new \DateTime('now '));
            $family->setUpdated(new \DateTime('now '));
            $this->addReference("famille".$i, $family);
            $manager->persist($family);  
        }
        $manager->flush();
    }
    
     public  function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    public function getOrder() 
    {
        return 1;
    }
}
