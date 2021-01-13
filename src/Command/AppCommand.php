<?php

namespace App\Command;

use App\Service\SomeService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppCommand extends Command
{
    private $service;

    public function __construct(SomeService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    protected function configure()
    {
        $this
            ->setName('app:run')
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', 'o', InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // arguments
        $arg1 = $input->getArgument('arg1');
        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }
        // options
        if ($opt1 = $input->getOption('option1')) {
            $io->note(sprintf('You passed an option1: %s', $opt1));
        }
        // process
        foreach ($this->service->getData() as $data) {
            $io->writeln(sprintf('data: %d', $data));
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return self::SUCCESS;
    }
}
