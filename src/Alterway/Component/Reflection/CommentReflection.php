<?php
namespace Alterway\Component\Reflection;

/**
 * Customized Reflection comment
 *
 * @namespace Alterway\Component\Reflection
 * @implements CommentReflectionInterface
 * @author Jean-François Lépine <jean-francois.lepine@alterway.fr>
 */
class CommentReflection implements CommentReflectionInterface
{

    /**
     * What is commented
     *
     * @var CommentableInterface
     */
    private $commented;

    /**
     * Comment in raw format
     *
     * @var string
     */
    private $text;

    /**
     * Tags (annotations)
     *
     * @var array
     */
    private $tags;

    /**
     * Constructor
     *
     * @param string $text
     * @param CommentableInterface $commented
     */
    public function __construct($text, CommentableInterface $commented)
    {
        $this->text = (string) $text;
        $this->commented = $commented;

        $factory = new Factory\TagFactory;
        $this->tags = $factory->factoryTags($this->text);
    }

    /**
     * Get the comment's text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get what's commented
     *
     * @return CommentableInterface
     */
    public function getCommented()
    {
        return $this->commented;
    }

    /**
     * Get the tags (annotations)
     *
     * @return array
     */
    public function getTags() {
        return $this->tags;
    }

}