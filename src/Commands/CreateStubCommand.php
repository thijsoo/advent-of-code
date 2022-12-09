<?php

namespace Thijsvanderheijden\Adventofcode\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Dotenv\Dotenv;

#[AsCommand(
    name: 'create-stub',
    description: 'Adds a new stub for the given day and year and loads the input file',
    aliases: ['cs']
)]
class CreateStubCommand extends Command
{

    private OutputInterface $output;


    protected function configure(): void
    {
        (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');
        $defaultYear = getenv('DEFAULT_YEAR') ?? date('Y');

        $this
            // configure an argument
            ->addArgument('day', InputArgument::OPTIONAL, 'The day for the stub.', (int)date('d'))
            ->addArgument('year', InputArgument::OPTIONAL, 'The year for the stub.', $defaultYear)
            ->addArgument('input', InputArgument::OPTIONAL, 'If the input should be loaded (default: true)', true);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $this->output = $output;
        $year = $input->getArgument('year');
        $day = $input->getArgument('day');

        if ($year < 2015 || $year > date('Y')) {
            $this->output->writeln([
                "Choose different $year",
            ]);
            return Command::INVALID;
        }

        $this->output->writeln([
            "Creating files for $year day $day",
            '============',
            '',
        ]);

        (new Dotenv())->usePutenv()->bootEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env');

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Days' . DIRECTORY_SEPARATOR . 'Year' . $year;
        try {
            $this->createDirs($baseDir, $day);
            $this->createChallengeClass($baseDir, $day, $year);
            if ($input->getArgument('input')) {
                $this->createInputFile($baseDir, $day, $year);
            }
            $this->createTests($baseDir, $day, $year);
        } catch (\RuntimeException $exception) {
            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }

    private function createDirs($targetDir, $day)
    {
        $baseDir = $targetDir . DIRECTORY_SEPARATOR . 'Day' . $day;

        $this->createDir($targetDir);
        $this->createDir($baseDir);
        $this->createDir($baseDir . DIRECTORY_SEPARATOR . 'src');
        $this->createDir($baseDir . DIRECTORY_SEPARATOR . 'input');
        $this->createDir($baseDir . DIRECTORY_SEPARATOR . 'tests');
    }

    /**
     * @param string $dirToCreate
     * @return void
     */
    private function createDir(string $dirToCreate): void
    {
        if (!is_dir($dirToCreate) && !mkdir($dirToCreate) && !is_dir($dirToCreate)) {
            $this->output->writeln(sprintf('Directory "%s" was not created', $dirToCreate));
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dirToCreate));
        }
    }

    private function createChallengeClass($targetDir, $day, $year)
    {
        $challengeFilePath = $targetDir . DIRECTORY_SEPARATOR . 'Day' . $day . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Challenge.php';
        $stubPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'stubs/day.stub';

        $this->createFile($challengeFilePath, $stubPath, $day, $year);

    }

    private function createInputFile($baseDir, $day, $year)
    {
        $url = "https://adventofcode.com/$year/day/$day/input";
        $inputFile = $baseDir . DIRECTORY_SEPARATOR . 'Day' . $day . DIRECTORY_SEPARATOR . 'input' . DIRECTORY_SEPARATOR . 'input.txt';
        if (file_exists($inputFile)) {
            $this->output->writeln('Input file already exists.');
            return;
        }

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            sprintf("Cookie: session=%s", getenv('SESSION')),
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $input = curl_exec($curl);
        curl_close($curl);


        file_put_contents($inputFile, $input);
    }

    private function createTests($targetDir, $day, $year)
    {
        $challengeFilePath = $targetDir . DIRECTORY_SEPARATOR . 'Day' . $day . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Day' . $day . 'Test.php';
        $stubPath = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'stubs/test.stub';

        $this->createFile($challengeFilePath, $stubPath, $day, $year);
    }

    private function createFile($mainFilePath, $stubPath, $day, $year)
    {
        if (file_exists($mainFilePath)) {
            $this->output->writeln('File already exists.');
            return;
        }
        $stubContent = file_get_contents($stubPath);

        $stubContent = str_replace('${day}', $day, $stubContent);
        $stubContent = str_replace('${year}', $year, $stubContent);

        file_put_contents($mainFilePath, $stubContent);
    }
}
