<?php
namespace Alterway\Component\Reflection;

/**
 * Represents a tag (annotation, phpdoc)
 *
 * @namespace Alterway\Component\Reflection
 * @implements TagReflectionInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class TagReflection implements TagReflectionInterface
{
    /**
     * Name of the tag
     *
     * @var string
     */
    private $name;

    /**
     * Value of the tag
     *
     * @var string
     */
    private $value;

    /**
     * Constructor
     *
     * @param $name
     * @param $value
     */
    function __construct($name, $value)
    {
        $this->name = (string)$name;
        $this->value = (string)$value;
    }


    /**
     * Get the tag's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the tag's value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

}