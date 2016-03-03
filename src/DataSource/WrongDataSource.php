<?php

namespace App\DataSource;

use App\Contract\DataSourceInterface;

class WrongDataSource implements DataSourceInterface
{
    /**
     * @return null
     */
    public function getData()
    {
        return null;
    }
}