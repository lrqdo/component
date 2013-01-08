<?php
namespace Alterway\Component\Reflection\Factory;
use Alterway\Component\Reflection\CommentReflectionInterface;
/**
 * Factory of Alterway\Component\Reflection\TagReflection
 *
 * @namespace Alterway\Component\Reflection\Factory
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
interface TagFactoryInterface
{
    /**
     * Factory array of tags according to the given comment text
     *
     * @param $text
     * @return array
     */
    public function factoryTags($text);

    /**
     * Factory array of tags according to the given comment
     *
     * @param CommentReflectionInterface
     * @return array
     */
    public function factoryTagsFromComment(CommentReflectionInterface $comment);

    /**
     * Factory a tag by text
     *
     * @param $text
     * @return \Alterway\Component\Reflection\TagReflection|null
     */
    public function factory($text);

    /**
     * Check if the given text is a tag
     *
     * @param $text
     * @return boolean
     */
    public function isTag($text);

}