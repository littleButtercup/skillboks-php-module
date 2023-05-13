<?php

namespace App\Command;


use App\ArticleContentProvider;
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
    private $art;
    public function __construct(ArticleController $art)
    {
        $this->art = $art;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('выводит переданные параметры')
//            ->addArgument('paragraphs', InputArgument::OPTIONAL, 'Paragraphs number',4)
//            ->addArgument('word', InputArgument::OPTIONAL, 'Additional word', 'SSSS')
//            ->addArgument('wordsCount', InputArgument::OPTIONAL, 'Additional word repeat number', 0)
//            ->addOption('option1', null, InputOption::VALUE_REQUIRED, 'Option description')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $articleContent = $this->art->createWords();

            $io->write(json_encode($articleContent));

        return Command::SUCCESS;
    }
}
