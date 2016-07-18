<?php

namespace BackBundle\Command;

use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Validator\Constraints\IsTrue;
use UtilisateursBundle\Entity\Utilisateurs;
class ImportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('import:csv')
            ->setDescription('Import users from CSV file');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
        $this->import($input, $output);
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

    }
    protected function import(InputInterface $input, OutputInterface $output)
    {
        $data = $this->get();
        // Getting doctrine manager
        $em = $this->getContainer()->get('doctrine')->getManager();
        // Turning off doctrine default logs queries for saving memory
        $em->getConnection()->getConfiguration()->setSQLLogger(null);
        // Define the size of record, the frequency for persisting the data and the current index of records
        $size = count($data);
        $batchSize = 2;
        $i = 1;
        $active = TRUE;

        $progress = new ProgressBar($output, $size);
        $progress->start();
        /** @var $logger LoggerInterface */
        foreach($data as $row) {
            $user = new Utilisateurs();
            $user->setPlainPassword('p@ssword');
            $user->setUsername($row['login']);
            $user->setEmail($row['email']);
            $user->setEnabled($active);
            $em->persist($user);
            if (($i % $batchSize) === 0) {

                $em->flush();
                $em->clear();
                $progress->advance($batchSize);
                $now = new \DateTime();
                $output->writeln(' of users imported ... | ' . $now->format('d-m-Y G:i:s'));
            }
            $i++;
        }

        // Flushing and clear data on queue
        $em->flush();
        $em->clear();

        // Ending the progress bar process
        $progress->finish();
    }

    protected function get()
    {
        $fileName = 'web/uploads/test.csv';
        $converter = $this->getContainer()->get('import.csvtoarray');
        $data = $converter->convert($fileName, ';');

        return $data;
    }
}
