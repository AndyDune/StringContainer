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
use AndyDune\StringContainer\Action\RemoveDuplicateSpaces;
use AndyDune\StringContainer\Action\RemoveDuplicateWords;
use Closure;


/**
 * Class StringContainer
 *
 * @method StringContainer removeDuplicateSpaces
 * @method removeDuplicateWords
 *
 * @package AndyDune\StringContainer
 */
class StringContainer
{
    protected $actionMethodClasses = [
        'removeduplicatespaces' => RemoveDuplicateSpaces::class,
        'removeduplicatewords' => RemoveDuplicateWords::class,
    ];

    protected $string;

    public function __construct($string = '')
    {
        $this->setString($string);
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this
     * @throws Exception
     */
    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        if (array_key_exists($name, $this->actionMethodClasses)) {
            $value = $this->actionMethodClasses[$name];
            if ($value instanceof Closure) {
                array_unshift($arguments, $this);
                call_user_func_array([$value, 'call'], $arguments);
                return $this;
            }
            $instance = new $this->actionMethodClasses[$name]($this);
            call_user_func_array($instance, $arguments);
            return $this;
        }
        throw new Exception(['No action class for method: %s', $name]);
    }

    /**
     * @param null|string $string
     * @return string
     */
    public function __invoke($string = null)
    {
        if ($string !== null) {
            $this->setString($string);
        }
        return $this->getString();
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @param $string
     * @return $this
     */
    public function setString($string)
    {
        $this->string = $string;
        return $this;
    }

}