<?php
namespace Alterway\Component\Reflection;

/**
 * Represents a tag (annotation, phpdoc)
 *
 * @namespace Alterway\Component\Reflection
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
interface TagReflectionInterface
{

    /**
     * Get the tag's name
     *
     * @return string
     */
    public function getName();

    /**
     * Get the tag's value
     *
     * @return string
     */
    public function getValue();

}