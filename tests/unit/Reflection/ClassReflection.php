<?php
namespace Alterway\Component\Reflection\tests\unit;
use atoum;

class ClassReflection extends atoum {

    private $object;

    public function beforeTestMethod($method) {
        $class = <<<EOT
<?php
namespace Test;
class MyClass1 {
    public function method1() {}
    public function method2() {}
    private function method3() {}
}
EOT;
        $tmp = tempnam(sys_get_temp_dir(), "unit");
        file_put_contents($tmp, $class);
        require_once $tmp;

        $this->object = new \Alterway\Component\Reflection\ClassReflection('\Test\MyClass1');
    }

    public function testAllMethodsAreFound() {

        $methods = $this->object->getMethods();
        $this
            ->sizeof($methods)
            ->isEqualTo(3);
    }

    public function testICanRetrieveMethodByItsName() {
        $this
            ->object($this->object->getMethodByName('method1'))
            ->isInstanceOf('\Alterway\Component\Reflection\MethodReflectionInterface');
    }

    public function testICanGetTheCommentAssociatedToTheReflectedClass() {
        $this
            ->object($this->object->getComment())
            ->isInstanceOf('\Alterway\Component\Reflection\CommentReflectionInterface');
    }

    public function testICanObtainTheNameOfTheReflectedClass() {
        $this
            ->variable($this->object->getName())
            ->isEqualTo('Test\MyClass1');
    }

    public function testICanObtainTheNamespaceOfTheReflectedClass() {
        $this
            ->variable($this->object->getNamespaceName())
            ->isEqualTo('Test');
    }

    public function testICanObtainTheFileNameOfTheReflectedClass() {
        $this
            ->string($this->object->getFileName())
            ->hasLengthGreaterThan(0);
    }

    public function testICanKnowIfTheReflectedClassIsAbstract() {
        $this
            ->boolean($this->object->isAbstract())
            ->isFalse();
    }
}