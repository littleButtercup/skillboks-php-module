<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UserDeactivateCommand extends Command
{
    /**
     * @var UserRepository
     * @var EntityManagerInterface
     */
    private $userRepository, $em;

    /**
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     */
    public function __construct(EntityManagerInterface $em, UserRepository $userRepository)
    {
        parent::__construct();
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    protected static $defaultName = 'app:user:deactivate';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('reverse', null, InputOption::VALUE_NONE, 'Option description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');
        $user = $this->userRepository->findOneBy(['id' => $id]);

        if ($user->getId()) {
            $userFirstName = $user->getFirstName();
            $io->title('Активность пользователя: ' . $userFirstName);
        }else{
            throw new \Exception('неверный id');
        }

        if ($input->getOption('reverse')) {
            if ($user->isIsActive()) {
                $this->userRepository->findOneBy(['id' => $user->getId()])->setIsActive(false);
            }else {
                $this->userRepository->findOneBy(['id' => $user->getId()])->setIsActive(true);
            }
            $this->em->flush();
        }

        $io->success('Активность изменилась');

        return Command::SUCCESS;
    }
}
