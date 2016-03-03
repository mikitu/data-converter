<?php

namespace App\Output;

use App\Contract\DataSourceInterface;

abstract class AbstractOutput
{
    /*
     * data source to be converted
     */
    protected $ds;

    /*
     * used to store converted data
     */
    protected $convertedObj;

    /**
     * set and validate data source
     * @param DataSourceInterface $ds
     */
    public function setDataSource(DataSourceInterface $ds)
    {
        $this->ds = $ds;
        $this->validateDataSource();
    }

    /**
     * @return mixed
     */
    public function getConverted()
    {
        return $this->convertedObj;
    }

}