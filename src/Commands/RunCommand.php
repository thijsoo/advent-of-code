<?php

namespace Thijsvanderheijden\Adventofcode\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Dotenv\Dotenv;

#[AsCommand(
    name: 'run-challenge',
    description: 'runs challenge code',
    aliases: ['run']
)]
class RunCommand extends Command
{

    protected function configure(): void
    {
        (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
        $defaultYear = getenv('DEFAULT_YEAR') ?? date('Y');
        $this
            // configure an argument
            ->addArgument('part', InputArgument::OPTIONAL, 'Which part to run.', 1)
            ->addArgument('day', InputArgument::OPTIONAL, 'The day for the stub.', (int)date('d'))
            ->addArgument('year', InputArgument::OPTIONAL, 'The year for the stub.' , $defaultYear);

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $part = (int)$input->getArgument('part');
        $year = $input->getArgument('year') ;
        $day = $input->getArgument('day');

        if ($year < 2015 || $year > date('Y')) {
            $output->writeln([
                "Choose different $year",
            ]);
            return Command::INVALID;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Days' . DIRECTORY_SEPARATOR . 'Year' . $year;
        $challengeFilePath = $baseDir . DIRECTORY_SEPARATOR . 'Day' . $day . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Challenge.php';

        if(! file_exists($challengeFilePath)){
            $output->writeln([
                "Choose different challenge or create the file.",
            ]);
            return Command::INVALID;
        }
        $output->writeln([
            "Running $year day $day part $part",
            '============',
            '',
        ]);



        $cname = "Thijsvanderheijden\Adventofcode\Days\Year$year\Day$day\src\Challenge";
        $d1 = new $cname();

        if($part === 1) {
            $output->writeln($d1->solveFirst());

        }else {
            $output->writeln( $d1->solveSecond());
        }


        return Command::SUCCESS;
    }
}