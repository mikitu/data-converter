<?php

namespace App\Helper;

class InvalidDataSourceException extends \Exception
{
    // Redefine the exception to send a custom message
    public function __construct() {
        $message = 'Invalid data source applied';
        parent::__construct($message);
    }
}