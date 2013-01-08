<?php
namespace Alterway\Component\Reflection\tests\unit;
use atoum;

class TagReflection extends atoum
{

    public function testICanUseATag()
    {
        $this
            ->object(new \Alterway\Component\Reflection\TagReflection('author', 'jeff'))
            ->isInstanceOf('\Alterway\Component\Reflection\TagReflectionInterface');
    }

}