<?php
namespace App\Exceptions;

class Exception extends basicException
{
    /**
    * @var string
    */
    protected $status = '404';

    /**
    * @return void
    */
    public function __construct()
    {
        $message = $this->build(func_get_args());
        parent::__construct($message);
    }
}
