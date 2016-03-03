<?php

namespace App\Contract;

interface OutputInterface
{
    /**
     * @return mixed
     */
    public function convert();

    /**
     * @param DataSourceInterface $ds
     * @return mixed
     */
    public function setDataSource(DataSourceInterface $ds);

    /**
     * @return mixed
     */
    public function validateDataSource();

    /**
     * @return mixed
     */
    public function getConverted();
}
