<?php
namespace Alterway\Component\Reflection;
use ReflectionMethod as splReflectionMethod;


/**
 * Customized Reflection method
 *
 * We need to have a proxy to get customized comments
 *
 * @namespace Alterway\Component\Reflection
 * @implements MethodReflectionInterface
 * @implements CommentableInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class MethodReflection extends \ReflectionMethod implements MethodReflectionInterface, CommentableInterface {

    /**
     * @var ClassReflection
     */
    private $classContext;

    /**
     * Constructor
     *
     * @param string $class
     * @param string $methodName
     * @param ClassReflection $class
     */
    public function __construct($class, $methodName, ClassReflection $classContext = null) {
        parent::__construct($class, $methodName);
        if(is_null($classContext)) {
            $classContext = new ClassReflection($class);
        }
        $this->classContext = $classContext;
        $this->comment = new CommentReflection($this->getDocComment(), $this);
    }

    /**
     * Get the class where the method is localized
     *
     * @return ClassReflection|\ReflectionClass
     */
    public function getClassContext() {
        return $this->classContext;
    }

    /**
     * Get the comment associated to this method
     *
     * @return CommentReflection
     */
    public function getComment() {
        return $this->comment;
    }
}