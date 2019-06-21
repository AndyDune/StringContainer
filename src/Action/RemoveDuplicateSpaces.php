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


class RemoveDuplicateSpaces extends AbstractAction
{
    public function __invoke(...$params)
    {
        $this->stringContainer->setString(
            preg_replace('#\s+#', ' ', $this->stringContainer->getString()));
    }
}