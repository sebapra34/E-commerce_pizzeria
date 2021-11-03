<?php

namespace App\Command;

use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RemoveExpiredPaniersCommand extends Command
{
    /**
     * @var EntityManagerInterface 
     */
    private $entityManager;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    protected static $defaultName = 'app:remove-expired-paniers';

    /**
     *
     * @param EntityManagerInterface $entityManager
     * @param OrderRepository $orderRepository
     */
    // construct de RemoveExpiredPaniersCommand.
    public function __construct(EntityManagerInterface $entityManager, OrderRepository $orderRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->orderRepository = $orderRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Supprime les paniers qui son inactive depuis une période définie')
            ->addArgument(
                'days',
                InputArgument::OPTIONAL,
                "Le nombre de jour ou le panier peut etre inactive avant d'etre supprimé",
                2
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $days = $input->getArgument('days');

        if ($days <= 0) {
            $io->error('le nombre de jour doit etre plus grand que 0.');
            return Command::FAILURE;
        }

        // Retire le nombre de jour de la date.
        $limitDate = new \DateTime("- $days days");
        $expiredPaniersCount = 0;

        while($paniers = $this->orderRepository->findPaniersNotModifiedSince($limitDate)) {
            foreach ($paniers as $panier) {
                // Item supprimer en cascade
                $this->entityManager->remove($panier);
            }

            $this->entityManager->flush(); // les supprime aussi dans la BDD
            $this->entityManager->clear(); // Detache tout les objets du Doctrine

            $expiredpaniersCount += count($paniers);
        };

        if ($expiredPaniersCount) {
            $io->success("$expiredPaniersCount panier(s) sont supprimer.");
        } else {
            $io->info('Pas de paniers a supprimer.');
        }

        return Command::SUCCESS;
    }
}
