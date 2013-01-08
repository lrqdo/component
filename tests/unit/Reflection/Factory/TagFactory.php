<?php
namespace Alterway\Maat\Reflection\Factory\tests\unit;
use atoum;


class TagFactory extends atoum
{

    private $object;

    public function beforeTestMethod($method)
    {
        $this->object = new \Alterway\Maat\Reflection\Factory\TagFactory;
    }

    public function testICanBuildTagsFromText()
    {
        $text = ''
            . '/**'
            . ' * @author jeff'
            . ' * @another'
            . ' */';
        $this
            ->array($this->object->factoryTags($text))
            ->sizeof(2);
    }

    public function testICanFactoryTagsFromAnIlineComment()
    {
        $text = '/** @tag1 */';
        $this
            ->array($this->object->factoryTags($text))
            ->sizeof(1);
    }

    public function testICanFactoryTagFromComment()
    {
        $comment = new \mock\Alterway\Maat\Reflection\CommentReflectionInterface;
        $comment->getText = function () {
            return ''
                . '/**'
                . ' * @author jeff'
                . ' * @another'
                . ' */';
        };

        $this
            ->array($this->object->factoryTagsFromComment($comment))
            ->sizeof(2);

    }

    public function testICanBuildOneTagFromText()
    {
        $text = '/** @tag1 */';
        $this
            ->object($this->object->factory($text))
            ->isInstanceOf('\Alterway\Maat\Reflection\TagReflectionInterface');
    }
}