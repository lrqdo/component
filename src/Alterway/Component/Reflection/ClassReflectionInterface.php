<?php
namespace Alterway\Component\Reflection;

/**
 * Customized Reflection interface
 *
 * @see \ReflectionClass
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
interface ClassReflectionInterface
{

    public function getMethodByName($name, $filter = 0);

    public function getConstant($name);

    public function getConstants();

    public function getConstructor();

    public function getDefaultProperties();

    public function getDocComment();

    public function getEndLine();

    public function getExtension();

    public function getExtensionName();

    public function getFileName();

    public function getInterfaceNames();

    public function getInterfaces();

    public function getMethod($name);

    public function getMethods($filter = 0);

    public function getModifiers();

    public function getName();

    public function getNamespaceName();

    public function getParentClass();

    public function getProperties($filter = 0);

    public function getProperty($name);

    public function getShortName();

    public function getStartLine();

    public function getStaticProperties();

    public function getStaticPropertyValue($name);

    public function getTraitAliases();

    public function getTraitNames();

    public function getTraits();

    public function hasConstant($name);

    public function hasMethod($name);

    public function hasProperty($name);

    public function implementsInterface($interface);

    public function inNamespace();

    public function isAbstract();

    public function isCloneable();

    public function isFinal();

    public function isInstance($object);

    public function isInstantiable();

    public function isInterface();

    public function isInternal();

    public function isIterateable();

    public function isSubclassOf($class);

    public function isTrait();

    public function isUserDefined();

    public function setStaticPropertyValue($name, $value);


}