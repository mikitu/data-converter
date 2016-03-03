<?php

namespace App;

use App\Contract\DataConverterInterface;
use App\Contract\DataSourceInterface;
use App\Contract\OutputInterface;

class DataConverter implements DataConverterInterface
{
    /**
     * @var InputDataSource
     */
    private $inputDataSource;

    /**
     * DataConverter constructor.
     * @param InputDataSource $input
     */
    public function __construct(DataSourceInterface $input)
    {
        $this->inputDataSource = $input;
    }

    /**
     * @param OutputFormat $outputFormat
     * @return mixed
     */
    public function convertTo(OutputInterface $output)
    {
        $output->setDataSource($this->inputDataSource);
        return $output->convert();
    }
}
