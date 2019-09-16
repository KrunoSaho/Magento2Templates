<?php
namespace Kruno\Spreadsheet\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Magento\Framework\Exception\LocalizedException;


class TestScript extends Command {

    public function __construct(
        \Magento\Framework\App\State $state,
        // Others
        \Kruno\Spreadsheet\Api\RowRepositoryInterface $rowRep
    ) {

        $this->state = $state;

        // Others
        $this->rowRep = $rowRep;

        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->state->setAreaCode('adminhtml');
        // $file = $input->getArgument('file');

        var_dump($this->rowRep->get(1320)->getRow());

        echo PHP_EOL . 'DONE!' . PHP_EOL;
    }


    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('kruno:testScript')
            ->setDescription('Does Misc things.')
            ->setDefinition([
                new InputArgument(
                    'file',
                    InputArgument::OPTIONAL,
                    'File'
                )
            ]);

        parent::configure();
    }

}
