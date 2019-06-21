<?php
/**
 *
 * @package andydune/string-container
 * @link  https://github.com/AndyDune/StringContainer for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */


namespace AndyDuneTest\StringContainer;

use AndyDune\StringContainer\StringContainer;
use PHPUnit\Framework\TestCase;

class StringContainerTest extends TestCase
{
    public function testStringContainer()
    {
        $container = new StringContainer('Very cool.');
        $this->assertEquals('Very cool.', $container->getString());
        $this->assertEquals('Very cool.', $container());

        $container->setString('Not very.');
        $this->assertEquals('Not very.', $container->getString());
        $this->assertEquals('Not very.', $container());

        $container('OK');
        $this->assertEquals('OK', $container->getString());
        $this->assertEquals('OK', $container());

    }

    /**
     * @covers \AndyDune\StringContainer\Action\RemoveDuplicateSpaces::__invoke
     */
    public function testRemoveDuplicateSpaces()
    {
        $container = new StringContainer('Very    
        cool.');
        $this->assertEquals('Very cool.', $container->removeDuplicateSpaces()->getString());
    }

    /**
     * @covers \AndyDune\StringContainer\Action\RemoveDuplicateWords::__invoke
     */

    public function testRemoveDuplicateWords()
    {
        $container = new StringContainer('Very very cool cooly.');
        $this->assertEquals('Very  cool cooly.', $container->removeDuplicateWords()->getString());


        $container = new StringContainer('Very very cool cooly.');
        $this->assertEquals('Very cool cooly.', $container->removeDuplicateWords()->removeDuplicateSpaces()->getString());


        $container = new StringContainer('Каталог взрослая обувь KEDDO взрослая оптом в Липецке');
        $this->assertEquals('Каталог взрослая обувь KEDDO  оптом в Липецке', $container->removeDuplicateWords()->getString());

        $container = new StringContainer('the word the peace');
        $this->assertEquals('the word  peace', $container->removeDuplicateWords()->getString());

        $container = new StringContainer('the word the peace');
        $this->assertEquals('the word the peace', $container->removeDuplicateWords('the')->getString());


        $container = new StringContainer('many worlds many worlds');
        $this->assertEquals('many worlds  ', $container->removeDuplicateWords()->getString());

        $container = new StringContainer('many worlds many worlds');
        $this->assertEquals('many worlds  worlds', $container->removeDuplicateWords(null, 'many')->getString());

        $container = new StringContainer('many worlds many worlds');
        $this->assertEquals('many worlds many worlds', $container->removeDuplicateWords(null, ['one'])->getString());

        $container = new StringContainer('many worlds many worlds');
        $this->assertEquals('many worlds  ', $container->removeDuplicateWords(null, ['worlds', 'many'])->getString());
    }

}