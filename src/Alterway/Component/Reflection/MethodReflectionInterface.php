<?php
namespace Alterway\Component\Reflection;

/**
 * Customized Reflection method
 *
 * @namespace Alterway\Component\Reflection
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
interface MethodReflectionInterface
{

    /**
     * Get the class where the methdo is localized
     *
     * @return ClassReflection|\ReflectionClass
     */
    public function getClassContext();

    /**
     * Get the comment associated to this method
     *
     * @return CommentReflection
     */
    public function getComment();

    public static function export($class, $name, $return = false);

    public function getClosure($object);

    public function getDeclaringClass();

    public function getModifiers();

    public function getPrototype();

    public function invokeArgs($object, array $args);

    public function isAbstract();

    public function isConstructor();

    public function isDestructor();

    public function isFinal();

    public function isPrivate();

    public function isProtected();

    public function isPublic();

    public function isStatic();

    public function setAccessible($accessible);

    public function __toString();

}