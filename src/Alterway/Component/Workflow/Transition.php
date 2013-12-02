<?php


namespace Alterway\Component\Workflow;


use Alterway\Component\Workflow\Node\NodeInterface;

class Transition implements TransitionInterface
{
    /**
     * @var NodeInterface
     */
    private $src;

    /**
     * @var NodeInterface
     */
    private $dst;

    /**
     * @var SpecificationInterface
     */
    private $spec;

    public function __construct(NodeInterface $src, NodeInterface $dst, SpecificationInterface $spec)
    {
        $this->src = $src;
        $this->dst = $dst;
        $this->spec = $spec;
    }

    /**
     * @inheritdoc
     */
    public function isOpen(ContextInterface $context)
    {
        return $this->spec->isSatisfiedBy($context);
    }

    /**
     * @inheritdoc
     */
    public function getDestination()
    {
        return $this->dst;
    }
}
