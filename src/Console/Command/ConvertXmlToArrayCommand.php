<?php

namespace App\Console\Command;

use App\DataConverter;
use App\DataSource\XmlDataSource;
use App\Output\ArrayToXml;
use App\Output\XmlToArray;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertXmlToArrayCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('convert:xml-to-array')
            ->setDescription('Convert Xml to Array')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $converter = new DataConverter(new XmlDataSource);
        $converted = $converter->convertTo(new XmlToArray);
        $output->writeln("<info>Array converted to:</info>");
        $output->writeln('<comment>' . json_encode($converted->getConverted()) . '</comment>');
    }
}