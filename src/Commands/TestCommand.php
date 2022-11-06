<?php

namespace Thijsvanderheijden\Adventofcode\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Dotenv\Dotenv;

#[AsCommand(
    name: 'test-challenge',
    description: 'test challenge code',
    aliases: ['test']
)]
class TestCommand extends Command
{

    protected function configure(): void
    {
        (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
        $defaultYear = getenv('DEFAULT_YEAR') ?? date('Y');
        $this
            // configure an argument
            ->addArgument('day', InputArgument::OPTIONAL, 'The day for the stub.', (int)date('d'))
            ->addArgument('year', InputArgument::OPTIONAL, 'The year for the stub.' , $defaultYear);

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $year = $input->getArgument('year') ;
        $day = $input->getArgument('day');

        if ($year < 2015 || $year > date('Y')) {
            $output->writeln([
                "Choose different $year",
            ]);
            return Command::INVALID;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Days' . DIRECTORY_SEPARATOR . 'Year' . $year;
        $testFile = $baseDir . DIRECTORY_SEPARATOR . 'Day' . $day . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Day'.$day.'Test.php';



        if(! file_exists($testFile)){
            $output->writeln([
                "Choose different challenge or create the file.",
            ]);
            return Command::INVALID;
        }
        $output->writeln([

            "Testing! $year day $day",
            '============',
            '',
        ]);

        echo shell_exec(sprintf('./vendor/bin/phpunit --color %s',$testFile));

        return Command::SUCCESS;
    }
}