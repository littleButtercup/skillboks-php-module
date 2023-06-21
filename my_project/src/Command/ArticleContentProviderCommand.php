<?php

namespace App\Command;

use App\Service\ArticleService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleContentProviderCommand extends Command
{
    protected static $defaultName='app:article:content_provider';
    private $art;
    public function __construct(ArticleService $art)
    {
        $this->art = $art;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setDescription('выводит переданные параметры');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $articleContent = $this->art->createWords();

        $io->write(json_encode($articleContent));

        return Command::SUCCESS;
    }
}
