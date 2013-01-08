<?php
namespace Alterway\Maat\Reflection\tests\unit;
use atoum;


class CommentReflection extends atoum
{

    public function testICanGetTheTextComment()
    {
        $text = ''
            . '/**'
            . ' * @author jeff'
            . ' */';
        $commentable = new \mock\Alterway\Maat\Reflection\CommentableInterface;
        $comment = new \Alterway\Maat\Reflection\CommentReflection($text, $commentable);
        $this
            ->string($comment->getText())
            ->isEqualTo($text);
    }
}