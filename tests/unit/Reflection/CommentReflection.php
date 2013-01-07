<?php
namespace Alterway\Maat\Reflection\tests\unit;
use atoum;

require_once __DIR__ . '/../../../src/Maat/Reflection/CommentableInterface.php';
require_once __DIR__ . '/../../../src/Maat/Reflection/ClassReflectionInterface.php';
require_once __DIR__ . '/../../../src/Maat/Reflection/ClassReflection.php';
require_once __DIR__ . '/../../../src/Maat/Reflection/MethodReflectionInterface.php';
require_once __DIR__ . '/../../../src/Maat/Reflection/MethodReflection.php';
require_once __DIR__ . '/../../../src/Maat/Reflection/CommentReflectionInterface.php';
require_once __DIR__ . '/../../../src/Maat/Reflection/CommentReflection.php';

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