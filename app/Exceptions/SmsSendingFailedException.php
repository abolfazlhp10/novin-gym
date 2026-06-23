<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class SmsSendingFailedException extends Exception
{
    public function __construct(public readonly Response $response)
    {
        $message = "Error on the sending sms => status code : {$this->response->status()}";
        parent::__construct($message);
    }
}
