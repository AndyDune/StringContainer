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


use voku\helper\UTF8;

class RemoveDuplicateWords extends AbstractAction
{
    protected $wordsNotRemove = [];
    protected $wordsToRemove = [];

    public function __invoke(...$params)
    {
        if (isset($params[0])) {
            $this->wordsNotRemove = $params[0];
            if (!is_array($this->wordsNotRemove)) {
                $this->wordsNotRemove = [$this->wordsNotRemove];
            }
        }

        if (isset($params[1])) {
            $this->wordsToRemove = $params[1];
            if (!is_array($this->wordsToRemove)) {
                $this->wordsToRemove = [$this->wordsToRemove];
            }

        }

        $string = $this->stringContainer->getString();

        $resultString = '';
        $currentWord = '';
        while (true) {

            if (!strlen($string)) {
                break;
            }

            $char = UTF8::substr($string, 0, 1);
            $string = UTF8::substr($string, 1);

            if (!preg_match('|\s+|ui', $char)) {
                $currentWord .= $char;
                continue;
            }

            if (!$currentWord) {
                $resultString .= $char;
                continue;
            }

            if ($this->isCanBeRemoved($currentWord)) {
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

    private function isCanBeRemoved($word)
    {
        if ($this->wordsToRemove) {
            if (in_array($word, $this->wordsToRemove)) {
                return true;
            }
            return false;

        }

        if (in_array($word, $this->wordsNotRemove)) {
            return false;
        }
        return true;
    }

    protected function removeWordFromString($word, $string)
    {
        $resultString = '';
        $currentWord = '';
        while (true) {
            if (!strlen($string)) {
                break;
            }

            $char = UTF8::substr($string, 0, 1);
            $string = UTF8::substr($string, 1);

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
            $pattern = sprintf('|^%s$|ui', $currentWord);
            if (!preg_match($pattern, $word)) {
                $resultString .= $currentWord;
            }
        }

        return $resultString;

    }

}