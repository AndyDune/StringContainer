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


class RemoveDuplicateWords extends AbstractAction
{
    public function __invoke(...$params)
    {
        $string = $this->stringContainer->getString();

        $resultString = '';
        $currentWord = '';
        while (true) {

            if (!strlen($string)) {
                break;
            }

            $char = substr($string, 0, 1);
            $string = substr($string, 1);

            if (!preg_match('|\s+|ui', $char)) {
                $currentWord .= $char;
                continue;
            }

            if ($currentWord) {
                $string = $this->removeWordFromString($currentWord, $string);
            }
            $resultString .= $currentWord . $char;
            $currentWord = '';
        }

        if ($currentWord) {
            $resultString .= $currentWord;
        }

        $this->stringContainer->setString($resultString);
    }

    protected function removeWordFromString($word, $string)
    {
        $resultString = '';
        $currentWord = '';
        while (true) {
            if (!strlen($string)) {
                break;
            }

            $char = substr($string, 0, 1);
            $string = substr($string, 1);

            if (!preg_match('|\s+|ui', $char)) {
                $currentWord .= $char;
                continue;
            }

            if (!$currentWord) {
                $resultString .= $char;
                continue;
            }

            $pattern = sprintf('|^%s$|ui', $currentWord);
            if (!preg_match($pattern, $word)) {
                $resultString .= $currentWord;
            }

            $resultString .= $char;
            $currentWord = '';
        }

        if ($currentWord) {
            $resultString .= $currentWord;
        }

        return $resultString;

    }

}