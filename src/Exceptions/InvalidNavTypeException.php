<?php

namespace Nurmanhabib\Navigator\Exceptions;

use Throwable;

class InvalidNavTypeException extends \Exception
{
    public function __construct($type)
    {
        $message = 'Invalid Nav Type [' . $type . ']';

        parent::__construct($message);
    }
}