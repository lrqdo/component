<?php
namespace Alterway\Component\Reflection\Factory;
use Alterway\Component\Reflection\TagReflection
, Alterway\Component\Reflection\CommentReflectionInterface;

/**
 * Factory of Alterway\Component\Reflection\TagReflection
 *
 * @namespace Alterway\Component\Reflection\Factory
 * @implements TagFactoryInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class TagFactory implements TagFactoryInterface
{
    /**
     * Factory array of tags according to the given comment text
     *
     * @uses TagReflectionFactory::factory()
     * @param $text
     * @return array
     */
    public function factoryTags($text)
    {
        $text = trim($text, " \t*\\");
        $lines = preg_split('!\\*!', $text);
        $tags = array();
        foreach ($lines as $line) {
            if ($this->isTag($line)) {
                array_push($tags, $this->factory($line));
            }
        }
        return $tags;
    }

    /**
     * Factory array of tags according to the given comment
     *
     * @param CommentReflectionInterface
     * @return array
     */
    public function factoryTagsFromComment(CommentReflectionInterface $comment)
    {
        return $this->factoryTags($comment->getText());
    }

    /**
     * Factory a tag by text
     *
     * @param $text
     * @return \Alterway\Component\Reflection\TagReflection|null
     */
    public function factory($text)
    {
        if (!$this->isTag($text)) {
            return null;
        }
        preg_match('!
            @(\w*)
            (?:
                \s*(\w*)
            ){0,1}
            !x', $text, $matches);

        array_shift($matches);
        list($name, $value) = $matches;

        return new TagReflection($name, $value);
    }

    /**
     * Check if the given text is a tag
     *
     * @param $text
     * @return boolean
     */
    public function isTag($text)
    {
        $text = trim($text, " \t*");
        return (boolean)preg_match('!@[\w\s]*!', $text);
    }

}