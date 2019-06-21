<?php
/**
 *
 * @package andydune/string-container
 * @link  https://github.com/AndyDune/StringContainer for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */


namespace AndyDune\StringContainer;
use Exception as Base;
use Throwable;

class Exception extends Base
{
    /**
     * Exception constructor.
     *
     * $message can be array: ['Max tryes is: %s', 4] - for sprintf function
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = null, Throwable $previous = null)
    {
        if (is_array($message)) {
            $message = call_user_func_array('sprintf', $message);
        }
        parent::__construct($message, $code, $previous);
    }

}