<?php
namespace Alterway\Maat\Reflection\tests\unit;
use atoum;

class TagReflection extends atoum
{

    public function testICanUseATag()
    {
        $this
            ->object(new \Alterway\Maat\Reflection\TagReflection('author', 'jeff'))
            ->isInstanceOf('\Alterway\Maat\Reflection\TagReflectionInterface');
    }

}