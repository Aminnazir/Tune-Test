<?php

namespace App\Lib\FormBuilder\Filters\Exception;

use App\Lib\FormBuilder\Filters\FilterInterface;
use Throwable;

/**
 * Class InvalidInstanceException
 *
 * @package App\Lib\FormBuilder\Filters\Exception
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
class InvalidInstanceException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Filter object must implement ' . FilterInterface::class;
        parent::__construct($message, $code, $previous);
    }
}
