<?php
namespace Alterway\Maat\Reflection;

/**
 * Customized Reflection class
 *
 * We need to have a proxy to get customized methods
 *
 * @namespace Alterway\Maat\Reflection
 * @extends \ReflectionClass
 * @implements ClassReflectionInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class ClassReflection extends \ReflectionClass implements ClassReflectionInterface {

    /**
     * Get method by its name
     *
     * @param string $name
     * @param integer $filter
     * @return MethodReflection
     */
    public function getMethodByName($name, $filter = 0) {
        $methods = $this->getMethods();
        foreach($methods as $method) {
            if($method->getName() === $name) {
                return $method;
            }
        }
        return null;
    }

    /**
     * Get the methods of the reflected class
     *
     * @param int $filter
     * @return array|\ReflectionMethod[]
     */
    public function getMethods($filter = 0) {
        if($filter === 0) {
            $filter = \ReflectionMethod::IS_STATIC
                | \ReflectionMethod::IS_PUBLIC
                | \ReflectionMethod::IS_PROTECTED
                | \ReflectionMethod::IS_PRIVATE
                | \ReflectionMethod::IS_ABSTRACT
                | \ReflectionMethod::IS_FINAL;
        }
        $methods = array();
        foreach(parent::getMethods($filter) as $method) {
            array_push($methods, new MethodReflection($this->getName(), $method->getName(), $this));
        }
        return $methods;
    }
}