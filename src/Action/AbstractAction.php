<?php
/**
 *
 * @package andydune/string-container
 * @link  https://github.com/AndyDune/StringContainer for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */


namespace AndyDune\StringContainer\Action;
use AndyDune\StringContainer\StringContainer;

abstract class AbstractAction
{
    /**
     * @var StringContainer
     */
    protected $stringContainer;

    public function __construct(StringContainer $container)
    {
        $this->stringContainer = $container;
    }

    /**
     * @param mixed ...$params
     * @return StringContainer
     */
    abstract public function __invoke(...$params);

}