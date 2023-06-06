<?php

namespace App\Command;



use App\Controller\ArticleController;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;



class ArticleContentProviderCommand extends Command
{
    protected static $defaultName='app:article:content_provider';
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
