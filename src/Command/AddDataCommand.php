<?php

namespace App\Command;

use App\Repository\ProductRepository;
use App\Service\ImageOptimizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddDataCommand extends Command
{
    protected static $defaultName = 'app:add-data';
    protected static $defaultDescription = 'Add a short description for your command';

    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var ImageOptimizer
     */
    private $imageOptimizer;
    /**
     * @var string|null
     */
    private $name;
    private $targetDirectory;

    public function __construct(string $name = null, ProductRepository $repository, ImageOptimizer $imageOptimizer, $targetDirectory)
    {
        parent::__construct($name);
        $this->repository = $repository;
        $this->imageOptimizer = $imageOptimizer;
        $this->name = $name;
        $this->targetDirectory = $targetDirectory;
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $p = $this->repository->find(1);
        $image = $this->imageOptimizer->resize($p->getBrochureFileName());
        $image->save($this->targetDirectory.'/test.jpg');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
