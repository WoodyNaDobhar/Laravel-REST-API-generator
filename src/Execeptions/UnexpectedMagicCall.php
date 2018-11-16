<?php
/**
 * Created by PhpStorm.
 * User: datsyuk
 * Date: 16.05.17
 * Time: 10:36
 */

namespace WoodyNaDobhar\Dingo2Generators\Exceptions;


use Throwable;

/**
 * Class UnexpectedMagicCall
 * @package WoodyNaDobhar\Dingo2Generators\Exceptions
 */
class UnexpectedMagicCall extends \Exception
{
    /**
     * UnexpectedMagicCall constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}