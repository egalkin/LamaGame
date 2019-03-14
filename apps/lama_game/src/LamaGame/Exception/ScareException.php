<?php
/**
 * Created by PhpStorm.
 * User: elama
 * Date: 01.03.19
 * Time: 11:32
 */

namespace App\LamaGame\Exception;

use Exception;
use Throwable;

/**
 * Exception указывающий на попытку выйти за пределы поля.
 *
 * Class ScareException
 * @package App\LamaGame\Exception
 */
class ScareException extends Exception
{
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}