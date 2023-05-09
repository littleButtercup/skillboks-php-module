<?php

namespace App\Command;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\ArticleContentProviderInterface;
use App\Controller\ArticleController;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:article:content_provider',
    description: 'Add a short description for your command',
)]

class ArticleContentProviderCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setDescription('выводит переданные параметры')
            ->addArgument('slug', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_REQUIRED, 'Option description')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
//        $slug = $input->getArgument('slug');

        $data = [
            'paragraphs'=>4,
            'word' => null,
            'wordsCount' => 0
        ];


            $io->write(json_encode($data));


//        if ($input->getOption('format')) {
//            $io->write(json_encode($data));
//        }

//        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
