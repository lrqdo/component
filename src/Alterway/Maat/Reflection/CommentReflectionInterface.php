<?php
namespace Alterway\Maat\Reflection;

/**
 * Customized Reflection comment
 *
 * @namespace Alterway\Maat\Reflection
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
interface CommentReflectionInterface
{

    /**
     * Get the comment's text
     *
     * @return string
     */
    public function getText();

    /**
     * Get what's commented
     *
     * @return CommentableInterface
     */
    public function getCommented();

    /**
     * Get the tags (annotations)
     *
     * @return array
     */
    public function getTags();
}