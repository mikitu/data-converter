<?php

namespace App\Console\Command;

use App\DataConverter;
use App\DataSource\ArrayDataSource;
use App\Output\ArrayToXml;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertArrayToXmlCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('convert:array-to-xml')
            ->setDescription('Convert Array to xml')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $converter = new DataConverter(new ArrayDataSource);
        $converted = $converter->convertTo(new ArrayToXml);
        $output->writeln("<info>Array converted to:</info>");
        $output->writeln('<comment>' . $converted->getNormalized() . '</comment>');
    }
}