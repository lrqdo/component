<?php
namespace Alterway\Maat\Reflection\tests\unit;
use atoum;

require_once __DIR__.'/../../../src/Maat/Reflection/ClassReflectionInterface.php';
require_once __DIR__.'/../../../src/Maat/Reflection/ClassReflection.php';
require_once __DIR__.'/../../../src/Maat/Reflection/MethodReflectionInterface.php';
require_once __DIR__.'/../../../src/Maat/Reflection/MethodReflection.php';

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

        $this->object = new \Alterway\Maat\Reflection\ClassReflection('\Test\MyClass1');
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
            ->isInstanceOf('\Alterway\Maat\Reflection\MethodReflectionInterface');
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