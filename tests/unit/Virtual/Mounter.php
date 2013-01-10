<?php
namespace Alterway\Component\Virtual\tests\unit;
use atoum;

/**
 * @tags virtual object
 */
class Mounter extends atoum
{

    private $object;

    public function beforeTestMethod($method)
    {
        $this->object = new \Alterway\Component\Virtual\Mounter;
    }

    public function testICanLoadClassEvenIfParentDoesntExist()
    {

        $content = '<?php class TestedClass extends UnexistentClass {}';
        $this->object->mountCode($content);
        $this
            ->boolean(class_exists('TestedClass'))
            ->isTrue()
            ->boolean(class_exists('UnexistentClass'))
            ->isTrue()
        ;
    }

    public function testICanLoadClassEvenIfImplementedInterfacesDoesntExist()
    {

        $content = '<?php class TestedClass implements UnexistentInterface {}';
        $this->object->mountCode($content);
        $this
            ->boolean(class_exists('TestedClass'))
            ->isTrue()
            ->boolean(interface_exists('UnexistentInterface'))
            ->isTrue()
        ;
    }

    public function testICanLoadNamespacedClassEvenIfImplementedInterfacesDoesntExist()
    {

        $content = '<?php namespace Truc; class TestedClass implements UnexistentInterface {}';
        $this->object->mountCode($content);
        $this
            ->boolean(class_exists('Truc\TestedClass'))
            ->isTrue()
            ->boolean(interface_exists('Truc\UnexistentInterface'))
            ->isTrue()
        ;
    }

    public function testICanMountUnexistentClassWithNamespace()
    {
        $this->object->mount('Abcdef\Ghijkl');
        $this
            ->boolean(class_exists('\Abcdef\Ghijkl'))
            ->isTrue();
    }

    public function testICanMountUnexistentClassWithoutNamespace()
    {
        $this->object->mount('Ghijkl');
        $this
            ->boolean(class_exists('\Ghijkl'))
            ->isTrue();
    }


    public function testICanMountClassTypedWithUnexistsentClass()
    {
        $content = '<?php class TestedClass { public function doAny( UnexistentClass $class) {} }';
        $this->object->mountCode($content);
        $this
            ->boolean(class_exists('\TestedClass'))
            ->isTrue()
            ;
    }
}