<?php
namespace Alterway\Component\Reflection\tests\unit;
use atoum;


class CommentReflection extends atoum
{

    public function testICanGetTheTextComment()
    {
        $text = ''
            . '/**'
            . ' * @author jeff'
            . ' */';
        $commentable = new \mock\Alterway\Component\Reflection\CommentableInterface;
        $comment = new \Alterway\Component\Reflection\CommentReflection($text, $commentable);
        $this
            ->string($comment->getText())
            ->isEqualTo($text);
    }

    public function testICanGetTagsContainedInTheComment() {
        $text = ''
            . '/**'
            . ' * @author jeff'
            . ' * @test'
            . ' */';
        $commentable = new \mock\Alterway\Component\Reflection\CommentableInterface;
        $comment = new \Alterway\Component\Reflection\CommentReflection($text, $commentable);

        $this
            ->array($comment->getTags())
            ->sizeOf(2);
    }
}