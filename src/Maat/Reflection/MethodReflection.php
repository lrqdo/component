<?php
namespace Alterway\Maat\Reflection;
use ReflectionMethod as splReflectionMethod;


/**
 * Customized Reflection method
 *
 * We need to have a proxy to get customized comments
 *
 * @namespace Alterway\Maat\Reflection
 * @implements MethodReflectionInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class MethodReflection extends \ReflectionMethod implements MethodReflectionInterface {

    /**
     * @var ClassReflection
     */
    private $classContext;

    /**
     * Constructor
     *
     * @param string $classname
     * @param string $methodName
     * @param ClassReflection $class
     */
    public function __construct($classname, $methodName, ClassReflection $classContext = null) {
        parent::__construct($classname, $methodName);
        if(is_null($classContext)) {
            $classContext = new \ReflectionClass($classContext);
        }
        $this->classContext = $classContext;
    }

    /**
     * Get the class where the methdo is localized
     *
     * @return ClassReflection|\ReflectionClass
     */
    public function getClassContext() {
        return $this->classContext;
    }
}