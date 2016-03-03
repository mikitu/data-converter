<?php

namespace App\Contract;


interface DataConverterInterface
{
    /**
     * @param OutputInterface $output
     * @return mixed
     */
    public function convertTo(OutputInterface $output);
}